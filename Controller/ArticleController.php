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
                    echo json_encode(['success' => "L'article est écrit" ]);
                    exit(0);
                }
                else {
                    echo json_encode(['error' => "Au moins un des champs est manquant",'post'=>$_POST['text-article']]);
                    exit(0);
                }
            }else{
                echo json_encode(['error' => "Ce n'est pas la requete post" ]);
                exit(0);
            }
        }else{
            //$this->redirect('home');
        }
    }
    
    public function showArticleAction()
    {
        $error = '';
        $manager = ArticleManager::getInstance();
        if (!empty($_SESSION['user_id'])){
            $name=$_SESSION['lastname'];
        }else{
            $name="";
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            if(!empty($_GET['id'])){
                $article=$manager->getArticle(($_GET['id']));
                echo $this->renderView('article.html.twig', ['name' => $name,'article'=>$article]);
            }else{
                $this->redirect('home');
            }
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