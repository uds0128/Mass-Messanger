<?php
    include('../../dbconfig/config.php');

    if($isConnected){
        $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
        $insert_query = "INSERT INTO contacts (firstname, middlename, lastname, email, contactno) VALUES ( '{$_POST['firstname']}', '{$_POST['middlename']}', '{$_POST['lastname']}', '{$_POST['email']}', '{$_POST['contactno']}')";
        $result_insert_query = $conn->query($insert_query);

        if(!$result_insert_query){
            $conn->rollback();
            $res = array("status"=>0, "errcode" => -1, "errmsg" => "Error While Inserting");
            die(json_encode($res));
        }

        $contactid = $conn->insert_id;
        $groupid = $_POST['groupid'];

        if($_POST["groupid"] != 0){
            $insertIntoGroup = "INSERT INTO groupdetails (contactid, groupid) VALUES ($contactid, $groupid)";
            $result_insertIntoGroup = $conn->query($insertIntoGroup);

            if(!$result_insertIntoGroup){
                $conn->rollback();
                $res = array("status"=>0, "errcode" => -2, "errmsg" => "Error While Inserting In Group");
                die(json_encode($res));
            }
        }

        $conn->commit();

        $res = array("status"=>1, "errcode" => null, "errmsg"=>null);
        die(json_encode($res));
    }
    else{
        die(json_encode(["status" => 0, "errcode" => -3, "errmsg" => "Err In Database Connection"]));
    }

?>

