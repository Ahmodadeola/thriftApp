<?php 
require_once "../app/thrift/thrift.repository.php";
require_once "../app/group/group.repository.php";
require_once "../app/group/groupMember.repository.php";
require_once "../app/models/GroupMember.php";
require_once "../app/models/Thrift.php";
    class Thrift extends Controller{
        private $userRepo;
        private $memberRepo;
        private $groupRepo;
        private $thriftRepo;

        public function __construct() 
        {
            global $connect;
            $this->thriftRepo = new ThriftRepository($connect);
            $this->memberRepo = new GroupMemberRepository($connect);
            $this->groupRepo = new GroupRepository($connect);
            $this->groups = $this->groupRepo->findAll();
        }

        public function index($name="default", $rest=""){
            $this->authenticate();
            $thrifts = $this->thriftRepo->findAllWithMember();
            $this->view("thrift/views/index", ['thrifts'=> $thrifts]);
        }

        public function outstanding($name="default", $rest=""){
            $this->authenticate();
            $thrifts = $this->thriftRepo->findOutstandings();
            $this->view("thrift/views/outstanding", ['thrifts'=> $thrifts]);
        }

        public function remind(){
            $this->authenticate();
            require_once "../app/cronJobs/thriftReminder.php";
        }

        public function logpay($param=[], $query=[]){
           
            $this->authenticate();
            $members = $this->memberRepo->findEveryWithGroups();
            $groups = $this->groupRepo->findAll();
            $assocGroups = [];
           
            if(isset($_POST['submit'])){
                var_dump($_POST);
                $errors = [];

                if(isset($_POST['member'])){
                    $userId = filter_input(INPUT_POST, 'member', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    if(empty($userId) || $userId < 0){
                        array_push($errors, 'Member is required');
                    }
                }else{
                    array_push($errors, 'Member is required');
                }

                if(isset($_POST['groups'])){
                    $groups = filter_input(INPUT_POST, 'groups', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    if(!$groups) array_push($errors,  "Provide thrift group(s)");
                    else{
                         $groups = array_filter(explode(',', $groups), function($group) {
                                        return !empty($group);
                                    });  
                        if(count($groups) === 0) array_push($errors,  "Provide thrift group(s)");
                    }
                }else{
                    array_push($errors, 'Member group(s) is required');
                }

                if(isset($_POST['paymentDate'])){
                    $paymentDate = filter_input(INPUT_POST, 'paymentDate', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    if(!$paymentDate) array_push($errors, 'Pyment date is required');
                }else{
                    array_push($errors, 'Payment date is required');
                }

                if(count($errors) > 0 ){
                    $this->view("thrift/views/logpay", ['errors'=>$errors, 'groups'=> []]);
                }else{
                    // create thrift record for each of the member's group
                    $hasError = false;
                    foreach($groups as $groupId){
                        $member = $this->memberRepo->findByGroupIdAndUserId((int)$groupId, (int)$userId);
                        $memberId = null;
                        if($member) $memberId = $member->getId();
                        $thriftObj = new ThriftLog((int)$memberId, (int)$groupId, $paymentDate);
                        $thriftCreated = $this->thriftRepo->createThrift($thriftObj);
                        $hasError = !$thriftCreated && $hasError;
                        var_dump($thriftCreated);
                    }
                    if($hasError) echo "Some error occured with some items";
                    else{
                        header("Location: /thriftapp/public/thrift");
                    }
                }

            }else if(isset($_GET['key'])){
                $key = filter_var($_GET['key'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $memberResults = $this->memberRepo->findByNameSubstring($key);
                $contextData = ['members'=> $members, 'groups'=> $assocGroups, 
                'searchResults'=> $memberResults, 'key'=> $key];

                if(isset($_GET['member'])){
                    $userId = filter_input(INPUT_GET, 'member', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    if(!empty($userId))  {
                        $memberRow = array_find($members, function($member) use ($userId){
                                            return $member['userId'] === $userId;
                                        });
                    foreach($groups as $group){
                        $name= $group->getName();
                        if(str_contains($memberRow['groupNames'], $name)) {
                            $assocGroups[$name] = $group->getId();
                        }
                    }
                    $contextData['member'] = $userId;
                    $contextData['groups'] = $assocGroups;
                    
                }
                }
                 $this->view("thrift/views/logpay", $contextData);
            }else{
                $this->view("thrift/views/logpay", ['members'=> $members, 'groups'=> $assocGroups]);
            }
        }
    }