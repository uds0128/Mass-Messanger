<?php

  session_start();
  require('./res/dbconfig/config.php');

  $errMsg = "";
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    header("Location: ./res/home.php");
  }
  else{
    if(isset($_POST['email']) && isset($_POST['password'])){
      $email = stripcslashes($_POST['email']);
      $password = stripcslashes($_POST['password']);
      $email = mysqli_real_escape_string($conn, $email);
      $password = mysqli_real_escape_string($conn, $password);

      $query_for_credentials = "SELECT password_hash from users where email = '$email'";
      $result_query_for_credentials = $conn->query($query_for_credentials);

      if($result_query_for_credentials->num_rows){
        $row = $result_query_for_credentials->fetch_assoc();
        $dbpassword = $row['password_hash'];
        if(password_verify($password, $dbpassword)){
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header("Location: ./res/home.php");
        }
        else{
          $errMsg = "Invalid Email Or Password ...";
        }
      }
      else{
        $errMsg = "Invalid Email Or Password ...";
      }
    }
    else{
      $errMsg = "";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page dark-mode">
<div class="login-box">

  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h1>Log In</h1>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Log in to continue ...</p>

      <?php 
        if($errMsg != ""){
          ?>

          <div class="alert  alert-danger" role="alert" style="background-color: #eb404e; color: black;" id="alert-msg">
          <?php echo $errMsg; ?>
          </div>

          <?php
        }
      ?>

      
      <form method="POST" id="login-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Email" name="email" id='emailTxt' onkeyup="validateEmail()" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <small id="email-err-msg" hidden></small>
        <small id="email-err-msg-blank">&nbsp;</small>
        <div class="input-group mt-3">
          <input type="password" class="form-control" placeholder="Password" name="password" id="passwordTxt" spellcheck="false" autocorrect="off" and autocapitalize="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <small id="password-err-msg" hidden></small>
        <small id="password-err-msg-blank">&nbsp;</small>
        <div class="row mt-3">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="showPassword" onchange="changePasswordVisibility()">
              <label for="showPassword">
                Show Password
              </label>
            </div>
          </div>

          <div class="col-4">
            <button type="submit"  id='login-btn' class="btn btn-primary btn-block">Log In</button>
          </div>

        </div>
      </form>
      <div>
        &nbsp;
      </div>
      <p class="mb-0">
        <a href="./res/forgetpassword.php" class="text-center">Forgot Password ...</a>
      </p>
      <p class="mb-0">
        <a href="./res/register.php" class="text-center">New User? Register From Here ...</a>
      </p>
    </div>
  </div>
</div>



<script src="./plugins/jQuery-3.3.1/jquery-3.3.1.min.js"></script>

<!-- <script src="./plugins/"></script> -->

<script src="./dist/js/adminlte.min.js"></script>

<script>

    function validateEmail() {
      let ref = $('#emailTxt');
      let email = ref.val();
      email = email.replace(/\s+/g, "").trim().toLowerCase();
      ref.val(email);
      
      let mailformat = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      if(email.length == 0){
        $("#email-err-msg").html('Email is required ...');
        $("#email-err-msg").addClass('text-danger');
        $("#email-err-msg").removeClass('text-success');
        $("#email-err-msg").prop('hidden', false);
        $("#email-err-msg-blank").prop('hidden', true);
        return false;
      }
      else{
        if(email.match(mailformat)){
          $("#email-err-msg").html('Email is Valid ...');
          $("#email-err-msg").addClass('text-success');
          $("#email-err-msg").removeClass('text-danger');
          $("#email-err-msg").prop('hidden', false);
          $("#email-err-msg-blank").prop('hidden', true);
          return true;
        }
        else{
          $("#email-err-msg").html('Invalid Email ...');
          $("#email-err-msg").addClass('text-danger');
          $("#email-err-msg").removeClass('text-success');
          $("#email-err-msg").prop('hidden', false);
          $("#email-err-msg-blank").prop('hidden', true);
          return false;
        }
      }
    }

    function validatePassword() {
    let password = $("#passwordTxt").val();

    if(password.length == 0){
        $("#password-err-msg").html('Password is Required ...');
        $("password-err-msg").addClass('text-danger');
        $("#password-err-msg").removeClass('text-success');
        $("#password-err-msg").prop('hidden', false);
        $("#password-err-msg-blank").prop('hidden', true);
        return false;
    }

    if(password.length < 8){
        $("#password-err-msg").html('Password Must Contain at least 8 character');
        $("#password-err-msg").addClass('text-danger');
        $("#password-err-msg").removeClass('text-success');
        $("#password-err-msg").prop('hidden', false);
        $("#password-err-msg-blank").prop('hidden', true);
        return false;
    }

    password = password.replace(/\s+/g, " ");
    if(password.includes(' ')){
        $("#password-err-msg").html('Password Must Not Contain White Spaces ...');
        $("#password-err-msg").addClass('text-danger');
        $("#password-err-msg").removeClass('text-success');
        $("#password-err-msg").prop('hidden', false);
        $("#password-err-msg-blank").prop('hidden', true);
        return false;
    }

    if(password.length > 20){
        $("#password-err-msg").html('Password Must Contain at Most 20 character');
        $("#password-err-msg").addClass('text-danger');
        $("#password-err-msg").removeClass('text-success');
        $("#password-err-msg").prop('hidden', false);
        $("#password-err-msg-blank").prop('hidden', true);
        return false;
    }

    let validPasswordFormate = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$/;
    if(password.match(validPasswordFormate)){
        $("#password-err-msg").html('Password Is Valid');
        $("#password-err-msg").addClass('text-success');
        $("#password-err-msg").removeClass('text-danger');
        $("#password-err-msg").prop('hidden', false);
        $("#password-err-msg-blank").prop('hidden', true);
        return true;
    }
    else{
        $("#password-err-msg").html('Password Should Contain One Uppercase, One Digit And One Special Character ...');
        $("#password-err-msg").addClass('text-danger');
        $("#password-err-msg").removeClass('text-success');
        $("#password-err-msg").prop('hidden', false);
        $("#password-err-msg-blank").prop('hidden', true);
        return false;
    }
    return false;
  }

    function changePasswordVisibility() {
    if($("#passwordTxt").attr('type') == "password"){
      $("#passwordTxt").attr('type', 'text');
    }
    else{
      $("#passwordTxt").attr('type', 'password');
    }
  }

    $("#login-btn").on('click', function(e) {
      e.preventDefault();

      if(validateEmail()){
        $("#login-form").submit();
      }

      return false;

    });

</script>
</body>
</html>
