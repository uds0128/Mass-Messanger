<?php

    include('../../dbconfig/config.php');

    $groupdesc = $conn->real_escape_string($_POST['groupdesc']);
    $groupid = $conn->real_escape_string($_POST['id']);

    $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

    $updateGroupDetails = $conn->prepare("UPDATE groupsmaster SET description=? WHERE id=?");
    $updateGroupDetails->bind_param('si', $groupdesc, $groupid);
    $resultUpdateGroupDetails = $updateGroupDetails->execute();

    if(!$resultUpdateGroupDetails){
        $conn->rollback();
        $res = array("status" => 0, 'errcode' => -1, "errmsg" => "Err In Updation");
        die(json_encode($res));
    }

    $conn->commit();
    $res = array('status' => 1, 'errcode' => null, "errmsg" => null);
    echo json_encode($res);
?>