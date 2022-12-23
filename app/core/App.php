<?php require_once 'Controller.php';

    class App{
        protected $path = [];
        protected $param = [];
        protected $query = [];

        protected $controller = "home";
        protected $method = "index";

        public function __construct(){
            $url = $this->parseUrl();
          
            if(file_exists("../app/$url[0]/$url[0].controller.php")){
                $this->controller = $url[0];
                unset($url[0]);
            }
            require_once "../app/$this->controller/$this->controller.controller.php";
            $this->controller = new $this->controller;

            if(isset($url[1])){
                $this->method = $url[1];
                if(method_exists($this->controller, $url[1])){
                    $this->method = $url[1];
                    unset($url[1]);
                }else $this->method = 'index';
            }

            $this->param = $url? array_values($url) : [];
            call_user_func_array([$this->controller, $this->method], [$this->param, $this->query]);

        }

        public function parseUrl(){
            if(count($_GET) > 1){
               foreach($_GET as $key => $value){
                if($key !== 'url') $this->query[$key] = $value;
               }
          
            }
            if(isset($_GET['url'])){
                $url = filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL);
                $url = explode("/", $url);
                return  $url;
            } else { 
                return [""];
            }
           
        }
    }