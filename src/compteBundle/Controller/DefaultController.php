<?php

namespace compteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('::index.html.twig');
    }

      public function historyAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity= $em->getRepository('Gedmo\Loggable\Entity\LogEntry')->findAll();
        return $this->render(':history:index.html.twig',array('entities'=>$entity));
    }
}
