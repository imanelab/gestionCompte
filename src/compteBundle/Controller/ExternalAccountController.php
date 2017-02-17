<?php

namespace compteBundle\Controller;

use compteBundle\Entity\ExternalAccount;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Externalaccount controller.
 *
 */
class ExternalAccountController extends Controller
{
    /**
     * Lists all externalAccount entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $externalAccounts = $em->getRepository('compteBundle:ExternalAccount')->findAll();

        return $this->render('externalaccount/index.html.twig', array(
            'externalAccounts' => $externalAccounts,
        ));
    }

    /**
     * Creates a new externalAccount entity.
     *
     */
    public function newAction(Request $request)
    {
        $externalAccount = new Externalaccount();
        $form = $this->createForm('compteBundle\Form\ExternalAccountType', $externalAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($externalAccount);
            $em->flush($externalAccount);

            return $this->redirectToRoute('externalaccount_show', array('id' => $externalAccount->getId()));
        }

        return $this->render('externalaccount/new.html.twig', array(
            'externalAccount' => $externalAccount,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a externalAccount entity.
     *
     */
    public function showAction(ExternalAccount $externalAccount)
    {
        $deleteForm = $this->createDeleteForm($externalAccount);

        return $this->render('externalaccount/show.html.twig', array(
            'externalAccount' => $externalAccount,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing externalAccount entity.
     *
     */
    public function editAction(Request $request, ExternalAccount $externalAccount)
    {
        $deleteForm = $this->createDeleteForm($externalAccount);
        $editForm = $this->createForm('compteBundle\Form\ExternalAccountType', $externalAccount);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('externalaccount_edit', array('id' => $externalAccount->getId()));
        }

        return $this->render('externalaccount/edit.html.twig', array(
            'externalAccount' => $externalAccount,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a externalAccount entity.
     *
     */
    public function deleteAction(Request $request, ExternalAccount $externalAccount)
    {
        $form = $this->createDeleteForm($externalAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($externalAccount);
            $em->flush($externalAccount);
        }

        return $this->redirectToRoute('externalaccount_index');
    }

    /**
     * Creates a form to delete a externalAccount entity.
     *
     * @param ExternalAccount $externalAccount The externalAccount entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ExternalAccount $externalAccount)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('externalaccount_delete', array('id' => $externalAccount->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
