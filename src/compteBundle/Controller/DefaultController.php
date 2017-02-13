<?php

namespace compteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('compteBundle:Default:index.html.twig');
    }
}
