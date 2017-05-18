<?php

namespace Controller;

use Model\UserManager;

class SecurityController extends BaseController
{
    public function loginAction()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $manager = UserManager::getInstance();
            if ($manager->userCheckLogin($_POST))
            {
                $manager->userLogin($_POST['mail']);
                $this->redirect('home');
            }
            else {
                $error = "Invalid username or password";
            }
        }
        echo $this->renderView('login.html.twig', ['error' => $error]);
    }
    
    public function logoutAction()
    {
        session_destroy();
        echo $this->redirect('login');
    }
    
    public function registerAction()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $manager = UserManager::getInstance();
            if ($manager->userCheckRegister($_POST))
            {
                $manager->userRegister($_POST);
                $this->redirect('home');
            }
            else {
                $error = "Invalid data";
            }
        }
        echo $this->renderView('register.html.twig', ['error' => $error]);
    }
    
    public function profileAction()
    {
        $error = '';
        if(!empty($_SESSION['user_id'])){
            $manager = UserManager::getInstance();
            $user=$manager->userGetProfile($_SESSION['user_id']);
            echo $this->renderView('profile.html.twig', ['name' => $_SESSION['lastname'],'user' => $user]);
        }else{
            $this->redirect('home');
        }
    }
    
    public function changePasswordAction()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $manager = UserManager::getInstance();
            if ($manager->userCheckChangePassword($_POST))
            {
                $manager->userChangePassword($_POST);
            }
            else {
                $error = "Invalid Format";
            }
        }
        
        echo $this->renderView('profile_edit.html.twig', ['error' => $error,'name' => $_SESSION['username']]);
    }
    
    
    public function changeProfilePicAction()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $manager = UserManager::getInstance();
            if ($manager->userCheckProfilePic($_FILES))
            {
                $manager->userChangeProfilePic($_FILES);
            }
            else {
                $error = "Invalid Format";
            }
        }
        
        echo $this->renderView('profile_edit.html.twig', ['error' => $error,'name' => $_SESSION['username']]);
    }
    
    public function showProfileAction()
    {
    }
    
    public function artisanProfileAction()
    {
        $error = '';
        echo $this->renderView('artisan_profile.html.twig', []);
    }
    
    public function editProfileAction()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $manager = UserManager::getInstance();
            $errors=$manager->editProfileUser($_POST);
            $user=$manager->userGetProfile($_SESSION['user_id']);
        }
        echo $this->renderView('profile.html.twig', ['name' => $_SESSION['lastname'],'errors'=>$errors,'user'=>$user]);
    }
}