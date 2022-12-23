<?php require_once "../app/configs/dbConfig.php";
  require_once "../app/thrift/thrift.repository.php";
  global $connect;
    $thriftRepo = new ThriftRepository($connect);
    $memberRows = $thriftRepo->findOutstandings();

    $from = 'thrifty@yopmail.com';
 

    // Set the subject and body of the email
    
    foreach($memberRows as $member){
        $amount = $member['amount'];
        $groupName = $member['groupName'];

        $subject = '$groupName Thrift contribution reminder';
        $to = 'thriftyrec@yopmail.com';

        $body = "Hi there, 
        just a friendly reminder that your thrift contribution with monthly quota of $amount is due. 
        Please make sure to contribute your share as soon as possible to keep the group running smoothly. 
        Thank you for your cooperation and support!";

        // Set the headers for the email
        $headers = "From: $from\r\n";
        $headers .= "Reply-To: $from\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        // Send the email
        if (mail($to, $subject, $body, $headers)) {
        echo 'Email sent successfully!';
        echo "<br />";
        } else {
        echo 'Error: Email could not be sent.';
        echo "<br />";
        }
    }