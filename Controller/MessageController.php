<?php

namespace Controller;

use Model\MessageManager;

class MessageController extends BaseController
{
    /*link with "sendMessageTo" route and charge the template profile.html.twig */
    public function sendMessageToAction()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['user_id']))
        {
            $manager = MessageManager::getInstance();
            if ($manager->checkSendMessageTo($_POST))
            {
                
                $manager->sendMessageTo($_POST);
                $messages=$manager->getAllMessagesUserId($_POST['id-receiver']);
                echo json_encode(['messages' => $messages ]);
                exit(0);
            }
            else {
                echo json_encode(['error' => "empty" ]);
                exit(0);
            }
        }
    }    
}