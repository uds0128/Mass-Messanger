<?php
    require('../../dbconfig/config.php');

    $groupname = $conn->real_escape_string($_POST['groupname']);
    $groupdesc = $conn->real_escape_string($_POST['groupdesc']);
    
    $cheak_for_exist = $conn->prepare("SELECT COUNT(0) from groupsmaster WHERE name = ?");
    $cheak_for_exist->bind_param('s', $groupname);
    $cheak_for_exist->execute();
    $result_cheak_for_exist = $cheak_for_exist->get_result();

    if(!$result_cheak_for_exist){
        $res = array('status'=>0, 'errcode'=>-2, 'errmsg'=>"Error While Searching");
        die(json_encode($res));
    }
    
    $row = $result_cheak_for_exist->fetch_assoc();
    $count_of_records = $row["COUNT(0)"];
    if($count_of_records){
        $res = array('status'=>0, 'errcode'=>1, 'errmsg'=>"Record Exists");
        die(json_encode($res));
    }

    $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
    $stmt = $conn->prepare("INSERT INTO groupsmaster (name, description) VALUES (?,?)");
    $stmt->bind_param('ss', $groupname, $groupdesc);
    $result = $stmt->execute();

    if(!$result){
        $conn->rollback();
        $res = array('status'=>0, 'errcode'=>-1, 'errmsg'=>"Error While Insert");
        die(json_encode($res));
    }
    
    $conn->commit();
    $res = array('status'=>1, 'errcode'=>null, 'errmsg'=>null);
    echo json_encode($res);
?>