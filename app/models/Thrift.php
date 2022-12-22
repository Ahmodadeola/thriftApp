<?php
    class Thrift{
        private  $id;
        private  $memberId;
        private  $groupId;
        private  $paymentDate;
        private  $createdAt;


        public function __construct(int $memberId, int $groupId, string $paymentDate, $id=null, $createdAt='')
        {
            $this->id = $id;
            $this->memberId = $$memberId;
            $this->groupId = $groupId;
            $this->paymentDate = $paymentDate;
            $this->createdAt = $createdAt;
        }

        public function setId(int $id){
            $this->id = $id;
        }

        public function createdAt(string $dateTime){
            $this->createdAt = $dateTime;
        }

        public function getGroupId(){
            return $this->groupId;
        }
        public function getMemberId(){
            return $this->memberId;
        }
        public function getPaymentDate(){
            return $this->paymentDate;
        }

        public function getId(){
            return $this->id;
        }

        public function getCreatedAt(){
            return $this->createdAt;
        }


    }
?>