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
                $errors= [];

                // escape and validate email 
                if(isset($_POST['email'])){
                    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                      array_push($errors, "Provide a valid email");
                    }
                }else{
                    array_push($errors, "Provide a valid email");
                }

                  // escape password 
                if(isset($_POST['password'])){
                    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    if(!$password){
                        array_push($errors, "Password cannot be empty");
                    }else if(strlen($password) < 6){
                        array_push($errors, "Password length can't be less than 6");
                    }
                }else{
                    array_push($errors, "Password cannot be empty");
                }

                if(count($errors) > 0){
                    $this->view('home/views/login', ['errors'=> $errors]);
                }
                // find the user with login credentials
                $user = $this->userRepo->findByEmail($email);
                $isValidUser = $user? password_verify($password, $user->getPassword()) : false;


                // return to login if user is not found
                if(!$isValidUser){
                    $this->view('home/views/login', ['errors'=> ['Incorrect email or password']]);
                }else{
                    session_start();
                    $_SESSION['email'] = $email;
                    $_SESSION['firstName'] = $user->getFirstName();
                    $_SESSION['lastName'] = $user->getLastName();
                    $_SESSION['id'] = $user->getId();
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