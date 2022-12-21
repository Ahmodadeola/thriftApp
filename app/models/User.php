<?php
    class User{
        private  $id;
        private  $firstName;
        private  $lastName;
        private  $email;
        private  $password;
        private  $isAdmin;
        private  $doesThrift = true;
        private $dateCreated;

        public function __construct(string $firstName, string $lastName, string $email, string $password,
                        bool $isAdmin=false, bool $doesThrift, bool $shouldHash = true )
        {
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->email = $email;
            $this->password = $isAdmin? ($shouldHash? password_hash($password, PASSWORD_DEFAULT) : $password) : '';
            $this->doesThrift = $doesThrift;
            $this->isAdmin = $isAdmin;
        }

        public function setId(int $id){
            $this->id = $id;
        }

        public function setDateCreated(string $dateCreated){
            $this->dateCreated = $dateCreated;
        }

        public function getId(){
           return $this->id;
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
        public function getDateCreated(){
            return $this->dateCreated;
        }
    }
?>