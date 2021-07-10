<?php
    require('./dbconfig/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification @Mass Messanger</title>
    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="dark-mode">

<?php
     if($isConnected){
         $errCode = null;
         if(isset($_GET['token'])){
             $token = mysqli_real_escape_string($conn, $_GET['token']);
             $query_for_token = "SELECT * FROM usersintermidiate WHERE token = '{$token}'";
             $result_query_for_token = $conn->query($query_for_token);
             if($result_query_for_token->num_rows){
                 $row = $result_query_for_token->fetch_assoc();
                 $firstname = $row['firstname'];
                 $lastname = $row['lastname'];
                 $verify_status = $row['verified_status'];
                 $email = $row['email'];
                 $password = $row['password_hash'];
                 $intermidiate_id = $row['id'];
                 if(!$verify_status){
                     $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
                     $verfy_update_query = "UPDATE usersintermidiate SET verified_at = CURRENT_TIMESTAMP, verified_status = true WHERE token = '{$token}'";
                     $result_verify_update_query = $conn->query($verfy_update_query);
                     if($result_verify_update_query){
                         $query_insert_into_users = "INSERT into users (email, firstname, lastname, password_hash, usersintermidiateid) VALUES ('$email', '$firstname', '$lastname', '$password', $intermidiate_id)";
                         $result_query_insert_into_users = $conn->query($query_insert_into_users);
                         if($result_query_insert_into_users){
                             $conn->commit();
                             $errCode = 1; // Successfully verified
                         }
                         else{
                             $conn->rollback();
                             $errCode = -3; // Err while inserting into users
                         }
                     }
                     else{
                         $conn->rollback();
                         $errCode = -2; // Error While VErifing
                     }
                 }
                 else{
                     $errCode = 0; // Already verify
                 }    
             }
             else{
                 $errCode = -1; // URL BROKEN OR INVALID URL
             }
         }
         else{
             $errCode = -4; // Param empty
         }
     }
     else{
         $errCode = -5; // Connection Error
     }
    
?>

<div class="container">
    <div class="row mt-5"></div>
    <div class="row mt-5"></div>
    <div class="row mt-5"></div>
    <div class="row mt-5">
        <div class="col-2"></div>
        <div class="col-8">
            <center><h1>Welcome to Verification Page</h1></center>
        </div>
        <div class="col-2"></div>
    </div>

    <?php
        if($errCode==1 || $errCode == 0){
    ?>
    <div class="row mt-5">
        <div class="col-2"></div>
        <div class="col-8">
            <center><h2 class="text-warning"><?php echo $firstname." ".$lastname ?></h3></center>
        </div>
        <div class="col-2"></div>
    </div>
    <?php           
        }
    ?>

    <?php
        if($errCode==1){
    ?>
    <div class="row mt-5">
        <div class="col-2"></div>
        <div class="col-8">
            <center><h2 class="text-success">Your Account Is Verified</h3></center>
        </div>
        <div class="col-2"></div>
    </div>
    <?php           
        }
    ?>


    <?php
        if($errCode==0){
    ?>
    <div class="row mt-5">
        <div class="col-2"></div>
        <div class="col-8">
            <center><h2 class="text-success">Your Account Is Already Verified</h3></center>
        </div>
        <div class="col-2"></div>
    </div>
    <?php           
        }
    ?>


    <?php
        if($errCode== -1 || $errCode == -4 || $errCode == -3){
    ?>
    <div class="row mt-5">
        <div class="col-2"></div>
        <div class="col-8">
            <center><h3 class="text-danger">Link Is Broken | Invalid Url</h3></center>
        </div>
        <div class="col-2"></div>
    </div>
    <?php           
        }
    ?>


    <?php
        if($errCode == -5){
    ?>
    <div class="row mt-5">
        <div class="col-2"></div>
        <div class="col-8">
            <center><h3 class="text-danger">Something Went Wrong</h3></center>
        </div>
        <div class="col-2"></div>
    </div>
    <?php           
        }
    ?>
    
  </div>




</body>
<!-- jQuery -->
<script src="../plugins/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</html>