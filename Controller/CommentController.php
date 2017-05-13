<?php

namespace Controller;

use Model\CommentManager;
use Model\ArticleManager;

class CommentController extends BaseController
{
    
    public function createCommentAction()
    {
        $error = '';
        if(!empty($_SESSION['user_id'])){
            if ($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $manager = CommentManager::getInstance();
                if ($manager->createCommentCheck($_POST))
                {
                    $manager->createComment($_POST);
                    $commentsToShow = $manager->getComments($_POST['id-article']);
                    $articleManager = ArticleManager::getInstance();
                    $articleToShow=$articleManager->getArticle($_POST['id-article']);
                    //$this->redirect('home');
               }
               else {
                   $error = "One of things is empty";
                }
            }
            echo $this->renderView('article.html.twig', ['error' => $error,'name' => $_SESSION['username'],'articleToShow' => $articleToShow,'commentsToShow' => $commentsToShow]);
        }else{
            $this->redirect('home');
        }
    }

    public function deleteCommentAction()
    {
        $error = '';
        if(!empty($_SESSION['user_id'])){
            if ($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $manager = CommentManager::getInstance();
                if ($manager->commentCheck($_POST))
                {
                    $manager->deleteComment($_POST);
                    $commentsToShow = $manager->getComments($_POST['id-article']);
                    $articleManager = ArticleManager::getInstance();
                    $articleToShow=$articleManager->getArticle($_POST['id-article']);
               }
               else {
                   $error = "One of things is empty";
                }
            }
            echo $this->renderView('article.html.twig', ['error' => $error,'name' => $_SESSION['username'],'articleToShow' => $articleToShow,'commentsToShow' => $commentsToShow]);
        }else{
            $this->redirect('home');
        }
    }

}