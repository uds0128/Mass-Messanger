<?php

    require('./dbconfig/config.php');
    require('./mailconfig/mailfunction.php');

    if($isConnected){
        if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['_password'])){
            
            $cheakForEmail = "SELECT verified_status, token, firstname, lastname FROM usersintermidiate WHERE email = '{$_POST['email']}'";
            $result_cheakForEmail = $conn->query($cheakForEmail);
            if($result_cheakForEmail->num_rows){
                $row = $result_cheakForEmail->fetch_assoc();
                if($row['verified_status']){
                    $res = array('statusCode' => "2", 'errCode' => '0', 'errMsg' => null);
                    die(json_encode($res));    
                }
                else{
                    $token=$row['token'];
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    if(mailfunction($_POST['email'], "http://localhost/projects/massmessangerfinal/res/verifyemail.php?token=".$token, $firstname." ".$lastname)){
                        $res = array('statusCode' => "3", 'errCode' => '0', 'errMsg' => null);
                        die(json_encode($res));
                    }
                    else{
                        $res = array('statusCode' => "0", 'errCode' => '0', 'errMsg' => "MAILSENDERR");
                        die(json_encode($res));
                    }
                }
            }
            else{
                $token = bin2hex(random_bytes(15));
                $password = password_hash($_POST['_password'], PASSWORD_ARGON2ID);
                $query = "INSERT INTO usersintermidiate (email, firstname, lastname, password_hash, token, requested_at) values ('{$_POST['email']}', '{$_POST['firstname']}', '{$_POST['lastname']}', '{$password}', '{$token}', CURRENT_TIMESTAMP)";
                $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
                if($conn->query($query)){
                    $conn->commit();
                    if(mailfunction($_POST['email'], "http://localhost/projects/massmessangerfinal/res/verifyemail.php?token=".$token, $_POST['firstname']." ".$_POST['lastname'])){
                        $res = array('statusCode' => "1", 'errCode' => '0', 'errMsg' => null);
                        die(json_encode($res));    
                    }
                    else{
                        $res = array('statusCode' => "0", 'errCode' => '0', 'errMsg' => null);
                        die(json_encode($res));    
                    }
                }
                else{
                    $conn->rollback();
                    $res = array('statusCode' => "0", 'errCode' => '-1', 'errMsg' => "ERREXEQUERY");
                    die(json_encode($res));    
                }
            }
        }
        else{
            $res = array('statusCode' => "0", 'errCode' => '-2', 'errMsg' => "EMPTYPARAMS");
            die(json_encode($res));    
        }
    }
    else{
        $res = array('statusCode' => "0", 'errCode' => '-3', 'errMsg' => "ERRCONN");
        die(json_encode($res));    
    }
?>