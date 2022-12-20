<?php 

    class Home extends Controller{
        public function index($name="default", $rest=""){
            $this->view('home/views/login');
        }
    }