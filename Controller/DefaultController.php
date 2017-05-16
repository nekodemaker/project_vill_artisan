<?php

namespace Controller;

use Model\UserManager;
use Model\ArticleManager;

class DefaultController extends BaseController
{
    public function homeAction()
    {
        $managerArticle=ArticleManager::getInstance();
        $articles = $managerArticle->getAllArticles();
        if (!empty($_SESSION['user_id']))
        {
            $manager = UserManager::getInstance();
            $user = $manager->getUserById($_SESSION['user_id']);
            echo $this->renderView('home.html.twig',
            ['name' => $user['username'],'articles' => $articles]);
        }
        else
            echo $this->renderView('home.html.twig',
        ['articles' => $articles]);
    }
    
    public function blogAction()
    {
        
        echo $this->renderView('blog.html.twig',
        []);
    }
}