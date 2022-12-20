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
        return empty($data)? $data : $data['0'];
    }

    public function createUser($user){
        $firstName = $user->getFirstName();
        $lastName = $user->getFirstName();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $doesThrift = $user->doesThrift()? 1 : 0;
        $isAdmin = $user->isAdmin()? 1 : 0;


        $sql = "INSERT INTO user (firstName, lastName, email, password, doesthrift, isAdmin)
                 VALUES 
                ('$firstName', '$lastName', '$email', '$password', '$doesThrift', '$isAdmin')";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }
}