<?php

    include('../../dbconfig/config.php');
    include('../../mailconfig/mailingfunction.php');

    $fname = "fname";
    $mname = "mname";
    $lname = "lname";
    $email = $_POST['testmail'];
    $contactno = "ContactNo";
    $subject = "Test Email Configuration";
    $mail_body = "This is Test Mail For Checking A Email Configuration";

    if(mailfunction($fname, $mname, $lname, $email, $contactno, $subject, $mail_body)){
        $res = array(
            "status"=>1,
            "errcode"=>null,
            "errmsg"=>null,
        );
    }
    else{
        $res = array(
            "status"=>0,
            "errcode"=>-1,
            "errmsg"=>"Err IN Sending Test Mail"
        );
    }

    echo json_encode($res);
?>