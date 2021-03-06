<?php

namespace compteBundle\Controller;

use compteBundle\Entity\Movement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

/**
 * Movement controller.
 *
 */
class MovementController extends Controller
{
    /**
     * Lists all movement entities.
     *
     */
    public function indexAction()
    {
        $user = $this->getUser();
        $masterEntity= $user->getMasterEntity();

        $em = $this->getDoctrine()->getManager();

        $lines= $em->getRepository('compteBundle:Line')->getMasterEntities($masterEntity->getId())->getQuery()->getResult();



        

        $movements = $em->getRepository('compteBundle:Movement')->findByLine($lines);

        return $this->render('movement/index.html.twig', array(
            'movements' => $movements,
        ));
    }


    /**
     * Approve/Refuse a movement.
     *
     */
    public function processMovementAction()
    {

        $request = $this->get('request');        
          $id = $request->get('id');
          $choice = $request->get('choice');
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $movement= $em->getRepository('compteBundle:Movement')->findOneById($id);
        if ($choice == "approve") {
            $movement->setApproved(true);
        }
        elseif ($choice == "refuse") {
            $movement->setApproved(false);
        }
        $em->persist($movement);
        $em->flush();
        $response = array("code" => 100, "success" => true, "approved"=>$movement->getApproved());
        return new Response(json_encode($response)); 
    }


        /**
     * Generate a movement request.
     *
     */
    public function movementRequestAction(Movement $movement)
    {    

        $amount = $movement->getAmountMv();

        $N2LService = $this->container->get('gestionCompte.n2l.html');
        $amountLetters= $N2LService->convert_number($amount,'male');

        $name="bb";
        $object="cc";
         return $this->render('TransferHTML/movement_request.html.twig', array(
            'movement' => $movement,
            'amountLetters'=> $amountLetters,
            'name'=> $name,
            'object'=> $object,
        ));

       
    }



        /**
     * Generate a movement letter.
     *
     */
    public function movementLetterAction(Movement $movement)
    {

        $amount = $movement->getAmountMv();

        $N2LService = $this->container->get('gestionCompte.n2l.html');
        $amountLetters= $N2LService->convert_number($amount,'male');

        $name="bb";
        $object="cc";


        //regional or provincial
        $debitAccount= $movement->getDebitAccount();
        $delegation= $debitAccount ? $debitAccount->getDelegation(): null;
        if($delegation){
            if ($delegation->getDepth()==1) {
                $regional= "الجهوي";
                $region= $delegation->getName();
                $ofRegion= "لجهة";
            }
            else {
                $regional= "الإقليمي";
                $region= $delegation->getName();
                $ofRegion= "بإقليم";
            }
       
    }
         return $this->render('TransferHTML/movement_letter.html.twig', array(
            'movement' => $movement,
            'regional'=> $regional,
            'region'=> $region,
            'ofRegion'=> $ofRegion,
            'name'=> $name,
            'object'=> $object,
        ));
    }





    /**
    * Check the selected accounts
    *
    **/

    public function selectedAccount(Movement $movement, Request $request){
        $form = $this->createForm('compteBundle\Form\MovementType', $movement);
        $form->handleRequest($request);
        $selectDebitAccount=$form["selectDebitAccount"]->getData();
        $selectCreditAccount=$form["selectCreditAccount"]->getData();
        if ($selectDebitAccount=="1")
            $movement->unsetAccount("DEA");
        elseif ($selectDebitAccount=="2")
            $movement->unsetAccount("DA");

        if ($selectCreditAccount=="1")
            $movement->unsetAccount("CEA");
        elseif ($selectCreditAccount=="2")
            $movement->unsetAccount("CA");

    }


    /**
     * Creates a new movement entity.
     *
     */
    public function newAction(Request $request)
    {
        $movement = new Movement();
        $form = $this->createForm('compteBundle\Form\MovementType', $movement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //$userEntity= $currentUser->getMasterEntity();
           // $userEntityDepth = $userEntity->getDepth();
            $user = $this->getUser();

            // if the current user is not a supervisor so it requires an approver
            if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPERVISOR')) {
                $em = $this->getDoctrine()->getManager();
                $movement->setValidation(true);
                $masterEntity= $user->getMasterEntity();
                $validator= $em->getRepository('CUserBundle:User')->getMasterEntitySupervisor($masterEntity)->getQuery()->getSingleResult();
                if($validator)
                $movement->setValidator($validator);
                else
                throw $this->createNotFoundException('This user doesn\'t have a validator please specify one before');
            }
            else{
                $movement->setValidator(null);
                $movement->setValidation(false);
            }
                 
            $movement->setUser($user);
            $oldConsumedAmount = $movement->getLine()->getConsumedAmount();
            $currentConsumedAmount= $oldConsumedAmount +$movement->getAmountMv();
            $movement->getLine()->setConsumedAmount($currentConsumedAmount);

            $this->selectedAccount($movement, $request);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($movement);
            $em->flush();

            $this->addFlash('notice', 'لقد تمت العملية بنجاح');
            return $this->redirectToRoute('movement_show', array('id' => $movement->getId()));

        }
        elseif ($form->isSubmitted()) {

            $this->addFlash('error', 'هناك مشكل في إتمام العملية');

        }
        return $this->render('movement/new.html.twig', array(
            'movement' => $movement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a movement entity.
     *
     */
    public function showAction(Movement $movement)
    {
        $deleteForm = $this->createDeleteForm($movement);

        return $this->render('movement/show.html.twig', array(
            'movement' => $movement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing movement entity.
     *
     */
    public function editAction(Request $request, Movement $movement)
    {
        $deleteForm = $this->createDeleteForm($movement);
        $editForm = $this->createForm('compteBundle\Form\MovementType', $movement);


// do not have to change the accounts when editing
        $editForm->remove('creditAccount');
        $editForm->remove('debitAccount');
        $editForm->remove('creditEAccount');
        $editForm->remove('debitEAccount');
        $editForm->remove('selectCreditAccount');
        $editForm->remove('selectDebitAccount');

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', 'لقد تمت العملية بنجاح');
            return $this->redirectToRoute('movement_show', array('id' => $movement->getId()));

        }
        elseif ($editForm->isSubmitted()) {

            $this->addFlash('error', 'هناك مشكل في إتمام العملية');

        }

        return $this->render('movement/edit.html.twig', array(
            'movement' => $movement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a movement entity.
     *
     */
    public function deleteAction(Request $request, Movement $movement)
    {
        $form = $this->createDeleteForm($movement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($movement);
            $em->flush($movement);
        $this->addFlash('notice', 'لقد تمت العملية بنجاح');
        }
        else {

            $this->addFlash('error', 'هناك مشكل في إتمام العملية');

        }

        return $this->redirectToRoute('movement_index');
    }

    /**
     * Creates a form to delete a movement entity.
     *
     * @param Movement $movement The movement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Movement $movement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('movement_delete', array('id' => $movement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
