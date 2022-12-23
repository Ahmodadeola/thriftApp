<?php require_once "../app/models/Thrift.php";

Class ThriftRepository {
    private $connect;
    public function __construct($connect)
    {   
        $this->connect = $connect;
    }

    public function findAll(){
        $sql = "SELECT * FROM thrift";
        $result = mysqli_query($this->connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $thrifts = [];
        if(!empty($data)) {
            foreach($data as $row){
                $thrift = new ThriftLog($row['memberId'], $row['groupId'], $row['paymentDate'], $row['id'], $row['createdAt']);
                array_push($thrifts, $thrift);
            }
        }
        return $thrifts;
    }

    public function findAllWithMember(){
        $sql = "SELECT thrift.id, thrift.memberId, fullName, email, groupName, paymentDate, createdAt, isAdmin
        FROM thrift
        INNER JOIN (
            SELECT isAdmin, groupMember.id as memberId, name AS groupName, email, CONCAT(firstName, ' ', lastName) AS fullName
            FROM user, groupMember, thriftGroup 
            WHERE user.id = groupMember.userId AND thriftGroup.id = groupMember.groupId
        ) AS userMember
        ON thrift.memberId = userMember.memberId
        ORDER BY paymentDate DESC, createdAt DESC";
        $result = mysqli_query($this->connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $data;
    }

    public function createThrift($thrift){
        $memberId = $thrift->getMemberId();
        $groupId =  $thrift->getGroupId();
        $paymentDate = $thrift->getPaymentDate();
         
        $sql = "INSERT INTO thrift (memberId, groupId, paymentDate)
        VALUES ('$memberId', '$groupId', '$paymentDate')";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }

    public function findLatestMemberLogs(){
        $sql =  $sql = "SELECT thrift.id, thrift.memberId, fullName, email, groupName, paymentDate, createdAt, isAdmin
        FROM thrift
        INNER JOIN (
            SELECT isAdmin, groupMember.id as memberId, name AS groupName, email, CONCAT(firstName, ' ', lastName) AS fullName
            FROM user, groupMember, thriftGroup 
            WHERE user.id = groupMember.userId AND thriftGroup.id = groupMember.groupId
        ) AS userMember
        ON thrift.memberId = userMember.memberId
        ORDER BY paymentDate DESC, createdAt DESC";

        $result = mysqli_query($this->connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $data;
    }

    public function findOutstandings(){
        $sql = "SELECT memberId, email, isAdmin, CONCAT(firstName, ' ', lastName) AS fullName,
         thriftGroup.name as groupName, thriftGroup.thriftAmount as amount, 
         thriftLog.memberId, thriftLog.paymentDate
        FROM groupMember
        INNER JOIN (
          SELECT memberId, MAX(paymentDate) AS paymentDate
          FROM thrift
          GROUP BY memberId
        ) AS thriftLog
        ON thriftLog.memberId = groupMember.id
        INNER JOIN user
        ON user.id = groupMember.userId
        INNER JOIN thriftGroup
        ON thriftGroup.id = groupMember.groupId
        WHERE MONTH(thriftLog.paymentDate) != MONTH(CURRENT_DATE()) 
        ORDER BY  thriftLog.paymentDate DESC      
        ";

        $result = mysqli_query($this->connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $data;
    }

    
}