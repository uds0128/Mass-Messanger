<?php

    require('../../dbconfig/config.php');

    if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['_password'])){
            
        $cheakForEmail = "SELECT * FROM users WHERE email = '{$_POST['email']}'";
        $result_cheakForEmail = $conn->query($cheakForEmail);
        if($result_cheakForEmail->num_rows>0){
            $res = array('status' => 0, 'errcode' => 1, 'errmsg' => "Already Exists");
            die(json_encode($res)); 
        }
        else{
            $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
            $password = password_hash($_POST['_password'], PASSWORD_ARGON2ID);
            $query = "INSERT INTO users (email, firstname, lastname, password_hash) values ('{$_POST['email']}', '{$_POST['firstname']}', '{$_POST['lastname']}', '{$password}')";
            if($conn->query($query)){
                $conn->commit();
                $res = array('status' => 1, 'errcode' => null, 'errmsg' => null);
                die(json_encode($res)); 
            }
            else{
                $conn->rollback();
                $res = array('status' => 0, 'errcode' => -1, 'errmsg' => "ERREXEQUERY");
                die(json_encode($res));    
            }
        }
    }
    else{
        $res = array('status' => 0, 'errcode' => -2, 'errmsg' => "EMPTYPARAMS");
        die(json_encode($res));  
    }
?>