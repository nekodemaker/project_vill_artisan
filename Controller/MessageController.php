<?php

namespace Controller;

use Model\MessageManager;

class MessageController extends BaseController
{
    /*link with "sendMessageTo" route and charge the template profile.html.twig */
    public function sendMessageToAction()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $manager = MessageManager::getInstance();
            if ($manager->checkSendMessageTo($_POST))
            {
                $manager->sendMessageTo($_POST);
                $this->redirect('profile');
            }
            else {
                $error = "Il vous manque au moins un champ";
            }
        }
        if (!empty($_SESSION['user_id']))
        {
            $name=$_SESSION['lastname'];
        }else{
            $name="";
        }
        echo $this->renderView('profile.html.twig', ['error' => $error,'name' => $name,'messages'=>$messages]);
    }
    
}