<?php

namespace Model;

class ArticleManager
{
    private $DBManager;
    
    private static $instance = null;
    public static function getInstance()
    {
        if (self::$instance === null)
            self::$instance = new ArticleManager();
        return self::$instance;
    }
    
    private function __construct()
    {
        $this->DBManager = DBManager::getInstance();
    }
    
    public function createArticleCheck($data)
    {
        return  !(empty($data['title-article']) OR empty($data['text-article']));
    }
    
    public function addArticlePictureCheck($file){
        $extensions = array( 'image/jpg' , 'image/jpeg' , 'image/gif' , 'image/png' );
        if($file["article-pic"]["error"] != 0) return false;
        if ($file['article-pic']['size'] > 1048576) return false;
        if (in_array($file['article-pic']['type'],$extensions)) return true;
        return false;
    }
    
    public function addArticlePictureInUserDirectory($file,$file_extension,$id_picture){
        rename($file["article-pic"]["tmp_name"],"./users/".$_SESSION['username']."/".$id_picture.".".$file_extension);
    }
    
    public function createArticle($data,$file)
    {
        if($this->addArticlePictureCheck($file)){
            $picExtension=pathinfo($file["article-pic"]["name"],PATHINFO_EXTENSION);
            $id_picture=uniqid();
            $picture_path="./users/".$_SESSION['username']."/".$id_picture.".".$picExtension;
            $this->addArticlePictureInUserDirectory($file,$picExtension,$id_picture);
        }else{
            $picture_path="nothing";
        }
        $query="insert into `articles`(`title_article`,`author_article`,`date_article`,`text_article`,`picture_article`)values(:title,:author,NOW(),:text,:pic)";
        $d=([
        'title'=> $data['title-article'],
        'author'=> $_SESSION['username'],
        'text'=> $data['text-article'],
        'pic'=> $picture_path,
        ]);
        $this->DBManager->do_query_db($query,$d);
    }
    
    public function getAllArticles(){
        $data = $this->DBManager->findAll("SELECT * FROM articles");
        return $data;
    }
    
    public function articleCheck($id_article)
    {
        $data = $this->DBManager->findOneSecure("SELECT * FROM articles WHERE id = :id",
        ['id' => $id_article]);
        if(count($data['id'])!=0){
            return true;
        }else{
            return false;
        }
    }
    
    public function getArticle($id_article){
        $data = $this->DBManager->findOneSecure("SELECT * FROM articles WHERE id = :id",
        ['id' => $id_article]);
        return $data;
    }
    
    public function editArticle($data){
        var_dump("here");
        $query="update `articles` set `title_article`=:title,`text_article`=:text where `id`= :id";
        $d=[
        'title'=> $data['title-article'],
        'text'=> $data['text-article'],
        'id'=> $data['id-article'],
        ];
        $res=$this->DBManager->do_query_db($query,$d);
    }
}