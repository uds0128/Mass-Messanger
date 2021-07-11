<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "massmessanger";
    
    $connection = new mysqli($servername, $username, $password, $dbname);
    $getEmailConfigData = "SELECT * from emailconfig WHERE id = 1";
    $getEmailConfigData = $connection->query($getEmailConfigData);
    
    if(!$getEmailConfigData){
        $res = array("status"=>-1, "errcode"=>-1, "errmsg"=>"Err Fetching In Email Configs");
        die(json_encode($res));
    }
    $getEmailConfigData = $getEmailConfigData->fetch_assoc();

    
    $mail_host = $getEmailConfigData["host"];
    $mail_port = $getEmailConfigData["port"];
    $mail_sender_email = $getEmailConfigData["sendersemail"];
    $mail_sender_password = $getEmailConfigData["senderspassword"];
    $mail_sender_name = $getEmailConfigData["sendersname"];

    $connection->close();
?>