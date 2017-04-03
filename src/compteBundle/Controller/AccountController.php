<?php

namespace compteBundle\Controller;

use compteBundle\Entity\Account;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Account controller.
 *
 */
class AccountController extends Controller
{
    /**
     * Lists all account entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $accounts = $em->getRepository('compteBundle:Account')->findAll();

        return $this->render('account/index.html.twig', array(
            'accounts' => $accounts,
        ));
    }

    /**
     * Creates a new account entity.
     *
     */
    public function newAction(Request $request)
    {
        $account = new Account();
        $form = $this->createForm('compteBundle\Form\AccountType', $account);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //$userEntity= $currentUser->getMasterEntity();
           // $userEntityDepth = $userEntity->getDepth();
            if (!$this->get('security.context')->isGranted('ROLE_SUPERVISOR')) {
                $user = $this->getUser();
                $masterEntity= $user->getMasterEntity();
                

            }




            $em = $this->getDoctrine()->getManager();

            $parent=$account->getAccount();
            if( is_null($parent))
            $account->setDepth(1);
        else{
                $parentId= $account->getAccount()->getId();
                $id=$account->getId();
                if($parentId==$id){
                $account->removeParent();
                $account->setDepth(1);
            } 
                else{
                    $parentDepth=$parent->getDepth()+1;
                    $account->setDepth($parentDepth);
                }
            }

            $em->persist($account);
            $em->flush($account);

            $this->addFlash('notice', 'لقد تمت العملية بنجاح');
            return $this->redirectToRoute('account_show', array('id' => $account->getId()));
        }
        elseif ($form->isSubmitted()) {

            $this->addFlash('error', 'هناك مشكل في إتمام العملية');

        }

        return $this->render('account/new.html.twig', array(
            'account' => $account,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a account entity.
     *
     */
    public function showAction(Account $account)
    {
        $deleteForm = $this->createDeleteForm($account);

        return $this->render('account/show.html.twig', array(
            'account' => $account,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing account entity.
     *
     */
    public function editAction(Request $request, Account $account)
    {
        $deleteForm = $this->createDeleteForm($account);
        $editForm = $this->createForm('compteBundle\Form\AccountType', $account);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if($account->getAccount()){
           $parent= $account->getAccount()->getId();
           $id=$account->getId();
           if($parent==$id)
           $account->removeParent();
             }
            $this->getDoctrine()->getManager()->flush();

             $this->addFlash('notice', 'لقد تمت العملية بنجاح');
            return $this->redirectToRoute('account_show', array('id' => $account->getId()));
        }
        elseif ($editForm->isSubmitted()) {

            $this->addFlash('error', 'هناك مشكل في إتمام العملية');

        }

        return $this->render('account/edit.html.twig', array(
            'account' => $account,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a account entity.
     *
     */
    public function deleteAction(Request $request, Account $account)
    {
        $form = $this->createDeleteForm($account);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($account);
            $em->flush($account);
         $this->addFlash('notice', 'لقد تمت العملية بنجاح');
        }
        else {

            $this->addFlash('error', 'هناك مشكل في إتمام العملية');

        }

        return $this->redirectToRoute('account_index');
    }

    /**
     * Creates a form to delete a account entity.
     *
     * @param Account $account The account entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Account $account)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('account_delete', array('id' => $account->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
