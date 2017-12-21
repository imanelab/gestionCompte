<?php

// src/gestionCompteBundle/Notifications/NotificationsHTML.php


namespace compteBundle\Notifications;


use Symfony\Component\HttpFoundation\Response;


class NotificationsHTML

{

  // Méthode pour ajouter le « bêta » à une réponse

  public function displayNotifications(Response $response, $notificationsList)

  {
    $i=0;
    $content = $response->getContent();
    $html="";

    // Code à rajouter
                       // <span>"+$notification->getSubmitterName()+"</span>
    if($notificationsList)
      {
        foreach ($notificationsList as $notification) {
      $html .= "<li>
                  <a>
                    <span class=\"message\"> From: ".
                    ($notification->getCreditAccount()? $notification->getCreditAccount()->getRib():"").
                    "</span><span class=\"message\"> to: ".($notification->getDebitAccount()? $notification->getDebitAccount()->getRib():"").
                    "</span><span class=\"message\"> Amount: ".$notification->getAmountMv()."</span><span class=\"time\"> by: ".($notification->getUser()? $notification->getUser()->getFirstName():"").
                    "</span>
                  </a>
                </li>";
      $i++;
    }
    $notificationsNumber= " <span id=\"notificationsNumber\" class=\"badge bg-green\">$i</span> ";
  }
  else
     $html ="<li>
                <a>
                  <span class=\"message\">nothing to show
                    </span>
                </a>
              </li>";

    // Insertion du code dans la page, dans le premier <h1>

    $content = preg_replace('#<li dir="rtl" id="notifications">(.*?)</li>#is',$html,$content);
    $content = preg_replace('#<span id="notificationsNumber" class="badge bg-green">(.*?)</span>#is',$notificationsNumber,$content);
   // $content = preg_replace('#<body">(.*)</body>#iU',$html,$content,1);


    // Modification du contenu dans la réponse

    $response->setContent($content);


    return $response;

  }

}


                   