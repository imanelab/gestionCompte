<?php

namespace compteBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;



/**
 * Account controller.
 *
 */
class N2LController extends Controller
{

    public function indexAction()
    {
        $N2LService = $this->container->get('gestionCompte.n2l.html');
        $numbrToLetter= $N2LService->convert_number(1992,'male');

        return $this->render('N2L/index.html.twig', array(
            'n2l' => $numbrToLetter,
        ));
    }


}
