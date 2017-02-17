<?php

namespace compteBundle\Controller;

use compteBundle\Entity\Morass;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Morass controller.
 *
 */
class MorassController extends Controller
{
    /**
     * Lists all morass entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $morasses = $em->getRepository('compteBundle:Morass')->findAll();

        return $this->render('morass/index.html.twig', array(
            'morasses' => $morasses,
        ));
    }

    /**
     * Creates a new morass entity.
     *
     */
    public function newAction(Request $request)
    {
        $morass = new Morass();
        $form = $this->createForm('compteBundle\Form\MorassType', $morass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($morass);
            $em->flush($morass);

            return $this->redirectToRoute('morass_show', array('id' => $morass->getId()));
        }

        return $this->render('morass/new.html.twig', array(
            'morass' => $morass,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a morass entity.
     *
     */
    public function showAction(Morass $morass)
    {
        $deleteForm = $this->createDeleteForm($morass);

        return $this->render('morass/show.html.twig', array(
            'morass' => $morass,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing morass entity.
     *
     */
    public function editAction(Request $request, Morass $morass)
    {
        $deleteForm = $this->createDeleteForm($morass);
        $editForm = $this->createForm('compteBundle\Form\MorassType', $morass);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('morass_edit', array('id' => $morass->getId()));
        }

        return $this->render('morass/edit.html.twig', array(
            'morass' => $morass,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a morass entity.
     *
     */
    public function deleteAction(Request $request, Morass $morass)
    {
        $form = $this->createDeleteForm($morass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($morass);
            $em->flush($morass);
        }

        return $this->redirectToRoute('morass_index');
    }

    /**
     * Creates a form to delete a morass entity.
     *
     * @param Morass $morass The morass entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Morass $morass)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('morass_delete', array('id' => $morass->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
