<?php

namespace Controller;

use Model\UserManager;
use Model\MessageManager;

class SecurityController extends BaseController
{

        public function adminLoginAction()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $manager = UserManager::getInstance();
            if ($manager->userCheckLoginAdmin($_POST))
            {
                $manager->userLoginAdmin($_POST['mail']);
                $this->redirect('admin');
            }
            else {
                $error = "Invalid username or password";
                echo $this->renderView('admin.html.twig', ['error' => $error]);
            }
        }
    }

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
    
        public function deleteUserAction()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $manager = UserManager::getInstance();
            if ($manager->userCheckDeleteUser($_POST))
            {
                $manager->userDelete($_POST);
                echo json_encode(['data' => "Delete user good" ]);
                exit(0);
            }
            else {
                echo json_encode(['data' => "Delete user not good" ]);
                exit(0);
                //$error = "Invalid data";
            }
        }
        echo $this->renderView('profile.html.twig', ['error' => $error]);
    }

        public function registerCrafterAction()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $manager = UserManager::getInstance();
            if ($manager->userCheckRegisterCrafter($_POST,$_FILES))
            {
                $manager->userRegisterCrafter($_POST,$_FILES);
                //$this->redirect('home');
                echo json_encode(['data' => "Check register good" ]);
                exit(0);
            }
            else {
                 echo json_encode(['data' => "Check register not good" ]);
                exit(0);
                //$error = "Invalid data";
            }

        }
        echo $this->renderView('register.html.twig', ['error' => $error]);
    }

    public function profileAction()
    {
        $error = '';
        if(!empty($_SESSION['user_id'])){
            $manager = UserManager::getInstance();
            $managerMessage = MessageManager::getInstance();
            $user=$manager->userGetProfile($_SESSION['user_id']);
            $villages=$manager->getAllVillages();
            $messages=$managerMessage->getAllMessagesForUser();
            if(strpos($user['user_village'],',')){
                $vill=explode(",",$user['user_village']);
                $first=$vill[0];
                $second=$vill[1];
            }else{
                $first=$user['user_village'];
                $second="";
            }
            echo $this->renderView('profile.html.twig', ['name' => $_SESSION['lastname'],'user' => $user,'village_first' => $first,'village_second' => $second,'villages' => $villages,'messages' => $messages]);
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
            $user=$manager->userGetProfile($_SESSION['user_id']);
            $villages=$manager->getAllVillages();
            if(strpos($user['user_village'],',')){
                $vill=explode(",",$user['user_village']);
                $first=$vill[0];
                $second=$vill[1];
            }else{
                $first=$user['user_village'];
                $second="";
            }
            if ($manager->userCheckProfilePic($_FILES))
            {
                $manager->userChangeProfilePic($_FILES);
                $this->redirect('profile');

            }
            else {
                $error = "Invalid Format";
            }
        }
        
        echo $this->renderView('profile.html.twig', ['name' => $_SESSION['lastname'],'user' => $user,'village_first' => $first,'village_second' => $second,'villages' => $villages]);
    }
        
    public function artisanProfileAction()
    {
        $error = '';
        $manager = UserManager::getInstance();
        if (!empty($_SESSION['user_id'])){
           $name=$_SESSION['lastname'];
        }else{
            $name="";
        }
         if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            if(!empty($_GET['id'])){
            $usercrafter=$manager->getUserById($_GET['id']);
            $crafter=$manager->getCrafterById($_GET['id']);
            $crafter['crafter_village']=utf8_encode($crafter['crafter_village']);
            $photosWork=explode(",",$crafter['crafter_photo_work']);
            if(count($usercrafter) != 0){
               echo $this->renderView('artisan_profile.html.twig', ['name' => $name,'usercrafter'=>$usercrafter,'crafter'=>$crafter,'photosWork'=>$photosWork]);
            }else{
                echo $this->renderView('artisan_profile.html.twig', ['name' => $name]);
            }
            }else{
                $this->redirect('home');
            }
        }
    }
    
    public function editProfileAction()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $manager = UserManager::getInstance();
            $errors=$manager->editProfileUser($_POST);
            $user=$manager->userGetProfile($_SESSION['user_id']);
            $villages=$manager->getAllVillages();
            if(strpos($user['user_village'],',')){
                $vill=explode(",",$user['user_village']);
                $first=$vill[0];
                $second=$vill[1];
            }else{
                $first=$user['user_village'];
                $second="";
            }
        }
        echo $this->renderView('profile.html.twig', ['name' => $_SESSION['lastname'],'errors'=>$errors,'user'=>$user,'village_first' => $first,'village_second' => $second,'villages' => $villages]);
    }
    
      public function getSpecialitiesAction()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            $manager = UserManager::getInstance();
            $spec=$manager->userGetSpecialities();
                echo json_encode(['data' => $spec ]);
                exit(0);
        }
    }
    
}