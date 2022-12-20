<?php
    class User{
        private  $firstName;
        private  $lastName;
        private  $email;
        private  $password;
        private  $isAdmin;
        private  $doesThrift = true;

        public function __construct(string $firstName, string $lastName, string $email, string $password,
                        bool $isAdmin=false)
        {
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->email = $email;
            $this->password = $isAdmin? password_hash($password, PASSWORD_DEFAULT) : '';
            $this->doesThrift = $email;
            $this->isAdmin = $isAdmin;
        }
    }
?>