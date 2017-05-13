<?php

namespace Controller;

use Model\ArticleManager;
use Model\CommentManager;

class ArticleController extends BaseController
{
    
    public function createArticleAction()
    {
        $error = '';
        if(!empty($_SESSION['user_id'])){
            if ($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $manager = ArticleManager::getInstance();
                if ($manager->createArticleCheck($_POST))
                {
                    $manager->createArticle($_POST,$_FILES);
                    $this->redirect('home');
                }
                else {
                    $error = "One of things is empty";
                }
            }
            echo $this->renderView('article_create.html.twig', ['error' => $error,'name' => $_SESSION['username']]);
        }else{
            $this->redirect('home');
        }
    }
    
    public function showArticleAction()
    {
        
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            $manager = ArticleManager::getInstance();
            if ($manager->articleCheck($_GET['id_article']))
            {
                $managerComment=CommentManager::getInstance();
                $commentsToShow = $managerComment->getComments($_GET['id_article']);
                $articleToShow=$manager->getArticle($_GET['id_article']);
                
                if(!empty($_SESSION['username'])){
                    echo $this->renderView('article.html.twig', ['articleToShow' => $articleToShow,'name' => $_SESSION['username'],'commentsToShow' => $commentsToShow]);
                }else{
                    echo $this->renderView('article.html.twig', ['articleToShow' => $articleToShow,'commentsToShow' => $commentsToShow]);
                }
            }
            else {
                $error = "That article doesn't exist";
                echo $this->renderView('article.html.twig', ['error' => $error]);
            }
        }else{
            $error = "Not POST";
        }
    }
    
    public function editArticleAction()
    {
        $error = '';
        if(!empty($_SESSION['user_id'])){
            if ($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $manager = ArticleManager::getInstance();
                if ($manager->createArticleCheck($_POST))
                {
                    $manager->editArticle($_POST);
                    $this->redirect('home');
                }
                else {
                    $error = "One of things is empty";
                }
            }
            if(!empty($_GET['idarticle'])){
                $manager = ArticleManager::getInstance();
                $article=$manager->getArticle($_GET['idarticle']);
            }
            echo $this->renderView('article_edit.html.twig', ['error' => $error,'name' => $_SESSION['username'],'article' =>$article]);
        }else{
            $this->redirect('home');
        }
    }
    
}