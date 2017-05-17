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
                $manager->userLogin($_POST['username']);
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
    
    public function editProfileAction()
    {
        $error = '';
        if(!empty($_SESSION['user_id'])){
            $manager = UserManager::getInstance();
            $user=$manager->userGetProfile($_SESSION['username']);
            $profile_pic=$manager->getUserProfilePic($_SESSION['username']);
            echo $this->renderView('profile_edit.html.twig', ['name' => $_SESSION['username'],'user' => $user,'profilepic' => $profile_pic]);
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
        
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $manager = UserManager::getInstance();
            if ($manager->userProfileCheck($_POST['author-name']))
            {
                $user=$manager->userGetProfile($_POST['author-name']);
                $profileToShow=[$user['username'],$user['email']];
                $profile_pic=$manager->getUserProfilePic($user['username']);

                if(!empty($_SESSION['username'])){
                    echo $this->renderView('profile.html.twig', ['profileToShow' => $profileToShow,'name' => $_SESSION['username'],'profilepic' => $profile_pic]);
                }else{
                    echo $this->renderView('profile.html.twig', ['profileToShow' => $profileToShow,'profilepic' => $profile_pic]);
                }
            }
            else {
                $error = "That profile doesn't exist";
                echo $this->renderView('profile.html.twig', ['error' => $error]);
            }
        }else{
            $error = "Not POST";
        }
    }

        public function artisanProfileAction()
    {
        $error = '';
        echo $this->renderView('artisan_profile.html.twig', []);
    }
}