<?php

namespace compteBundle\Controller;

use compteBundle\Entity\Morass;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use CUserBundle\Entity\User;
use compteBundle\Entity\ExpenseTransfer;
use compteBundle\Form\ExpenseTransferType;


/**
 * Morass controller.
 *
 */
class MorassController extends Controller
{



    /**
     * Migration between lines.
     *
     */
    public function lineTransferAction(Request $request, Morass $morass)
    {

        $user=$this->getUser();
        $expenseTransfer= new ExpenseTransfer();
        $expenseTransfer->setMorass($morass);

        $transferForm = $this->createForm(new ExpenseTransferType($morass), $expenseTransfer);
        $morassArray= $this->getMorass($morass,$user);



        $transferForm->handleRequest($request);
        if ($transferForm->isSubmitted() && $transferForm->isValid()) {

            // make sure the migration is between 2 different lines.
            $fromLine =$expenseTransfer->getFromLine();
            $toLine =$expenseTransfer->gettoLine();
            $amount= $expenseTransfer->getAmount();
            $lineAvailableAmount= $fromLine->getAmount() - $fromLine->getConsumedAmount(); 
                if($fromLine->getId() != $toLine->getId() && $lineAvailableAmount >= $amount ){

                    $fromlineAmount = $fromLine->getAmount();
                    $tolineAmount = $toLine->getAmount();

                    $fromLine->setAmount($fromlineAmount - $amount);
                    $toLine->setAmount($tolineAmount + $amount);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($expenseTransfer);
                    $em->persist($toLine);
                    $em->persist($fromLine);
                    $em->flush($expenseTransfer);
                    $em->flush($toLine);
                    $em->flush($fromLine);
                    $this->addFlash('notice', 'لقد تمت العملية بنجاح');
                    return $this->redirectToRoute('morass_line_transfer', array('id' => $morass->getId()));
                }
                elseif ($transferForm->isSubmitted() && $fromLine->getId() == $toLine->getId()) {

                    $this->addFlash('error', 'هناك مشكل في إتمام العملية : المرجو اختيار سطرين مختلفين');

                }

                  elseif ($transferForm->isSubmitted() && $fromLine->getAmount() >= $amount) {

                    $this->addFlash('error', 'هناك مشكل في إتمام العملية : السطر المحول منه لا يحتوي على المبلغ المطلوب');

                }

        }
        elseif ($transferForm->isSubmitted()) {

            $this->addFlash('error', 'هناك مشكل في إتمام العملية');

        }


        return $this->render('morass/lineTransfer.html.twig', array(
            'morass' => $morass,
          //  'delete_form' => $deleteForm->createView(),
            'paragraphs'=>$morassArray['paragraphs'],
            'lines'=>$morassArray['lines'],
            'colspan'=>$morassArray['colspan'],
            'morassAmount'=>$morassArray['morassAmount'],
            'userLines'=>$morassArray['userLines'],
            'form'=>$transferForm->createView(),
        ));
    }


     /**
     * Migration between lines.
     *
     */
    public function manageTransferAction()
    {
        //$em = $this->getDoctrine()->getManager();

        //$morass = $em->getRepository('compteBundle:Morass')->findOneById($id);
        $request = $this->getRequest();
        $fromParagraphIdl= $request->get('fromParagraph');
        $toParagraphIdl= $request->get('toParagraph');

        $em = $this->get('doctrine.orm.entity_manager');
        $fromParagraph=$lines=$em->getRepository('compteBundle:Paragraph')->findOneByIdp($fromParagraphIdl);
        $fromLines=$em->getRepository('compteBundle:Line')->findByParagraph($fromParagraph);
        $toParagraph=$lines=$em->getRepository('compteBundle:Paragraph')->findOneByIdp($toParagraphIdl);
        $toLines=$em->getRepository('compteBundle:Line')->findByParagraph($toParagraph);
        $fromLine= array();
        $toLine= array();
        foreach ($fromLines as $line) {
            $fromLine[$line->getId()]=$line->getIdl();
        }
        foreach ($toLines as $line) {
            $toLine[$line->getId()]=$line->getIdl();
        }
        $data = json_encode([$fromLine,$toLine]);
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($data);
        return $response;

    }


    /************************************** ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ **********************************************/










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
        $this->addFlash('notice', 'لقد تمت العملية بنجاح');
        return $this->redirectToRoute('morass_show', array('id' => $morass->getId()));

        }
        elseif ($form->isSubmitted()) {

            $this->addFlash('error', 'هناك مشكل في إتمام العملية');

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
        $user=$this->getUser();
        $deleteForm = $this->createDeleteForm($morass);
        $morassArray= $this->getMorass($morass,$user);
        return $this->render('morass/show.html.twig', array(
            'morass' => $morass,
            'delete_form' => $deleteForm->createView(),
            'paragraphs'=>$morassArray['paragraphs'],
            'lines'=>$morassArray['lines'],
            'colspan'=>$morassArray['colspan'],
            'morassAmount'=>$morassArray['morassAmount'],
            'userLines'=>$morassArray['userLines'],
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
        $this->addFlash('notice', 'لقد تمت العملية بنجاح');
        return $this->redirectToRoute('morass_show', array('id' => $morass->getId()));

        }
        elseif ($editForm->isSubmitted()) {

            $this->addFlash('error', 'هناك مشكل في إتمام العملية');

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
        $this->addFlash('notice', 'لقد تمت العملية بنجاح');
        }
        else {

            $this->addFlash('error', 'هناك مشكل في إتمام العملية');

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
	
	
	
	
	 public function getMorass(Morass $morass, User $user)
    {
		$repository = $this->getDoctrine()->getManager()->getRepository('compteBundle:Paragraph');

		$paragraphs=$repository->findByMorass($morass,array('idp' => 'ASC'));

        $morassAmount=0;

        if($user->getMasterEntity()->getId()){
        $repository = $this->getDoctrine()->getManager()->getRepository('compteBundle:Line');
        $userLines= $repository->getLinesByMasterEntitiesId($user)->getQuery()->getResult();
    }
		
		foreach( $paragraphs as $paragraph)
		{
			$repository = $this->getDoctrine()->getManager()->getRepository('compteBundle:Line');

			$lines[$paragraph->getId()]=$repository->findByParagraph($paragraph,array('idl' => 'ASC'));

            
			
		}
        foreach ($lines as $line) {
            foreach ($line as $amount) {
                $morassAmount += $amount->getAmount();
            }
        }
		
		$colspan = count($lines,COUNT_RECURSIVE)+1;
		
				
        return array(
            'morass' => $morass,
			'paragraphs' => $paragraphs,
			'lines' => $lines,
			'colspan'=>$colspan,
            'morassAmount'=>$morassAmount,
            'userLines'=>$userLines,
        );
    }
}
