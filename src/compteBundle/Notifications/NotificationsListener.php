<?php

// src/gestionCompteBundle/Notifications/NotificationsListener.php

namespace gestionCompteBundle\Notifications;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;


class NotificationsListener

{

  // Notre processeur

  protected $notificationsHTML;


  // La date de fin de la version bêta :

  // - Avant cette date, on affichera un compte à rebours (J-3 par exemple)

  // - Après cette date, on n'affichera plus le « bêta »

  protected $notificationList;


  public function __construct(notificationsHTML $notificationsHTML, $notificationList)

  {

    $this->notificationsHTML = $notificationsHTML;

    $this->notificationList  = $notificationList;

  }


  public function processNotif()

  {

     if (!$event->isMasterRequest()) {
      return;
    }
    $response = $event->getResponse();

 // On utilise notre BetaHRML
    $response = $this->notificationsHTML->displayNotifications($event->getResponse(), $notificationList);
    // On met à jour la réponse avec la nouvelle valeur
    $event->setResponse($response);
    

    // Ici on appelera la méthode

    // $this->betaHTML->displayBeta()

  }

}