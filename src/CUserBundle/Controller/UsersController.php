<?php

namespace CUserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CUserBundle\Entity\User;
use CUserBundle\Form\UserType;
use CUserBundle\Form\RegistrationType;

/**
 * Users controller.
 *
 */
class UsersController extends Controller
{

    /**
     * Lists all Users entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $forms= array();

        $entities = $em->getRepository('CUserBundle:User')->findAll();
        $entity=$entities[0];
        foreach ($entities as $entity) {
            $forms[$entity->getId()]= $this->createManageForm($entity)
                                           ->createView();
        }

        return $this->render('CUserBundle:Account:index.html.twig', array(
            'entities' => $entities,
            'forms'     => $forms,
        ));
    }
    /**
     * Creates a new Users entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new User();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('users_show', array('username' => $entity->getUsername())));
        }

        return $this->render('CUserBundle:Account:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Users entity.
     *
     * @param User $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(User $entity)
    {
        $form = $this->createForm(new RegistrationType(), $entity, array(
            'action' => $this->generateUrl('users_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Creates a form to manage a Account entity.
     *
     * @param Account $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createManageForm(User $entity)
    {
         $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('users_manage',array('username'=>$entity->getUsername())),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new User entity.
     *
     */
    public function newAction()
    {
        $entity = new User();
        $form   = $this->createCreateForm($entity);

        return $this->render('CUserBundle:Account:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Account entity.
     *
     */
    public function showAction($username)
    {
        $userManager = $this->get('fos_user.user_manager');
        $entity= $userManager->findUserByUsername($username);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Account entity.');
        }

        $deleteForm = $this->createDeleteForm($username);

        return $this->render('CUserBundle:Account:show.html.twig', array(
            'user'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Account entity.
     *
     */
    public function editAction(Request $request,$username)
    {

        $userManager = $this->get('fos_user.user_manager');
        $entity= $userManager->findUserByUsername($username);


        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');

        $editForm = $formFactory->createForm();
        $editForm->setData($entity)
                 ->remove('current_password')
                 /*->setAction($this->generateUrl('users_delete'))*/;

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $this->getDoctrine()->getManager()->flush();

             $this->addFlash('notice', 'لقد تمت العملية بنجاح');
            return $this->redirectToRoute('users_show', array('username' => $username));
        }
        elseif ($editForm->isSubmitted()) {

            $this->addFlash('error', 'هناك مشكل في إتمام العملية');

        }

        
        return $this->render('CUserBundle:Account:edit.html.twig', array(
            'user'      => $entity,
            'form'   => $editForm->createView(),
            //'delete_form' => $deleteForm->createView(),
        ));
    }

















    /**
     * Manages an account.
     *
     */
    public function manageAction(Request $request,$username)
    {
         $manager=$this->get('fos_user.user_manager');
         $entity=$manager->findUserByUsername($username);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Account entity.');
        }
        $manageForm = $this->createManageForm($entity);

        $manageForm->handleRequest($request);

        if ($manageForm->isValid()) {
            if($manageForm->get('adminRole')->isClicked()){

                //$roles=$manageForm['roles']->getData();
                //$this->manageRole($username);
                $manager->updateUser($entity);
                $this->addFlash('notice', 'لقد تمت العملية بنجاح');
            }
            elseif ($manageForm->get('status')->isClicked()) {
               $this->manageStatus($username);
               $manager->updateUser($entity);
            }
            else
                throw $this->createNotFoundException('Unable to find Account entity.');

            return $this->redirect($this->generateUrl('users'));
        }


        
    }

    /**
     * Enables/Disables an account.
     *
     */
    public function manageStatus($username)
    {
        $manager= $this->get('fos_user.user_manager');
        $entity=$manager->findUserByUsername($username);
        if($entity->isEnabled()){
            $entity->setEnabled(0);
        }
        else
            $entity->setEnabled(1);

        $em=$this->getDoctrine()->getManager();
        $manager->updateUser($entity);
         $this->addFlash('notice', 'لقد تمت العملية بنجاح');
        return $this->redirect($this->generateUrl('users'));
    }

    /**
     * attributes/revokes admin role to an account.
     *
     */
    public function manageRole($username)
    {
        $manager= $this->get('fos_user.user_manager');
        $entity=$manager->findUserByUsername($username);
        if($entity->hasRole('ROLE_ADMIN')){
            $entity->removeRole('ROLE_ADMIN');
        }
        else
            $entity->addRole('ROLE_ADMIN');

        $em=$this->getDoctrine()->getManager();
        $manager->updateUser($entity);
         $this->addFlash('notice', 'لقد تمت العملية بنجاح');
        return $this->redirect($this->generateUrl('users'));
    }

    /**
    * Creates a form to edit a Account entity.
    *
    * @param Account $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Account $entity)
    {
        $form = $this->createForm(new AccountType($entity), $entity, array(
            'action' => $this->generateUrl('users_update', array('username' => $entity->getUsername())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Account entity.
     *
     */
    public function updateAction(Request $request, $username)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CUserBundle:Account')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Account entity.');
        }

        $deleteForm = $this->createDeleteForm($username);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('users_edit', array('id' => $id)));
        }

        return $this->render('CUserBundle:Account:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Account entity.
     *
     */
    public function deleteAction(Request $request, $username)
    {
        $form = $this->createDeleteForm($username);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CUserBundle:Account')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Account entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('account'));
    }

    /**
     * Creates a form to delete a Account entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($username)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('users_delete', array('username' => $username)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
	
	public function changePassword()
	{
 return $this->render('CUserBundle:ChangePassword:changePassword.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));		
		
	}
}
