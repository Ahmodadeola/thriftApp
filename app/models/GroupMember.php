<?php
    class GroupMember {
        private  $id;
        private  $userId;
        private  $groupId;
        private  $dateJoined;

        public function __construct(int $userId, int $groupId)
        {
            $this->userId = $userId;
            $this->groupId = $groupId;
        
        }

        public function setId(int $id){
            $this->id = $id;
        }

        public function setDateJoined(string $dateJoined){
            $this->dateJoined = $dateJoined;
        }

        public function getId(){
            return $this->id;
        }
      
        public function getDateJoined(){
            return $this->dateJoined;
        }

        public function getUserId(){
            return $this->userId;
        }
        public function getGroupId(){
            return $this->groupId;
        }
    }
?>