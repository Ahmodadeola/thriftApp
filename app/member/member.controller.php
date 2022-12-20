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
            $args = ['Adeola', 'Ahmad', 'adeola@test.com', 'aaddeeoollaa', true];
           $user= $this->model('User', $args);
        //    var_dump($user);
           if(isset($_POST['submit'])){

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
                    $password = filter_input(INPUT_POST, 'word', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                }else{
                    $passwordErr = "Password cannot be empty";
                }

                echo "$emailErr" . " $passwordErr";
                if($emailErr || $passwordErr){
                    $this->view('home/views/login', ['error'=> 'Provide valid email and password']);
  
                }
                // find the user with login credentials
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $user = $this->userRepo->findByEmailAndPassword($email, $hashed_password);

                // return to login if user is not found
                if(empty($user)){
                    $this->view('home/views/login', ['error'=> 'Incorrect email or password']);
                }
                var_dump($user);
            }else{
               $this->view('home/views/login', ['error'=> 'Provide login credentials']);
            }
        }


}