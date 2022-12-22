<?php
    class Group{
        private  $id;
        private  $thriftAmount;
        private  $currentNoMembers;
        private  $dateCreated;
        private  $name;

        public function __construct(string $name, string $thriftAmount, int $currentNoMembers=0, 
                                    int $id=null, string $dateCreated="")
        {
            $this->thriftAmount = $thriftAmount;
            $this->name = $name;
            $this->currentNoMembers = $currentNoMembers;
            $this->id = $id;
            $this->dateCreated = $dateCreated;
        }

        public function setId(int $id){
            $this->id = $id;
        }

        public function setDateCreated(string $dateCreated){
            $this->dateCreated = $dateCreated;
        }

        public function getThriftAmount(){
            return $this->thriftAmount;
        }
        public function getName(){
            return $this->name;
        }
        public function getDateCreated(){
            return $this->dateCreated;
        }
        public function getCurrentNoMembers(){
            return $this->currentNoMembers;
        }

        public function getId(){
            return $this->id;
        }
    }
?>