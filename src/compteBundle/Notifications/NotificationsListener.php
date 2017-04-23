<?php

// src/gestionCompteBundle/Notifications/NotificationsListener.php

namespace gestionCompteBundle\Notifications;


use Symfony\Component\HttpFoundation\Response;


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

    $this->notificationList  = 

  }


  public function processBeta()

  {

    $remainingDays = $this->endDate->diff(new \Datetime())->format('%d');


    if ($remainingDays <= 0) {

      // Si la date est dépassée, on ne fait rien

      return;

    }

    

    // Ici on appelera la méthode

    // $this->betaHTML->displayBeta()

  }

}