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
                // echo "$url[0]";

                $this->controller = $url[0];
                unset($url[0]);
            }
            require_once "../app/$this->controller/$this->controller.controller.php";
            $this->controller = new $this->controller;
            // var_dump($this->controller);
            // echo $this->controller[$this->method];

            if(isset($url[1])){
                $this->method = $url[1];
                if(method_exists($this->controller, $url[1])){
                    echo "ok <br />";
                    $this->method = $url[1];
                    unset($url[1]);
                };
            }

            $this->param = $url? array_values($url) : [];
            // echo "The params: ";
            // var_dump($this->param);
            call_user_func_array([$this->controller, $this->method], $this->param);

        }

        public function parseUrl(){
            if(isset($_GET['url'])){
                $url = filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL);
                $url = explode("/", $url);
                return  $url;
            } else { 
                return [""];
            }
        }
    }