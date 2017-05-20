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
            ['name' => $user['lastname'],'articles' => $articles]);
        }
        else
            echo $this->renderView('home.html.twig',
        ['articles' => $articles]);
    }
    
    public function adminAction()
    {
         $manager = UserManager::getInstance();
        $numbervillager = $manager->getNumberOfVillager();
        $numbercrafter = $manager->getNumberOfCrafter();
        echo $this->renderView('admin.html.twig',['numbervillager'=>$numbervillager,'numbercrafter'=>$numbercrafter]);
    }
    
    public function blogAction()
    {
        if (!empty($_SESSION['user_id'])){
            echo $this->renderView('blog.html.twig',
            ['name'=>$_SESSION['lastname'],'firstname'=>$_SESSION['lastname']]);
        }else{
            echo $this->renderView('blog.html.twig',
            []);
        }
        
    }
    
    public function aboutAction()
    {
        
        if (!empty($_SESSION['user_id'])){
            echo $this->renderView('about.html.twig',
            ['name'=>$_SESSION['lastname']]);
        }else{
            echo $this->renderView('about.html.twig',
            []);
        }
    }
}