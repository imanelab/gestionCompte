<?php

namespace compteBundle\Controller;

use compteBundle\Entity\Line;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Line controller.
 *
 */
class LineController extends Controller
{
    /**
     * Lists all line entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $lines = $em->getRepository('compteBundle:Line')->findAll();

        return $this->render('line/index.html.twig', array(
            'lines' => $lines,
        ));
    }

    /**
     * Creates a new line entity.
     *
     */
   public function newAction(Request $request)
    {
        $line = new Line();
        $form = $this->createForm('compteBundle\Form\LineType', $line);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $line->setVersion(1);
            $em->persist($line);
            $em->flush($line);
            return $this->redirectToRoute('line_show', array('id' => $line->getId()));
        }
        return $this->render('line/new.html.twig', array(
            'line' => $line,
            'form' => $form->createView(),
        ));
    }
    /**
     * Finds and displays a line entity.
     *
     */
    public function showAction(Line $line)
    {
        $deleteForm = $this->createDeleteForm($line);

        return $this->render('line/show.html.twig', array(
            'line' => $line,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing line entity.
     *
     */
    public function editAction(Request $request, Line $line)
    {
        $deleteForm = $this->createDeleteForm($line);
        $editForm = $this->createForm('compteBundle\Form\LineType', $line);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('line_edit', array('id' => $line->getId()));
        }

        return $this->render('line/edit.html.twig', array(
            'line' => $line,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a line entity.
     *
     */
    public function deleteAction(Request $request, Line $line)
    {
        $form = $this->createDeleteForm($line);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($line);
            $em->flush($line);
        }

        return $this->redirectToRoute('line_index');
    }

    /**
     * Creates a form to delete a line entity.
     *
     * @param Line $line The line entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Line $line)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('line_delete', array('id' => $line->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
