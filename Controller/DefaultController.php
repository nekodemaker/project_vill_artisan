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
        $manager = UserManager::getInstance();
        $markers=$manager->getAllCraftersForMarkerMap();
        if (!empty($_SESSION['user_id']))
        {
            $manager = UserManager::getInstance();
            $user = $manager->getUserById($_SESSION['user_id']);
            echo $this->renderView('home.html.twig',
            ['name' => $user['firstname'],'articles' => $articles,'markers'=>$markers]);
        }
        else
            echo $this->renderView('home.html.twig',
        ['articles' => $articles,'markers'=>$markers]);
    }
    
    public function getMarkerAction()
    {
        $manager = UserManager::getInstance();
        $markers=$manager->getAllCraftersForMarkerMap();
        echo json_encode(['data' => $markers ]);
        exit(0);
    }
    
    public function adminAction()
    {
        if(!empty($_SESSION['admin-id'])){
        $manager = UserManager::getInstance();
        $numbervillager = $manager->getNumberOfVillager();
        $numbercrafter = $manager->getNumberOfCrafter();
        $users=$manager->getAllUsers();
        $villages=$manager->getAllVillages();
        
        echo $this->renderView('admin.html.twig',['numbervillager'=>$numbervillager,'numbercrafter'=>$numbercrafter,'users'=>$users,'villages'=>$villages]);
        }else{
            echo $this->renderView('adminLogin.html.twig',[]);
        }
    }
    
    public function blogAction()
    {
        $manager = ArticleManager::getInstance();
        $articles=$manager->getAllArticles();
        if (!empty($_SESSION['user_id'])){
            echo $this->renderView('blog.html.twig',
            ['name'=>$_SESSION['lastname'],'firstname'=>$_SESSION['lastname'],'articles'=>$articles]);
        }else{
            echo $this->renderView('blog.html.twig',
            ['articles'=>$articles]);
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