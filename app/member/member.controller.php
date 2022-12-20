<?php

class Member extends Controller {
        public function index($name="default", $rest=""){
            $this->view("member/views/index", ['name'=> $name]);
        }

        public function create(){
            $args = ['Adeola', 'Ahmad', 'adeola@test.com', 'aaddeeoollaa', true];
           $user= $this->model('User', $args);
           var_dump($user);
        }
}