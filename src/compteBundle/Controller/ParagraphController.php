<?php

namespace compteBundle\Controller;

use compteBundle\Entity\Paragraph;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Paragraph controller.
 *
 */
class ParagraphController extends Controller
{
    /**
     * Lists all paragraph entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $paragraphs = $em->getRepository('compteBundle:Paragraph')->findAll();

        return $this->render('paragraph/index.html.twig', array(
            'paragraphs' => $paragraphs,
        ));
    }

    /**
     * Creates a new paragraph entity.
     *
     */
    public function newAction(Request $request)
    {
        $paragraph = new Paragraph();
        $form = $this->createForm('compteBundle\Form\ParagraphType', $paragraph);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paragraph);
            $em->flush($paragraph); 
        $this->addFlash('notice', 'لقد تمت العملية بنجاح');
        return $this->redirectToRoute('paragraph_show', array('id' => $paragraph->getId()));

        }
        elseif ($form->isSubmitted()) {

            $this->addFlash('error', 'هناك مشكل في إتمام العملية');

        }

        return $this->render('paragraph/new.html.twig', array(
            'paragraph' => $paragraph,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a paragraph entity.
     *
     */
    public function showAction(Paragraph $paragraph)
    {
        $deleteForm = $this->createDeleteForm($paragraph);

        return $this->render('paragraph/show.html.twig', array(
            'paragraph' => $paragraph,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing paragraph entity.
     *
     */
    public function editAction(Request $request, Paragraph $paragraph)
    {
        $deleteForm = $this->createDeleteForm($paragraph);
        $editForm = $this->createForm('compteBundle\Form\ParagraphType', $paragraph);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', 'لقد تمت العملية بنجاح');
        return $this->redirectToRoute('paragraph_show', array('id' => $paragraph->getId()));

        }
        elseif ($editForm->isSubmitted()) {

            $this->addFlash('error', 'هناك مشكل في إتمام العملية');

        }

        return $this->render('paragraph/edit.html.twig', array(
            'paragraph' => $paragraph,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a paragraph entity.
     *
     */
    public function deleteAction(Request $request, Paragraph $paragraph)
    {
        $form = $this->createDeleteForm($paragraph);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paragraph);
            $em->flush($paragraph);
        $this->addFlash('notice', 'لقد تمت العملية بنجاح');
        }
        else {

            $this->addFlash('error', 'هناك مشكل في إتمام العملية');

        }

        return $this->redirectToRoute('paragraph_index');
    }

    /**
     * Creates a form to delete a paragraph entity.
     *
     * @param Paragraph $paragraph The paragraph entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Paragraph $paragraph)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paragraph_delete', array('id' => $paragraph->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
