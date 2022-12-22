<?php require_once "member.repository.php";
require_once "../app/group/group.repository.php";
require_once "../app/group/groupMember.repository.php";
require_once "../app/models/GroupMember.php";

class Member extends Controller {
        private $userRepo;
        private $memberRepo;

        public function __construct() 
        {
            global $connect;
            $this->userRepo = new UserRepository($connect);
            $this->memberRepo = new GroupMemberRepository($connect);
            $this->groupRepo = new GroupRepository($connect);
        }

        public function index($name="default", $rest=""){
            $this->authenticate();
            $allMembers = $this->userRepo->findEveryWithGroups();
            $this->view("member/views/members", ['members'=> $allMembers]);
        }

        public function create(){
            $this->authenticate();
           if(isset($_POST['submit'])){
                $errors = [];

                if(isset($_POST['isAdmin'])){
                    $isAdmin = filter_input(INPUT_POST, 'isAdmin', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $isAdmin = $isAdmin === "true"? true : false;
                } else $isAdmin = false;

                if(isset($_POST['doesThrift'])){
                     $doesThrift = filter_input(INPUT_POST, 'doesThrift', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $doesThrift = $doesThrift === "true"? true : false;
                } else $isAdmin? ($doesThrift = false) : ($doesThrift = true);

                if(isset($_POST['groups'])){
                    $groups = filter_input(INPUT_POST, 'groups', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    if(!$groups && $doesThrift)  array_push($errors,  "Provide thrift group(s)");
                    else if(!$doesThrift) $groups = [];
                    else $groups = array_filter(explode(',', $groups), function($group) {
                        return !empty($group);
                    });  
                }else{
                    if($isAdmin && !$doesThrift){
                        $groups = [];
                    }else{
                        array_push($errors,  "Provide thrift group(s)");
                    }
                }

                if($_POST['email']){
                    // sanitize and validate email
                    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

                    // check if email already exist
                    if($email){
                        $emailExist = $this->userRepo->findByEmail($email);
                        if($emailExist) array_push($errors,  "User with email already exist");
                    }else{
                        array_push($errors,  "invalid email");
                    }

                    if(isset($_POST['firstName'])){
                        $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        if(!$firstName) array_push($errors,  "first Name is required");
                    }else{
                        array_push($errors,  "first Name is required");
                    }

                    if(isset($_POST['lastName'])){
                        $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        if(!$lastName)  array_push($errors,  "Last Name is required");
                    }else{
                        array_push($errors,  "Last Name is required");
                    }
                    
                    $password= "";
                    if(isset($_POST['password'])){
                        if($isAdmin){
                             $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        if(!$password)  array_push($errors,  "Password is required");
                        else if(strlen($password) < 6)  array_push($errors,  "Password must be min of 6 characters");
           
                        }
                    }else{
                       if($isAdmin) array_push($errors,  "Password is required");
                    }
                }

                // return to create page if form contains error
                if(count($errors) > 0) $this->view('member/views/create', ['errors'=> $errors]);
                else{
                    // create a new user row
                    $args = [$firstName, $lastName, $email, $password, $isAdmin, $doesThrift];
                    var_dump($args);
                    $user= $this->model('User', $args);
                    $newUser = $this->userRepo->createUser($user);

                    echo "$isAdmin, $doesThrift";
                    // create group member row(s) if user would participate
                    if($doesThrift || !$isAdmin) {
                        $userRow = $this->userRepo->findByEmail($email);
                        foreach($groups as $groupId){
                            $member = new GroupMember($userRow->getId(), (int)$groupId);
                            $this->memberRepo->createGroupMember($member);
                        }
                    }
                    if($newUser) {
                        echo "<script>alert('$email account created successfully!')</script>";
                        header("Location: /thriftapp/public/member");
                    }
                }
           }else{
            //get all groups from db     
               $groups = $this->groupRepo->findAll();
               $assocGroups = [];
               foreach($groups as $group){
                   $assocGroups[$group->getName()] = $group->getId();
               }

            //redirect to create member page
               $this->view('member/views/create', ['groups'=> $assocGroups]);
           }
        }

        public function logpay(){
            echo "member/logpay";
        }

        public function logout(){
            session_start();

            session_destroy();
            var_dump($_SESSION);
            header("Location: /thriftapp/public");
        }

        public function authenticate(){
            session_start();
            $isLoggedIn = isset($_SESSION['email']);
            if(!$isLoggedIn)  header("Location: /thriftapp/public");
        }

}