<?php

namespace compteBundle\Controller;

use compteBundle\Entity\Movement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Movement controller.
 *
 */
class MovementController extends Controller
{
    /**
     * Lists all movement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $movements = $em->getRepository('compteBundle:Movement')->findAll();

        return $this->render('movement/index.html.twig', array(
            'movements' => $movements,
        ));
    }


    /**
    * Check the selected accounts
    *
    **/

    public function selectedAccount(Movement $movement, Request $request){
        $form = $this->createForm('compteBundle\Form\MovementType', $movement);
        $form->handleRequest($request);
        $selectDebitAccount=$form["selectDebitAccount"]->getData();
        $selectCreditAccount=$form["selectCreditAccount"]->getData();
        if ($selectDebitAccount=="1")
            $movement->unsetAccount("DEA");
        elseif ($selectDebitAccount=="2")
            $movement->unsetAccount("DA");

        if ($selectCreditAccount=="1")
            $movement->unsetAccount("CEA");
        elseif ($selectCreditAccount=="2")
            $movement->unsetAccount("CA");

    }

    /**
     * Creates a new movement entity.
     *
     */
    public function newAction(Request $request)
    {
        $movement = new Movement();
        $form = $this->createForm('compteBundle\Form\MovementType', $movement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->selectedAccount($movement, $request);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($movement);
            $em->flush($movement);

            return $this->redirectToRoute('movement_show', array('id' => $movement->getId()));
        }

        return $this->render('movement/new.html.twig', array(
            'movement' => $movement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a movement entity.
     *
     */
    public function showAction(Movement $movement)
    {
        $deleteForm = $this->createDeleteForm($movement);

        return $this->render('movement/show.html.twig', array(
            'movement' => $movement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing movement entity.
     *
     */
    public function editAction(Request $request, Movement $movement)
    {
        $deleteForm = $this->createDeleteForm($movement);
        $editForm = $this->createForm('compteBundle\Form\MovementType', $movement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('movement_edit', array('id' => $movement->getId()));
        }

        return $this->render('movement/edit.html.twig', array(
            'movement' => $movement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a movement entity.
     *
     */
    public function deleteAction(Request $request, Movement $movement)
    {
        $form = $this->createDeleteForm($movement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($movement);
            $em->flush($movement);
        }

        return $this->redirectToRoute('movement_index');
    }

    /**
     * Creates a form to delete a movement entity.
     *
     * @param Movement $movement The movement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Movement $movement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('movement_delete', array('id' => $movement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
