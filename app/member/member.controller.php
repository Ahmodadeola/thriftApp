<?php require_once "member.repository.php";
require_once "../app/configs/dbConfig.php";

class Member extends Controller {
        private $userRepo;

        public function __construct() 
        {
            global $connect;
            $this->userRepo = new UserRepository($connect);
        }

        public function index($name="default", $rest=""){
            $this->view("member/views/index", ['name'=> $name]);
        }

        public function create(){
         
        //    var_dump($user);
           if(isset($_POST['submit'])){
                $errors = [];

                if(isset($_POST['isAdmin'])){
                    $isAdmin = filter_input(INPUT_POST, 'isAdmin', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $isAdmin = $isAdmin === "true"? true : false;
                } else $isAdmin = false;

                if(isset($_POST['doesThrift'])){
                     $doesThrift = filter_input(INPUT_POST, 'doesThrift', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $doesThrift = $doesThrift === "true"? true : false;
                } else $doesThrift = false;

                if(isset($_POST['groups'])){
                    $groups = filter_input(INPUT_POST, 'groups', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    if(!$groups && $doesThrift)  array_push($errors,  "Provide thrift group(s)");
                    else if(!$doesThrift) $groups = [];
                    else $groups = explode(',', $groups);  
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
                        else if(strlen($password) < 7)  array_push($errors,  "Password must be min of 6 characters");
           
                        }
                    }else{
                       if($isAdmin) array_push($errors,  "Password is required");
                    }
                }

                if(count($errors) > 0) $this->view('member/views/create', ['errors'=> $errors]);
                else{
                    $args = [$firstName, $lastName, $email, $password, $isAdmin, $doesThrift];
                    $user= $this->model('User', $args);
                    $newUser = $this->userRepo->createUser($user);
                    var_dump($user);
                    if($newUser) echo "User created successfully!";
                }
                var_dump($errors);
                var_dump($isAdmin, $doesThrift);
                echo "<br />";
           }else{
            $this->view('member/views/create');
           }
        }

        public function login(){
            // check for form submission
            if(isset($_POST['submit'])){
                $emailErr = $passwordErr = "";

                // escape and validate email 
                if(isset($_POST['email'])){
                    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $emailErr = "Provide a valid email";
                    }
                }else{
                    $emailErr = "Provide a valid email";
                }

                  // escape password 
                if(isset($_POST['password'])){
                    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                }else{
                    $passwordErr = "Password cannot be empty";
                }

                echo "$emailErr" . " $passwordErr";
                if($emailErr || $passwordErr){
                    $this->view('home/views/login', ['error'=> 'Provide valid email and password']);
  
                }
                // find the user with login credentials
                $user = $this->userRepo->findByEmail($email);
                $isValidUser = $user? password_verify($password, $user['password']) : false;


                // return to login if user is not found
                if(!$isValidUser){
                    $this->view('home/views/login', ['error'=> 'Incorrect email or password']);
                }
            }else{
               $this->view('home/views/login', ['error'=> 'Provide login credentials']);
            }
        }


}