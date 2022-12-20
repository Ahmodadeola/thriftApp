<?php 

class UserRepository {
    private $connect;
    public function __construct($connect)
    {   
        $this->connect = $connect;
    }
    
    public function findByEmailAndPassword(string $email, string $password){
        $sql = "SELECT * FROM user WHERE user.email = '$email' AND user.password = '$password'";
        $result = mysqli_query($this->connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $data;
    }

    public function findByEmail(string $email){
        $sql = "SELECT * FROM user WHERE user.email = '$email'";
        $result = mysqli_query($this->connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $data;
    }

    public function createUser($user){
        $firstName = $user->getFirstName();
        $lastName = $user->getFirstName();
        $email = $user->getFirstName();
        $password = $user->getPaswword();
        $doesThrift = $user->doesThrift();
        $isAdmin = $user->isAdmin();


        $sql = "INSERT INTO user (firstName, lastName, email, password, doesthrift, isAdmin)
                 VALUES 
                ('$firstName', '$lastName', '$email', '$password', '$doesThrift', '$isAdmin')";
        $result = mysqli_query($this->connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $data;
    }
}