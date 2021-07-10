<?php
    include('../../dbconfig/config.php');

    $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
    $query = "UPDATE users SET firstname = '{$_POST['firstname']}', lastname = '{$_POST['lastname']}', email = '{$_POST['email']}' , updated_at = CURRENT_TIMESTAMP WHERE id = {$_POST['id']}";
    $result = $conn->query($query);

    if($result){
        $conn->commit();
        $res = array('status' => 1);
    }
    else{
        $conn->rollback();
        $res = array("status" => 0);
    }

    echo json_encode($res);
?>