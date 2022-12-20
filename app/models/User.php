<?php
    class User{
        private  $firstName;
        private  $lastName;
        private  $email;
        private  $password;
        private  $isAdmin;
        private  $doesThrift = true;

        public function __construct(string $firstName, string $lastName, string $email, string $password,
                        bool $isAdmin=false, bool $doesThrift)
        {
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->email = $email;
            $this->password = $isAdmin? password_hash($password, PASSWORD_DEFAULT) : '';
            $this->doesThrift = $doesThrift;
            $this->isAdmin = $isAdmin;
        }

        public function getFirstName(){
            return $this->firstName;
        }
        public function getlastName(){
            return $this->lastName;
        }
        public function getEmail(){
            return $this->email;
        }
        public function isAdmin(){
            return $this->isAdmin;
        }
        public function doesThrift(){
            return $this->doesThrift;
        }
        public function getPassword(){
            return $this->password;
        }
    }
?>