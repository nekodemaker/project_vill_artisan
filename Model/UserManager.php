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
    
    /*ADMIN FUNCTIONS*/
    public function getNumberOfVillager(){
        $res=$this->DBManager->findAllSecure("SELECT * FROM user where user_type=:type",[
        'type'=>"villager",
        ]);
        return count($res);
    }
    
    public function getNumberOfCrafter(){
        $res=$this->DBManager->findAllSecure("SELECT * FROM user where user_type=:type",[
        'type'=>"crafter",
        ]);
        return count($res);
    }
    
    public function getAllUsers(){
        $res=$this->DBManager->findAllSecure("SELECT * FROM user",[]);
        return $res;
    }
    
    
    public function checkPhotoRegisterCrafter($file){
        if(empty($file['profile-photo']['tmp_name'])){
            echo json_encode(['data' => "Il manque le photo de profil" ]);
            exit(0);
            return false;
        }else{
            foreach($file["workphoto"]["tmp_name"] as $key => $tmpname){
                if(empty($tmpname)){
                    echo json_encode(['data' => "Il manque une des 6 photos" ]);
                    exit(0);
                    return false;
                }else{
                    $extensions = array( 'image/jpg' , 'image/jpeg' , 'image/gif' , 'image/png' );
                    
                    if ($file['workphoto']['size'][$key] > 1048576){
                        echo json_encode(['data' => "Le fichier ".($key+1)." est trop gros" ]);
                        exit(0);
                    }
                    if (!in_array($file['workphoto']['type'][$key],$extensions)){
                        echo json_encode(['data' => "Le fichier ".($key+1)." doit être de type : jpg,jpeg,gif ou png" ]);
                        exit(0);
                    };
                    
                }
            }
            return true;
        }
    }
    
    public function userCheckRegisterCrafter($data,$file){
        if($this->userCheckRegister($data)){
            if(empty($data['job-crafter']) OR empty($data['crafter-history']) OR empty($data['crafter-shop'])){
                echo json_encode(['data' => "Il manque au moins un de ces champs : métier,histoire, et boutique " ]);
                exit(0);
                return false;
            }else{
                if($this->checkPhotoRegisterCrafter($file)){
                    return true;
                }
            }
        }else{
            return false;
        }
        
    }
    
    public function userRegisterCrafter($data,$file){
        //register the crafter as user
        $this->userRegister($data);
        //get the user and put other datas into the table crafter
        
    }
    
    /*END ADMIN FUNCTIONS*/
    
    
    /*function which returns the user data with id on parameters*/
    public function getUserById($id)
    {
        $id = (int)$id;
        $data = $this->DBManager->findOne("SELECT * FROM user WHERE id = ".$id);
        return $data;
    }
    
    /*function which returns the user data with mail on parameters*/
    public function getUserByMail($mail)
    {
        $data = $this->DBManager->findOneSecure("SELECT * FROM user WHERE mail = :mail",[
        'mail'=>$mail,
        ]);
        return $data;
    }
    
    /*function which returns true if $email exists in database, return true, else false */
    public function isMailExists($email)
    {
        $data = $this->DBManager->findAllSecure("SELECT * FROM user WHERE mail = :mail",
        ['mail' => $email,]);
        if(count($data)!=0){
            return true;
        }
        return false;
    }
    
    /*function which returns the user data with lastname and firstname data on parameters*/
    public function getUserByLastnameFirstname($lastname,$firstname)
    {
        $data = $this->DBManager->findAllSecure("SELECT * FROM user WHERE lastname = :lastname and firstname = :firstname",
        ['lastname' => $lastname,'firstname' => $firstname]);
        return $data;
    }
    
    /*function tests empty inputs, if user lastname/firstname already exists and if mail already exists  */
    public function userCheckRegister($data)
    {
        if (empty($data['user-type']) OR empty($data['lastname']) OR empty($data['firstname']) OR empty($data['passw']) OR
        empty($data['mail']) OR empty($data['adress']) OR empty($data['postcode']) OR empty($data['village-user'])){
            $_SESSION['error']="1";
            return false;
        }
        
        $dataUser=$this->getUserByLastnameFirstname($data['lastname'],$data['firstname']);
        if (count($dataUser) !=0 ){
            $_SESSION['error']="user already exists";
            return false;
        }
        
        
        if($this->isMailExists($data['mail'])){
            $_SESSION['error']="mail error";
            return false;
        }
        
        return true;
    }
    
    /*function which returns the crypted password */
    private function userHash($pass)
    {
        $hash = password_hash($pass, PASSWORD_BCRYPT, ['salt' => 'saltysaltysaltysalty!!']);
        return $hash;
    }
    
    /*function which put the users data on database (on table user) */
    public function userRegister($data)
    {
        $query="insert into `user`(`user_type`,`lastname`,`firstname`,`password`,`mail`,`adress`,`postcode`,`user_village`,`user_interet`,`user_pic`)values(:usertype,:lastname,:firstname,:password,:mail,:adress,:postcode,:village,:interet,:pic)";
        $d=([
        'usertype'=> $data['user-type'],
        'lastname'=> $data['lastname'],
        'firstname'=> $data['firstname'],
        'password'=> $this->userHash($data['passw']),
        'mail'=> $data['mail'],
        'adress'=> $data['adress'],
        'postcode'=> $data['postcode'],
        'village'=> $data['village-user'],
        'interet'=> "",
        'pic'=> "users/".$data['firstname'].$data['lastname']."/profile_pic/".$data['firstname'].$data['lastname'].".png",
        ]);
        $this->DBManager->do_query_db($query,$d);
        mkdir("users/".$data['firstname'].$data['lastname']);
        mkdir("users/".$data['firstname'].$data['lastname']."/profile_pic");
        copy("users/default_villageois.png","users/".$data['firstname'].$data['lastname']."/profile_pic/".$data['firstname'].$data['lastname'].".png");
    }
    
    public function userCheckLogin($data)
    {
        
        if (empty($data['mail']) OR empty($data['passw']))
            return false;
        $user = $this->getUserByMail($data['mail']);
        if ($user === false)
            return false;
        $hash = $this->userHash($data['passw']);
        if ($hash !== $user['password'])
        {
            return false;
        }
        return true;
    }
    
    public function userLogin($mail)
    {
        $data = $this->getUserByMail($mail);
        if ($data === false)
            return false;
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['firstname'] = $data['firstname'];
        $_SESSION['lastname'] = $data['lastname'];
        return true;
    }
    
    public function editProfileUser($data){
        if(!empty($data['email'])){
            if(!$this->isMailExists($data['email'])){
                $this->userChangeMail($data['email']);
            }
        }
        if(!empty($data['adress'])){
            $this->userChangeAdress($data['adress']);
        }
        if(!empty($data['postal_code'])){
            $this->userChangePostcode($data['postal_code']);
        }
        if($this->userCheckChangePassword($data)){
            $this->userChangePassword($data);
        }
    }
    
    
    public function userChangeMail($newmail){
        $query="update `user` set `mail`= :mail where `id`= :userid";
        $d=[
        'mail'=> $newmail,
        'userid'=> $_SESSION['user_id'],
        ];
        $res=$this->DBManager->do_query_db($query,$d);
    }
    
    public function userChangeAdress($newadress){
        $query="update `user` set `adress`= :adress where `id`= :userid";
        $d=[
        'adress'=> $newadress,
        'userid'=> $_SESSION['user_id'],
        ];
        $res=$this->DBManager->do_query_db($query,$d);
    }
    public function userChangePostcode($newpostcode){
        $query="update `user` set `postcode`= :postcode where `id`= :userid";
        $d=[
        'postcode'=> $newpostcode,
        'userid'=> $_SESSION['user_id'],
        ];
        $res=$this->DBManager->do_query_db($query,$d);
    }
    
    public function userChangeVillage($data){
        $vill="";
        if($data['new-village-user']!='NON'){
            $vill=utf8_decode($data['village-user']).','.utf8_decode($data['new-village-user']);
        }else{
            $vill=$data['village-user'];
        }
        $query="update `user` set `user_village`= :village where `id`= :userid";
        $d=[
        'village'=> $vill,
        'userid'=> $_SESSION['user_id'],
        ];
        $res=$this->DBManager->do_query_db($query,$d);
    }
    
    public function userCheckChangePassword($data)
    {
        if(empty($data['password']) or empty($data['password_confirmation'])){
            return false;
        }
        
        $oldPassword=$data['password'];
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
        $newPassword=$data['password'];
        $query="update `user` set `password`= :pass where `id`= :userid";
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
        $profile_pic_path="users/".$_SESSION['firstname'].$_SESSION['lastname']."/profile_pic/";
        $picExtension=pathinfo($data["my-pic"]["name"],PATHINFO_EXTENSION);
        $query="update `user` set `user_pic`= :pic where `id`= :userid";
        $d=[
        'pic'=> $profile_pic_path.$_SESSION['firstname'].$_SESSION['lastname'].".".$picExtension,
        'userid'=> $_SESSION['user_id'],
        ];
        $res=$this->DBManager->do_query_db($query,$d);
        $array_user_pic=scandir($profile_pic_path);
        unlink($profile_pic_path.$array_user_pic[2]);
        rename($data["my-pic"]["tmp_name"],$profile_pic_path.$_SESSION['firstname'].$_SESSION['lastname'].".".$picExtension);
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
    
    public function userGetProfile($id)
    {
        return $this->getUserById($id);
    }
    
    public function getAllVillages()
    {
        $data = $this->DBManager->findAllSecure("SELECT * FROM villages",[]);
        return $data;
    }
}