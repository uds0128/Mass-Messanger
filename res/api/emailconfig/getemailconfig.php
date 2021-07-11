<?php
    require('../../dbconfig/config.php');

    $getData = "SELECT * FROM emailconfig WHERE id = 1";
    $result_getData = $conn->query($getData);

    if($result_getData){
        $row = $result_getData->fetch_assoc();

        $host = $row['host'];
        $port = $row['port'];
        $senders_email = $row['sendersemail'];
        $senders_password = $row['senderspassword'];
        $senders_name = $row['sendersname'];

        $res = array("status"=>1, "errcode"=>null, "errmsg"=>null, "data"=>array("host"=>$host, "port"=>$port, "sendersemail"=>$senders_email, "senderspassword"=>$senders_password, "sendersname"=>$senders_name));
        echo json_encode($res);
    }
    else{
        $res = array("status"=>0, "errcode"=>-1, "errmsg"=>"Err In Query");
    }
?>