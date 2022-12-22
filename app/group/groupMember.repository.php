<?php 

class GroupMemberRepository{
    private $connect;
    public function __construct($connect)
    {   
        $this->connect = $connect;
    }
    
    public function findById(int $id){
        $sql = "SELECT * FROM groupmember WHERE groupmember.id = '$id'";
        $result = mysqli_query($this->connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $group = null;
        if(!empty($data)) {
            $row = $data['0'];
            $group = new Group($row['name'], $row['thriftAmount']);
        }
        return $group;
    }

    public function findByUserId(int $userId){
        $sql = "SELECT * FROM groupMember WHERE groupMember.userId = '$userId'";
        $result = mysqli_query($this->connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $members = [];
        if(!empty($data)) {
            foreach($data as $row){
                $row = $data['0'];
                $member = new GroupMember($row['userId'], $row['groupId']);
                $member->setId($row['id']);
                $member->setDateJoined($row['dateJoined']);
                array_push($members, $member);
            }
            
        }
        return $members;
    }

    public function findByGroupId(int $groupId){
        $sql = "SELECT * FROM groupMember WHERE groupMember.groupId = '$groupId'";
        $result = mysqli_query($this->connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $members = [];
        if(!empty($data)) {
            foreach($data as $row){
                $row = $data['0'];
                $member = new GroupMember($row['userId'], $row['groupId']);
                $member->setId($row['id']);
                $member->setDateJoined($row['dateJoined']);
                array_push($members, $member);
            }
            
        }
        return $members;
    }

    public function findEveryWithGroups(){
        $sql = "SELECT userId, CONCAT(firstName, ' ', lastName) AS fullName, email, createdAt, isAdmin,
        GROUP_CONCAT(thriftGroup.name SEPARATOR ', ') AS groupNames
        from groupMember, thriftGroup, user
        where groupMember.groupId = thriftGroup.id AND groupMember.userId = user.id
        GROUP BY userId";

        $result = mysqli_query($this->connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $data;
    }

    public function findByNameSubstring(string $substring){
        $sql = "SELECT userId, CONCAT(firstName, ' ', lastName) AS fullName, email, createdAt, isAdmin,
        GROUP_CONCAT(thriftGroup.name SEPARATOR ', ') AS groupNames
        from groupMember, thriftGroup, user
        where groupMember.groupId = thriftGroup.id AND groupMember.userId = user.id 
        AND LOWER(CONCAT(firstName, ' ', lastName)) LIKE '%$substring%'
        GROUP BY userId";

        $result = mysqli_query($this->connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $data;
    }



    public function createGroupMember($member){
        $groupId = $member->getGroupId();
        $userId = $member->getUserId();


        $sql = "INSERT INTO groupMember (userId, groupId)
                 VALUES 
                ('$userId', '$groupId')";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }
}