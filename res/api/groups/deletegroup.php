<?php
    include('../../dbconfig/config.php');
    $groupid = $conn->real_escape_string($_POST['id']);


    $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

    $deleteGroup = $conn->prepare("DELETE from groupsmaster WHERE id = ?");
    $deleteGroup->bind_param('i', $groupid);
    $resultDeleteGroup = $deleteGroup->execute();

    if($resultDeleteGroup){
        $conn->commit();
        echo json_encode(array(
            "status" => 1,
            "errcode" => null,
            "errmsg" => null
        ));
    }
    else{
        $conn->rollback();
        die(json_encode(array(
            "status" => 0,
            "errcode" => -1,
            "errmsg" => "Err In Delete"
        )));
    }
?>