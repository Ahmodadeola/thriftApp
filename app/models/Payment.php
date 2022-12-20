<?php
    class Thrift{
        private  $userId;
        private  $amount;
        private  $thriftDate;

        public function __construct(float $amount, int $userId, string $thriftDate)
        {
            $this->userId = $userId;
            $this->amount = $amount;
            $this->thriftDate = $thriftDate;
        }
    }
?>