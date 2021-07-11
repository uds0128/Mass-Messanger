<?php

    include("../../dbconfig/config.php");

    $host = $_POST["server"];
    $port = $_POST["port"];
    $sendersemail = $_POST["sendersemail"];
    $senderspassword = $_POST["senderspassword"];
    $sendersname = $_POST["sendersname"];

    $updateConfig = $conn->prepare("UPDATE emailconfig SET host=?, port=?, sendersemail=?, senderspassword=?, sendersname=? WHERE id = 1 ");  
    $updateConfig->bind_param("sisss", $host, $port, $sendersemail, $senderspassword, $sendersname);
    $updateConfig = $updateConfig->execute();
    
    if(!$updateConfig){
        $res = array("status"=>0, "errcode"=>-1, "errmsg"=>"Err While Updating");
        die(json_encode($res));
    }

    $res = array("status"=>1, "errcode"=>null, "errmsg"=>null);
    echo json_encode($res);
?>