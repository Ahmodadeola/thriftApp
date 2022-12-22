<?php require_once "../app/models/User.php";

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
        $user = null;
        if(!empty($data)) {
            $row = $data['0'];
            $user = new User($row['firstName'], $row['lastName'], $email, $row['password'], $row['isAdmin'], $row['doesThrift'], false);
            $user->setId($row['id']);
            $user->setDateCreated($row['createdAt']);
        }
        return $user;
    }

    public function findAll(){
        $sql = "SELECT * FROM user";
        $result = mysqli_query($this->connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $users = [];
        if(!empty($data)) {
            foreach($data as $row){
                $user = new User($row['firstName'], $row['lastName'], $row['email'], $row['password'], $row['isAdmin'], $row['doesThrift']);
                $user->setId($row['id']);
                $user->setDateCreated($row['createdAt']);
                array_push($users, $user);
            }
        }
        return $users;
    }

    public function findEveryWithGroups(){
        $sql = "SELECT CONCAT(firstName, ' ', lastName) AS fullName, email, createdAt, isAdmin,
        GROUP_CONCAT(thriftGroup.name SEPARATOR ', ') AS groupNames
        from groupMember, thriftGroup, user
        where groupMember.groupId = thriftGroup.id AND groupMember.userId = user.id
        GROUP BY userId";

        $result = mysqli_query($this->connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $data;
    }

    public function createUser($user){
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
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