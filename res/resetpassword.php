<?php

  require('./dbconfig/config.php');

  $token = stripcslashes($_GET['token']);
  $token = mysqli_real_escape_string($conn, $token);
  $errMsg = "";
  $userid = null;
  $validateToken = "SELECT userid FROM resetpasswordtokens JOIN users WHERE token='$token'";
  $result_validateToken = $conn->query($validateToken);
  if($result_validateToken->num_rows){
    $row = $result_validateToken->fetch_assoc();
    $userid = $row['userid'];
    
    $serchForName = "SELECT firstname, lastname, email FROM users WHERE id = $userid";
    $result_searchName = $conn->query($serchForName);

    if($result_searchName->num_rows){
      $row = $result_searchName->fetch_assoc();
      $firstname = $row['firstname'];
      $lastname = $row['lastname'];
      $email = $row['email'];
    }
    else{
      $errMsg = "Something Went Wrong ...";
    }
  }
  else{
    $errMsg = "Invalid Url OR Broken Url";
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
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page dark-mode">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h1 class="h1">Reset Password</h1>
    </div>
    <div class="card-header text-center">
      <h3 class='text-info'><?php echo $firstname." ".$lastname; ?></h3>
    </div>

    <div class="card-body">
      <p class="login-box-msg">Type Password ...</p>

      <!-- <?php 
        if($errMsg != ""){
          ?>

          <div class="alert  alert-danger" role="alert" style="background-color: #eb404e; color: black;" id="alert-msg">
          <?php echo $errMsg; ?>
          </div>

          <?php
        }
      ?> -->

      
      <!-- <form method="POST" id="login-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" > -->
      <form method="POST" id="login-form" action="./confirmresetpassword.php" >
      <input type="text" hidden name="_token" id="_token" value="<?php echo $token; ?>">
      <input type="text" hidden name="userid" id="userid" value="<?php echo $userid; ?>">
      <div class="input-group">
          <input type="password" class="form-control show-password" placeholder="Password" name="password" id="passwordTxt" onkeyup="validatePassword()" spellcheck="false" autocorrect="off" and autocapitalize="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <small id="password-err-msg" hidden></small>
        <small id="password-err-msg-blank">&nbsp;</small>
        <!-- <small>
          <label for="emailTxt" id="email-err-msg" hidden>fff</label>
        </small> -->
        <!-- <small>
          <label for="emailTxt" id="email-err-msg-hidden"></label>
        </small> -->
        <!-- <label for="emailTxt"><small id="email-err-msg"></small></label> -->
        <div class="input-group mt-3">
          <input type="password" class="form-control show-password" placeholder="Retype Password" name="confirmpassword" id="confirmPasswordTxt" onchange="validateConfirmPassword()" spellcheck="false" autocorrect="off" and autocapitalize="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <small id="confirm-password-err-msg" hidden></small>
        <small id="confirm-password-err-msg-blank">&nbsp;</small>
        <div class="row mt-3">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="showPassword" onchange="changePasswordVisibility()">
              <label for="showPassword">
                Show Password
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit"  id='confirm-btn' class="btn btn-primary btn-block">Confirm</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
      <div>
        &nbsp;
      </div>
      <!-- <p class="mb-0">
        <a href="./forgotpassword.php" class="text-center">Forgot Password ...</a>
      </p>
      <p class="mb-0">
        <a href="./register.php" class="text-center">New User? Register From Here ...</a>
      </p> -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<script>

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
    if($(".show-password").attr('type') == "password"){
      $(".show-password").attr('type', 'text');
    }
    else{
      $(".show-password").attr('type', 'password');
    }
  }

    $("#confirm-btn").on('click', function(e) {
      e.preventDefault();

      if(validateConfirmPassword() && validatePassword()){
        $("#login-form").submit();
      }
      return false;
    });

    function validateConfirmPassword() {
      let password = $("#passwordTxt").val();
      let confirmPassword = $("#confirmPasswordTxt").val();

      console.log(password);
      console.log(confirmPassword);

      $("#confirm-password-err-msg").prop("hidden", false);
      $("#confirm-password-err-msg-blank").prop("hidden", true);

      if(password != confirmPassword){
        $("#confirm-password-err-msg").html("Password Not Matched...");
        $("#confirm-password-err-msg").removeClass('text-success');
        $("#confirm-password-err-msg").addClass("text-danger");
        return false;
      }
      else{
        $("#confirm-password-err-msg").html("Password Matched...");
        $("#confirm-password-err-msg").removeClass('text-danger');
        $("#confirm-password-err-msg").addClass("text-success");
        return true;
      }
    }

</script>
</body>
</html>
