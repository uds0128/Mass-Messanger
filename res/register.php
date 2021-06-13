<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign Up</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

</head>
<body class="hold-transition register-page dark-mode">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h1>Sign Up</h1>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new user</p>
      <div class="alert" hidden id="res-msg-alert" style="color: black;" >
        alert
      </div>
      <form action="./registeruser.php" method="post">
        <div class="input-group">
          <input type="text" class="form-control temp-disable" placeholder="First Name" name="firstname" id="firstNameTxt" onkeyup="validateFirstName()" onchange="trimTheField(this, validateFirstName)">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <small id="first-name-err-msg" hidden></small>
        <small id="first-name-err-msg-blank">&nbsp;</small>
        <div class="input-group mt-3">
          <input type="text" class="form-control temp-disable" placeholder="Last Name" name="lastname" id="lastNameTxt" onkeyup="validateLastName()" onchange="trimTheField(this, validateLastName)">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <small id="last-name-err-msg" hidden></small>
        <small id="last-name-err-msg-blank">&nbsp;</small>
        <div class="input-group mt-3">
          <input type="text" class="form-control temp-disable" placeholder="Email" name="email" id="emailTxt" onkeyup="validateEmail()" onchange="trimTheField(this, validateEmail)">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <small id="email-err-msg" hidden></small>
        <small id="email-err-msg-blank">&nbsp;</small>
        <div class="input-group mt-3">
          <input type="password" class="form-control temp-disable" placeholder="Password" name="password" id="passwordTxt" onkeyup="validatePassword()">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <small id="password-err-msg" hidden></small>
        <small id="password-err-msg-blank">&nbsp;</small>
        <div class="input-group mt-3">
          <input type="password" class="form-control temp-disable" placeholder="Retype password" name="cpassword" id="confirmPasswordTxt" onchange="validateConfirmPassword()">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <small id="confirm-password-err-msg" hidden></small>
        <small id="confirm-password-err-msg-blank">&nbsp;</small>
        <div class="row">
          <div class="col-7">
            <!-- <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div> -->
          </div>
          <!-- /.col -->
          <div class="col-5">
            <button type="submit" class="btn btn-primary btn-block temp-disable" id="submit-btn">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div> -->
        <div>
            &nbsp;
        </div>
      <a href="../index.php" class="text-center">I already have a Account</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<script>
  
  
  function validateFirstName() {

    let firstName = $("#firstNameTxt").val();
    firstName = firstName.replace(/\s+/g, " ").replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
    $("#firstNameTxt").val(firstName);

    $("#first-name-err-msg").prop('hidden', false);
    $("#first-name-err-msg-blank").prop('hidden', true);

    if(firstName.length == 0){
        $("#first-name-err-msg").html('First Name is required ...');
        $("#first-name-err-msg").addClass('text-danger');
        $("#first-name-err-msg").removeClass('text-success');
        return false;
    }

    if(firstName.length > 30){
        $("#first-name-err-msg").html('Max Character 30 ...');
        $("#first-name-err-msg").addClass('text-danger');
        $("#first-name-err-msg").removeClass('text-success');
        return false;
    }

    $("#first-name-err-msg").html('Valid ..');
    $("#first-name-err-msg").addClass('text-success');
    $("#first-name-err-msg").removeClass('text-danger');
    return true;
  }

  function validateLastName() {
    let lastName = $("#lastNameTxt").val();
    lastName = lastName.replace(/\s+/g, " ").replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
    $("#lastNameTxt").val(lastName);

    $("#last-name-err-msg").prop('hidden', false);
    $("#last-name-err-msg-blank").prop('hidden', true);

    if(lastName.length == 0){
        $("#last-name-err-msg").html('First Name is required ...');
        $("#last-name-err-msg").addClass('text-danger');
        $("#last-name-err-msg").removeClass('text-success');
        return false;
    }

    if(lastName.length > 30){
        $("#last-name-err-msg").html('Max Character 30 ...');
        $("#last-name-err-msg").addClass('text-danger');
        $("#last-name-err-msg").removeClass('text-success');
        return false;
    }

    $("#last-name-err-msg").html('Valid ..');
    $("#last-name-err-msg").addClass('text-success');
    $("#last-name-err-msg").removeClass('text-danger');
    return true;
  }

  function validateEmail() {
    let isValid = false;
    let email = $('#emailTxt').val();
    email = email.replace(/\s+/g, "").trim().toLowerCase();
    email = email.trim();
    $('#emailTxt').val(email);
    $("#email-err-msg").prop('hidden', false);
    $("#email-err-msg-blank").prop('hidden', true);
    let mailformat = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  
    if(email.length == 0){
      $("#email-err-msg").html('Email is required ...');
    }
    else if(email.length > 320 ){
      $("#email-err-msg").html('Maximum Email 320 Character ...');
    }
    else{
      if(email.match(mailformat)){
        isValid = true;
        $("#email-err-msg").html('Email is Valid ...');
      }
      else{
        $("#email-err-msg").html('Invalid Email ...');
      }
    }

    if(isValid){
      $("#email-err-msg").addClass('text-success');
      $("#email-err-msg").removeClass('text-danger');
      return true;
    }
    else{
      $("#email-err-msg").addClass('text-danger');
      $("#email-err-msg").removeClass('text-success');
      return false;
    }
  }

  function validatePassword() {
    let password = $("#passwordTxt").val();

    $("#password-err-msg").prop('hidden', false);
    $("#password-err-msg-blank").prop('hidden', true);

    if(password.length == 0){
        $("#password-err-msg").html('Password is Required ...');
        return updateClass(false, $("#password-err-msg"));
    }

    if(password.length < 8){
        $("#password-err-msg").html('Password Must Contain at least 8 character');
        return updateClass(false, $("#password-err-msg"));
    }

    password = password.replace(/\s+/g, " ");
    if(password.includes(' ')){
        $("#password-err-msg").html('Password Must Not Contain White Spaces ...');
        return updateClass(false, $("#password-err-msg"));
    }

    if(password.length > 20){
        $("#password-err-msg").html('Password Must Contain at Most 20 character');
        return updateClass(false, $("#password-err-msg"));
    }

    let validPasswordFormate = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$/;
    if(password.match(validPasswordFormate)){
        $("#password-err-msg").html('Password Is Valid');
        return updateClass(true, $("#password-err-msg"));
    }
    else{
        $("#password-err-msg").html('Password Should Contain One Uppercase, One Digit And One Special Character ...');
        return updateClass(false, $("#password-err-msg"));
    }
  }

  function validateConfirmPassword() {
    console.log("Hello");
    $("#confirm-password-err-msg").prop('hidden', false);
    $("#confirm-password-err-msg-blank").prop('hidden', true);
    let password = $("#passwordTxt").val();
    let confirmPassword = $("#confirmPasswordTxt").val();
    console.log(password);
    console.log(confirmPassword);
    if(password == confirmPassword){
      $("#confirm-password-err-msg").html("Password Matched ...");
      $("#confirm-password-err-msg").addClass("text-success");
      $("#confirm-password-err-msg").removeClass("text-danger");
      return true;
    }
    
    $("#confirm-password-err-msg").html("Password Not Matched ...");
    $("#confirm-password-err-msg").addClass("text-danger");
    $("#confirm-password-err-msg").removeClass("text-success");
    return false;
  }

  function trimTheField(ref, callback){
    ref.value = ref.value.trim();
    callback();
  }

  function updateClass(isValid, ref) {
    if(!isValid) {
      ref.addClass('text-danger');
      ref.removeClass('text-success');
      return false;
    }

    ref.addClass('text-success');
    ref.removeClass('text-danger');
    return true;
  }

  function validateForm() {

    if(!validateFirstName()){
      return false;
    }
    
    if(!validateLastName()){
      return false;
    }
    
    if(!validateEmail()){
      return false;
    }
    
    if(!validatePassword()){
      return false;
    }
    
    if(!validateConfirmPassword()){
      return false;
    }

    return true;
  }
 
  $("#submit-btn").on('click', function(e){
    e.preventDefault();
    if(!validateForm()){
      return false;
    }
    
    $(".temp-disable").prop("disabled", true);
    $("#submit-btn").html("Submitting ...");
    $("#submit-btn").removeClass("btn-primary");
    $("#submit-btn").addClass("btn-warning");

    $.ajax({
      type: "POST",
      url: "./registeruser.php",
      data: {
        firstname: $("#firstNameTxt").val(),
        lastname: $("#lastNameTxt").val(),
        email: $("#emailTxt").val(),
        _password: $("#passwordTxt").val()
      },
      dataType: "JSON",
      success: function(data) {
        $("#res-msg-alert").prop('hidden', false);
        if(data['statusCode'] != "0"){
          if(data['statusCode'] == '1'){
            $("#res-msg-alert").removeClass("alert-info");
            $("#res-msg-alert").removeClass("alert-danger");
            $("#res-msg-alert").removeClass("alert-warning");
            $("#res-msg-alert").addClass("alert-success");
            $("#res-msg-alert").html("Your Registartion has been successfully completed Verification Link has been send to your registered email");
            setTimeout(() => {
              window.location.href = "./index.php";
            }, 1500);
          }
          else if(data['statusCode'] == '2'){
            $("#res-msg-alert").removeClass("alert-warning");
            $("#res-msg-alert").removeClass("alert-danger");
            $("#res-msg-alert").removeClass("alert-success");
            $("#res-msg-alert").addClass("alert-info");
            $("#res-msg-alert").html("Account Already exists on this Email-Address");
          }
          else if(data['statusCode'] == '3'){
            $("#res-msg-alert").removeClass("alert-success");
            $("#res-msg-alert").removeClass("alert-danger");
            $("#res-msg-alert").removeClass("alert-info");
            $("#res-msg-alert").addClass("alert-warning");
            $("#res-msg-alert").html("Email Already Registered! Account Verification Pending");
          }
        }
        else{
          $("#res-msg-alert").removeClass("alert-success");
          $("#res-msg-alert").removeClass("alert-warning");
          $("#res-msg-alert").removeClass("alert-info");
          $("#res-msg-alert").addClass("alert-danger");
          $("#res-msg-alert").html("Something Went Wrong Please Try Again");
        }
        $(".temp-disable").prop("disabled", false);
        $("#submit-btn").html("Register");
        $("#submit-btn").removeClass("btn-warning");
        $("#submit-btn").addClass("btn-primary");
      },
      error: function() {

      }
    })

  });
  
  </script>
</body>
</html>
