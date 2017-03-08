<?php

namespace CUserBundle\Controller;

use CUserBundle\Entity\User;
use CUserBundle\Form\RegistrationType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
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


     /* Creates a new User entity.
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

            return $this->redirect($this->generateUrl('User_show', array('id' => $entity->getId())));
        }

        return $this->render('EAIusersBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a User entity.
     *
     * @param User $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(User $entity)
    {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('User_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Creates a form to manage a User entity.
     *
     * @param User $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createManageForm(User $entity)
    {
         $form = $this->createForm(new RegistrationType(), $entity, array(
            'action' => $this->generateUrl('c_user_manage',array('username'=>$entity->getUsername())),
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

        return $this->render('EAIusersBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction($username)
    {
        $userManager = $this->get('fos_user.user_manager');
        $entity= $userManager->findUserByUsername($username);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($username);

        return $this->render('EAIusersBundle:User:show.html.twig', array(
            'user'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($username)
    {

        $userManager = $this->get('fos_user.user_manager');
        $entity= $userManager->findUserByUsername($username);


        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');

        $editForm = $formFactory->createForm();
        $editForm->setData($entity)
                 ->remove('current_password')
                 /*->setAction($this->generateUrl('User_delete'))*/;

        //$editForm->handleRequest($request);
        
        return $this->render('EAIusersBundle:User:edit.html.twig', array(
            'user'      => $entity,
            'form'   => $editForm->createView(),
            //'delete_form' => $deleteForm->createView(),
        ));
    }

















    /**
     * Manages an User.
     *
     */
    public function manageAction(Request $request,$username)
    {
         $manager=$this->get('fos_user.user_manager');
         $entity=$manager->findUserByUsername($username);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        $manageForm = $this->createManageForm($entity);

        $manageForm->handleRequest($request);

        if ($manageForm->isValid()) {
            if($manageForm->get('adminRole')->isClicked()){
                $this->manageRole($username);
                $manager->updateUser($entity);
            }
            elseif ($manageForm->get('status')->isClicked()) {
               $this->manageStatus($username);
               $manager->updateUser($entity);
            }
            else
                throw $this->createNotFoundException('Unable to find User entity.');

            return $this->redirect($this->generateUrl('User'));
        }


        
    }

    /**
     * Enables/Disables an User.
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
        $this->get('session')->getFlashBag()->add(
            'notice',
            'Vos changements ont été sauvegardés!');
        return $this->redirect($this->generateUrl('User'));
    }

    /**
     * attributes/revokes admin role to an User.
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
        $this->get('session')->getFlashBag()->add(
            'notice',
            'Vos changements ont été sauvegardés!');
        return $this->redirect($this->generateUrl('User'));
    }

    /**
    * Creates a form to edit a User entity.
    *
    * @param User $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(User $entity)
    {
        $form = $this->createForm(new UserType($entity), $entity, array(
            'action' => $this->generateUrl('User_update', array('username' => $entity->getUsername())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing User entity.
     *
     */
    public function updateAction(Request $request, $username)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EAIusersBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($username);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('User_edit', array('id' => $id)));
        }

        return $this->render('EAIusersBundle:User:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction(Request $request, $username)
    {
        $form = $this->createDeleteForm($username);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EAIusersBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('User'));
    }

    /**
     * Creates a form to delete a User entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($username)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('User_delete', array('username' => $username)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
