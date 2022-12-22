<?php require_once "../app/models/Group.php";

class GroupRepository {
    private $connect;
    public function __construct($connect)
    {   
        $this->connect = $connect;
    }
    
    public function findById(int $id){
        $sql = "SELECT * FROM thriftGroup WHERE thriftGroup.id = '$id'";
        $result = mysqli_query($this->connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $group = null;
        if(!empty($data)) {
            $row = $data['0'];
            $group = new Group($row['name'], $row['thriftAmount'], $row['currentNoMembers'], $row['id'], $row['dateCreated']);
        }
        return $group;
    }
    
    public function findAll(){
        $sql = "SELECT * FROM thriftGroup";
        $result = mysqli_query($this->connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $groups = [];
        if(!empty($data)) {
            foreach($data as $row){
                $group = new Group($row['name'], $row['thriftAmount'], $row['currentNoMembers'], $row['id'], $row['dateCreated']);
                array_push($groups, $group);
            }
        }
        return $groups;
    }


    public function createGroup($group){
        $name = $group->getFirstName();
        $thriftAmount = $group->getFirstName();
        $sql = "INSERT INTO thriftGroup (name, thriftAmount)
                 VALUES 
                ('$name', '$thriftAmount')";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }

    public function incrementNoOfMembers(int $id){
        $sql = "UPDATE thriftGroup
        SET currentNoMembers = currentNoMembers + 1
        WHERE id = $id
        ";
        $result = mysqli_query($this->connect, $sql);
        // $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        var_dump($result);
        return $result;
    }
}