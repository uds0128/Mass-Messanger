<?php
    require('./dbconfig/config.php');
    $token = stripcslashes($_POST['_token']);
    $token = mysqli_real_escape_string($conn, $token);

    $password = stripcslashes($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    $userid = stripcslashes($_POST['userid']);
    $userid = mysqli_real_escape_string($conn, $userid);

    $cheackForTokenValidity = "select status from resetpasswordtokens WHERE token = '$token'";
    $result_cheackForTokenValidity = $conn->query($cheackForTokenValidity);
    $email = "";
    if($result_cheackForTokenValidity->num_rows){
        $row = $result_cheackForTokenValidity->fetch_assoc();
        $status = $row['status'];

        if(!$status){
            $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
            $update_reset_password_tokens = "UPDATE resetpasswordtokens SET status = 1 WHERE token = '$token'";
            $result_update_reset_password_tokens = $conn->query($update_reset_password_tokens);
        

            if($result_update_reset_password_tokens){
                $get_old_hash = "SELECT password_hash, email FROM users WHERE id = $userid";
                $result_get_old_hash = $conn->query($get_old_hash);

                if($result_get_old_hash->num_rows){
                    $row = $result_get_old_hash->fetch_assoc();
                    $old_hash = $row['password_hash'];
                    $email = $row['email'];

                    $new_hash = password_hash($password, PASSWORD_ARGON2ID);

                    $insert_log_into_reset_password = "INSERT INTO resetedpasswords (userid, old_hash, new_hash) VALUES ($userid, '$old_hash', '$new_hash')";
                    $result_insert_log_into_reset_password = $conn->query($insert_log_into_reset_password);

                    if($result_insert_log_into_reset_password){
                        $update_password_in_users = "UPDATE users SET password_hash = '$new_hash' WHERE id='$userid'";
                        $result_update_password_in_users = $conn->query($update_password_in_users);

                        if($result_update_password_in_users){
                            $conn->commit();
                            $errMsg = "";
                        }
                        else{
                            $conn->rollback();
                            $errMsg = "Something Went Wrong... 1";
                        }
                    }
                    else{
                        $conn->rollback();
                        $errMsg = "Something Went Wrong... 2";
                    }
                }
                else{
                    $conn->rollback();
                    $errMsg = "Something Went Wrong... 3";
                }
            }
            else{
                $conn->rollback();
                $errMsg = "Something Went Wrong... 4";
            }
        }    
        else{
            $errMsg = "Link Expired Please try Again...";
        }
    }
    else{
        $errMsg = "Something Went Wrong... 5";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Changed Succesfully</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class='dark-mode container'>
    <div class='row mt-5'>
    </div>
    <div class='row mt-5'>
    </div>
    <div class='row mt-5'>
    </div>
    <div class='row mt-5'>    
    </div>
    <div class='row mt-5'>
    </div>
    <?php
        if($errMsg == ""){
    ?>
    <div class='row mt-5'>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <center><h1 class='text-success'><?php echo $email?> Your Password has Been Changed Succesfully</h1></center>
        </div>
        <div class="col-md-2"></div>
    </div>
    <?php
        }
        else{
    ?>
    <div class='row mt-5'>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <center><h1 class='text-danger'><?php echo $errMsg;?></h1></center>
        </div>
        <div class="col-md-2"></div>
    </div>
    <?php
        }
    ?>

<!-- jQuery -->
<script src="../plugins/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>