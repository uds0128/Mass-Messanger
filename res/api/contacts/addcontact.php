<?php
    include('../../dbconfig/config.php');

    if($isConnected){
        $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
        $insert_query = "INSERT INTO contacts (firstname, middlename, lastname, email, contactno) VALUES ( '{$_POST['firstname']}', '{$_POST['middlename']}', '{$_POST['lastname']}', '{$_POST['email']}', '{$_POST['contactno']}')";
        $result_insert_query = $conn->query($insert_query);

        if($result_insert_query){
            $conn->commit();
            die(json_encode(["status" => 1]));
        }
        else{
            $conn->rollback();
            die(json_encode(["status" => 0, "errcode" => 1]));
        }
    }
    else{
        die(json_encode(["status" => 0, "errcode" => 2]));
    }

?>

