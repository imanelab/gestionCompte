<?php

// src/gestionCompteBundle/Notifications/NotificationsListener.php

namespace compteBundle\Notifications;


use compteBundle\Entity\Movement;
use CUserBundle\Entity\User;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\ORM\EntityManager;


class NotificationsListener

{

  // Notre processeur

  protected $notificationsHTML;


  // La date de fin de la version bêta :

  // - Avant cette date, on affichera un compte à rebours (J-3 par exemple)

  // - Après cette date, on n'affichera plus le « bêta »

     protected $currentUser;
     protected $notificationsList;
     protected $tokenStorage;
      protected $em;

/**
 * @InjectParams
 */

  public function __construct(notificationsHTML $notificationsHTML, EntityManager $entityManager, TokenStorage $tokenStorage)

  {

    $this->tokenStorage= $tokenStorage;
    $this->notificationsHTML=$notificationsHTML;
    $this->em= $entityManager;

  }


  public function processNotif(FilterResponseEvent $event)

  {

     if (!$event->isMasterRequest()) {
      return;
    }
     if (null === $this->tokenStorage->getToken()) {

        /* $response = $event->getResponse();
          $response->setContent("<html><body>rien</body></html>");
          $event->setResponse($response);*/
            return array();
        }
     $this->currentUser = $this->tokenStorage->getToken()->getUser();
     if (!$this->currentUser instanceof User) {
      return;
    }
    //$this->notificationsList = $this->em->getRepository('compteBundle:Movement')->findAll();
    $this->notificationsList = $this->em->getRepository('compteBundle:Movement')->findByValidator($this->currentUser);

     if (!$this->notificationsList) {
      return;
    }
    $response = $event->getResponse();
  
 // On utilise notre BetaHRML
    $response = $this->notificationsHTML->displayNotifications($event->getResponse(), $this->notificationsList);
    // On met à jour la réponse avec la nouvelle valeur
    $event->setResponse($response);
    

  }

}