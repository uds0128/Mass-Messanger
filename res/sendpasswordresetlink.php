<?php
    require('./dbconfig/config.php');
    require('./mailconfig/mailfunction.php');

    if(isset($_POST['email']) && !empty($_POST['email'])){
        $email = stripcslashes($_POST['email']);
        $email = mysqli_real_escape_string($conn, $email);

        $cheak_for_email = "SELECT id, email, firstname, lastname from users WHERE email = '$email'";
        $result_cheak_for_email = $conn->query($cheak_for_email);

        if($result_cheak_for_email->num_rows){
            $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
            $row = $result_cheak_for_email->fetch_assoc();
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $userid = $row['id'];
            $token = bin2hex(random_bytes(15));
            $insert_into_password_reset_tokens = "INSERT INTO resetpasswordtokens (userid, token) VALUES ($userid,'$token')";
            $result_insert_into_password_reset_tokens = $conn->query($insert_into_password_reset_tokens);
            $mail_msg = "http://localhost/projects/massmessangerfinal/res/resetpassword.php?token=".$token;
            
            if($result_insert_into_password_reset_tokens){
                $conn->commit();
                mailfunction($email, $mail_msg, $firstname." ".$lastname);
                $res = array('statusCode' => '1', 'errCode' => '0', 'errMsg' => null); // successfully sended
                die(json_encode($res));
            }
            else{
                $conn->rollback();
                $res = array('statusCode' => '0', 'errCode' => '-1', 'errMsg' => "ERRGENTOKEN"); // successfully sended
                die(json_encode($res));
            }
        }
        else{
            $res = array('statusCode' => '1', 'errCode' => '1', 'errMsg' => 'MAILNOTFOUND'); // email not found
            die(json_encode($res));
        }
    }
    else{
        $res = array('statusCode' => '0', 'errCode' => '-2', 'errMsg' => 'PARAMEMPTY'); // email not found
        die(json_encode($res));
    }
?>