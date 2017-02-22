<?php

namespace compteBundle\Controller;

use compteBundle\Entity\Delegation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Delegation controller.
 *
 */
class DelegationController extends Controller
{
    /**
     * Lists all delegation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $delegations = $em->getRepository('compteBundle:Delegation')->findAll();

        return $this->render('delegation/index.html.twig', array(
            'delegations' => $delegations,
        ));
    }

    /**
     * Creates a new delegation entity.
     *
     */
    public function newAction(Request $request)
    {
        $delegation = new Delegation();
        $form = $this->createForm('compteBundle\Form\DelegationType', $delegation);
        $form->handleRequest($request);
        $depth=$delegation->getDepth();
        if($depth===NULL){
            $delegation->setDepth(1);
        }
        else
            $delegation->setDepth($delegation->getMasterEntity()->getDepth());


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($delegation);
            $em->flush($delegation);

            return $this->redirectToRoute('delegation_show', array('id' => $delegation->getId()));
        }

        return $this->render('delegation/new.html.twig', array(
            'delegation' => $delegation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a delegation entity.
     *
     */
    public function showAction(Delegation $delegation)
    {
        $deleteForm = $this->createDeleteForm($delegation);

        return $this->render('delegation/show.html.twig', array(
            'delegation' => $delegation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing delegation entity.
     *
     */
    public function editAction(Request $request, Delegation $delegation)
    {
        $deleteForm = $this->createDeleteForm($delegation);
        $editForm = $this->createForm('compteBundle\Form\DelegationType', $delegation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('delegation_edit', array('id' => $delegation->getId()));
        }

        return $this->render('delegation/edit.html.twig', array(
            'delegation' => $delegation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a delegation entity.
     *
     */
    public function deleteAction(Request $request, Delegation $delegation)
    {
        $form = $this->createDeleteForm($delegation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($delegation);
            $em->flush($delegation);
        }

        return $this->redirectToRoute('delegation_index');
    }

    /**
     * Creates a form to delete a delegation entity.
     *
     * @param Delegation $delegation The delegation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Delegation $delegation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delegation_delete', array('id' => $delegation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
