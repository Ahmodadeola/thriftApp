<?php require_once "../app/configs/dbConfig.php";

class Controller {
    public function index(){
        echo "This is index";
    }

    public function model($model, $args){
        require_once "../app/models/$model.php";
        return new $model(...$args);
    }

    public function view($page, $data=[]){
        require_once("../app/$page.php");
    }

    public function authenticate(){
        session_start();
        $isLoggedIn = isset($_SESSION['email']);
        if(!$isLoggedIn)  header("Location: /thriftapp/public");
    }

}