<?php

namespace compteBundle\Controller;

use compteBundle\Entity\CodificationABB;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Codificationabb controller.
 *
 */
class CodificationABBController extends Controller
{
    /**
     * Lists all codificationABB entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $codificationABBs = $em->getRepository('compteBundle:CodificationABB')->findAll();

        return $this->render('codificationabb/index.html.twig', array(
            'codificationABBs' => $codificationABBs,
        ));
    }

    /**
     * Creates a new codificationABB entity.
     *
     */
    public function newAction(Request $request)
    {
        $codificationABB = new Codificationabb();
        $form = $this->createForm('compteBundle\Form\CodificationABBType', $codificationABB);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($codificationABB);
            $em->flush($codificationABB);

            return $this->redirectToRoute('codificationabb_show', array('id' => $codificationABB->getId()));
        }

        return $this->render('codificationabb/new.html.twig', array(
            'codificationABB' => $codificationABB,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a codificationABB entity.
     *
     */
    public function showAction(CodificationABB $codificationABB)
    {
        $deleteForm = $this->createDeleteForm($codificationABB);

        return $this->render('codificationabb/show.html.twig', array(
            'codificationABB' => $codificationABB,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing codificationABB entity.
     *
     */
    public function editAction(Request $request, CodificationABB $codificationABB)
    {
        $deleteForm = $this->createDeleteForm($codificationABB);
        $editForm = $this->createForm('compteBundle\Form\CodificationABBType', $codificationABB);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('codificationabb_edit', array('id' => $codificationABB->getId()));
        }

        return $this->render('codificationabb/edit.html.twig', array(
            'codificationABB' => $codificationABB,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a codificationABB entity.
     *
     */
    public function deleteAction(Request $request, CodificationABB $codificationABB)
    {
        $form = $this->createDeleteForm($codificationABB);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($codificationABB);
            $em->flush($codificationABB);
        }

        return $this->redirectToRoute('codificationabb_index');
    }

    /**
     * Creates a form to delete a codificationABB entity.
     *
     * @param CodificationABB $codificationABB The codificationABB entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CodificationABB $codificationABB)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('codificationabb_delete', array('id' => $codificationABB->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
