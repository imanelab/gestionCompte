<?php

namespace compteBundle\Controller;

use compteBundle\Entity\MasterEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Masterentity controller.
 *
 */
class MasterEntityController extends Controller
{
    /**
     * Lists all masterEntity entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $masterEntities = $em->getRepository('compteBundle:MasterEntity')->findAll();

        return $this->render('masterentity/index.html.twig', array(
            'masterEntities' => $masterEntities,
        ));
    }

    /**
     * Creates a new masterEntity entity.
     *
     */
    public function newAction(Request $request)
    {
        $masterEntity = new Masterentity();
        $form = $this->createForm('compteBundle\Form\MasterEntityType', $masterEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($masterEntity);
            $em->flush($masterEntity);

            return $this->redirectToRoute('masterentity_show', array('id' => $masterEntity->getId()));
        }

        return $this->render('masterentity/new.html.twig', array(
            'masterEntity' => $masterEntity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a masterEntity entity.
     *
     */
    public function showAction(MasterEntity $masterEntity)
    {
        $deleteForm = $this->createDeleteForm($masterEntity);

        return $this->render('masterentity/show.html.twig', array(
            'masterEntity' => $masterEntity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing masterEntity entity.
     *
     */
    public function editAction(Request $request, MasterEntity $masterEntity)
    {
        $deleteForm = $this->createDeleteForm($masterEntity);
        $editForm = $this->createForm('compteBundle\Form\MasterEntityType', $masterEntity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('masterentity_edit', array('id' => $masterEntity->getId()));
        }

        return $this->render('masterentity/edit.html.twig', array(
            'masterEntity' => $masterEntity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a masterEntity entity.
     *
     */
    public function deleteAction(Request $request, MasterEntity $masterEntity)
    {
        $form = $this->createDeleteForm($masterEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($masterEntity);
            $em->flush($masterEntity);
        }

        return $this->redirectToRoute('masterentity_index');
    }

    /**
     * Creates a form to delete a masterEntity entity.
     *
     * @param MasterEntity $masterEntity The masterEntity entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MasterEntity $masterEntity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('masterentity_delete', array('id' => $masterEntity->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}