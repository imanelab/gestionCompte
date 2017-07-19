<?php

namespace compteBundle\Controller;

use compteBundle\Entity\Movement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Notifications controller.
 *
 */
class NotificationsController extends Controller
{
    /**
     * Lists all user Notifications.
     *
     */
    public function indexAction()
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $movements = $em->getRepository('compteBundle:Movement')->findByUser($user);

        return $this->render('notifications/index.html.twig', array(
            'movements' => $movements,
        ));
    }


  
}
