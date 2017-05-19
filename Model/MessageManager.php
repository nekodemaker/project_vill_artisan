<?php
namespace Model;

class MessageManager
{
    private $DBManager;
    
    private static $instance = null;
    public static function getInstance()
    {
        if (self::$instance === null)
            self::$instance = new MessageManager();
        return self::$instance;
    }
    
    private function __construct()
    {
        $this->DBManager = DBManager::getInstance();
    }

    /*function which returns the user data with id on parameters*/
    public function getUserById($id)
    {
        $id = (int)$id;
        $data = $this->DBManager->findOne("SELECT * FROM user WHERE id = ".$id);
        return $data;
    }

    /*function which returns true if the hidden input id of the receiver and the input of text message are not empty */
    function checkSendMessageTo($data){
        if(!empty($data['id-receiver']) and !empty($data['text-message'])){
            return true;
        }else{
            return false;
        }
    }
    
    /*function which put on database the message fron the sender to the receiver, with the date and the text*/
    function sendMessageTo($data){
        $q="insert into `message`(`id_sender`,`id_receiver`,`text_message`,`date_message`)values(:authorid,:iddest,:text,NOW())";
        $d=[
        'authorid'=>$_SESSION['user_id'],
        'iddest'=>$data['id-receiver'],
        'text'=>$data['text-message'],
        ];
        $this->DBManager->do_query_db($q,$d);
    }
    
    /*function which returns all the messages related to the user(by id) */
    function getAllMessagesForUser(){
        $array_users=$this->getAllUserIdWithMe();
        $len=count($array_users);
        $res=[];
        for($i=0;$i<$len;$i++){
            $userId=$this->getUserById($array_users[$i]['id_receiver']);
            $tabMessages=$this->getAllMessagesUserId($array_users[$i]['id_receiver']);
            $elem=array("lastname"=>$userId['lastname'],"firstname"=>$userId['firstname'],"id"=>$userId['id'],"messages"=>$tabMessages);
            array_push($res,$elem);
        }
        return $res;
    }
    
    function getAllMessages(){
        $q="select * from message";
        $d=[];
        $data=$this->DBManager->findAllSecure($q,$d);
        return $data;
    }
    
    /*function which returns all messages between user connected and another user by id*/
    function getAllMessagesUserId($userid){
        $q="select * from message where (id_sender=:idsend and id_receiver=:idrecei) or (id_sender=:idsendtwo and id_receiver=:idreceitwo)";
        $d=[
        'idsend'=>$userid,
        'idrecei'=>$_SESSION['user_id'],
        'idsendtwo'=>$_SESSION['user_id'],
        'idreceitwo'=>$userid,
        ];
        $data=$this->DBManager->findAllSecure($q,$d);
        return $data;
    }

    /*function which returns all users id  who chat with the user connected*/
    function getAllUserIdWithMe(){
        $q="select id_receiver from `message` Where  id_sender=:idsend UNION select id_sender from `message` where id_receiver=:idrecei";
        $d=[
        'idsend'=>$_SESSION['user_id'],
        'idrecei'=>$_SESSION['user_id'],
        ];
        $data=$this->DBManager->findAllSecure($q,$d);
        return $data;
    }
}