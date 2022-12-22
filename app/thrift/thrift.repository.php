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
                $thrift = new User($row['memberId'], $row['groupId'], $row['paymentDate'], $row['id'], $row['createdAt']);
                array_push($thrifts, $thrift);
            }
        }
        return $thrifts;
    }

    public function findAllWithMember(){
        $sql = "SELECT * FROM thrift";
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
}