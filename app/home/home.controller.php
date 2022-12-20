<?php  require_once "../app/member/member.repository.php";

    class Home extends Controller{
        public function __construct() 
        {
            global $connect;
            $this->userRepo = new UserRepository($connect);
        }


        public function index($name="default", $rest=""){
            $this->authenticate();
            $this->view('home/views/login');
        }

        public function login(){
            $this->authenticate();
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
                }else{
                    session_start();
                    $_SESSION['email'] = $email;
                    $_SESSION['firstName'] = $user['firstName'];
                    $_SESSION['lastName'] = $user['lastName'];
                    $_SESSION['id'] = $user['id'];
                    header("Location: /thriftapp/public/member");
                }
            }else{
               $this->view('home/views/login', ['error'=> 'Provide login credentials']);
            }
        }

        public function authenticate(){
            session_start();
            $isLoggedIn = isset($_SESSION['email']);
            if($isLoggedIn)  header("Location: /thriftapp/public/member");
        }
        
    }