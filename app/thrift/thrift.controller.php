<?php
    class Thrift extends Controller{
        private $userRepo;
        private $memberRepo;
        private $groupRepo;
        private $thriftRepo;

        public function __construct() 
        {
            global $connect;
            $this->userRepo = new UserRepository($connect);
            $this->memberRepo = new GroupMemberRepository($connect);
            $this->groupRepo = new GroupRepository($connect);
            $this->thriftRepo = new ThriftRepository($connect);
            $this->groups = $this->groupRepo->findAll();
        }

        public function index($name="default", $rest=""){
            $this->authenticate();
            $thrifts = $this->thriftRepo->findAll();
            // $allThrifts = [];
            $this->view("thrift/views/index", ['thrifts'=> $allThrifts]);
        }
    }