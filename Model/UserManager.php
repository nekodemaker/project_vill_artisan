<?php
namespace Model;
error_reporting(~E_DEPRECATED);
class UserManager
{
    private $DBManager;
    
    private static $instance = null;
    public static function getInstance()
    {
        if (self::$instance === null)
            self::$instance = new UserManager();
        return self::$instance;
    }
    
    private function __construct()
    {
        $this->DBManager = DBManager::getInstance();
    }
    
    public function getUserById($id)
    {
        $id = (int)$id;
        $data = $this->DBManager->findOne("SELECT * FROM users WHERE id = ".$id);
        return $data;
    }
    
    public function getUserByUsername($username)
    {
        $data = $this->DBManager->findOneSecure("SELECT * FROM users WHERE username = :username",
        ['username' => $username]);
        return $data;
    }
    
    public function userCheckRegister($data)
    {
        if (empty($data['username']) OR empty($data['email']) OR empty($data['password']))
            return false;
        $data = $this->getUserByUsername($data['username']);
        if ($data !== false)
            return false;
        // TODO : Check valid email
        return true;
    }
    
    private function userHash($pass)
    {
        $hash = password_hash($pass, PASSWORD_BCRYPT, ['salt' => 'saltysaltysaltysalty!!']);
        return $hash;
    }
    
    public function userRegister($data)
    {
        $query="insert into `users`(`username`,`password`,`email`)values(:username,:password,:mail)";
        $d=([
        'username'=> $data['username'],
        'password'=> $this->userHash($data['password']),
        'mail'=> $data['email'],
        ]);
        $this->DBManager->do_query_db($query,$d);
        mkdir("users/".$data['username']);
        mkdir("users/".$data['username']."/profile_pic");
        copy("users/default_pic.png","users/".$data['username']."/profile_pic/".$data['username'].".png");
    }
    
    public function userCheckLogin($data)
    {

        if (empty($data['username']) OR empty($data['password']))
            return false;
        $user = $this->getUserByUsername($data['username']);
        if ($user === false)
            return false;
        $hash = $this->userHash($data['password']);
        if ($hash !== $user['password'])
        {
            return false;
        }
        return true;
    }
    
    public function userLogin($username)
    {
        $data = $this->getUserByUsername($username);
        if ($data === false)
            return false;
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        return true;
    }
    
    public function userCheckChangePassword($data)
    {
        if(empty($data['old-password']) or empty($data['new-password'])){
            return false;
        }
        
        $oldPassword=$data['old-password'];
        $user=$this->getUserById($_SESSION['user_id']);
        if ($user['password'] == $this->userHash($oldPassword))
        {
            return true;
        }else{
            return false;
        }
    }
    
    public function userChangePassword($data)
    {
        $newPassword=$data['new-password'];
        $query="update `users` set `password`= :pass where `id`= :userid";
        $d=[
        'pass'=> $this->userHash($newPassword),
        'userid'=> $_SESSION['user_id'],
        ];
        $res=$this->DBManager->do_query_db($query,$d);
    }
    
    public function userCheckProfilePic($data){
        $extensions = array( 'image/jpg' , 'image/jpeg' , 'image/gif' , 'image/png' );
        
        if ($data['my-pic']['size'] > 1048576) return false;
        if ( in_array($data['my-pic']['type'],$extensions)) return true;
        return false;
    }
    
    public function userChangeProfilePic($data){
        $profile_pic_path="./users/".$_SESSION['username']."/profile_pic/";
        $picExtension=pathinfo($data["my-pic"]["name"],PATHINFO_EXTENSION);
        $array_user_pic=scandir($profile_pic_path);
        unlink($profile_pic_path.$array_user_pic[2]);
        rename($data["my-pic"]["tmp_name"],$profile_pic_path.$_SESSION['username'].".".$picExtension);
    }
    
    public function getUserProfilePic($username){
        $profile_pic_array=scandir("./users/".$username."/profile_pic/");
        return "./users/".$username."/profile_pic/".$profile_pic_array[2];
    }
    
    public function userProfileCheck($username)
    {
        if (empty($username))
            return false;
        $user = $this->getUserByUsername($username);
        if (count($user) ==0)
            return false;
        return true;
    }
    
    public function userGetProfile($username)
    {
        return $this->getUserByUsername($username);
    }
}