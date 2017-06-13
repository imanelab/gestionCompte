<?php

// src/gestionCompteBundle/Notifications/NotificationsHTML.php


namespace gestionCompteBundle\Notifications;


use Symfony\Component\HttpFoundation\Response;


class NotificationsHTML

{

  // Méthode pour ajouter le « bêta » à une réponse

  public function displayNotifications(Response $response, $notificationList)

  {

    $content = $response->getContent();


    // Code à rajouter
    foreach ($notificationList as $notification) {
      $html +="<li>
                <a>
                  <span>
                    <span>"+$notification['submitterName']+"</span>
                  </span>
                  <span class="message">
                    "+$notification['creditAccount']+" to "+$notification['debitAccount']+" by: "+$notification['debitAccount']+"
                  </span>
                </a>
              </li>";
    }

    // Insertion du code dans la page, dans le premier <h1>

    $content = preg_replace('#<li id="test">(.*?)</li>#iU',$html,$content,1);


    // Modification du contenu dans la réponse

    $response->setContent($content);


    return $response;

  }

}