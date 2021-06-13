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
      <p class="h1">Forget Password</p>
    </div>
    <div class="card-body">
        <p class="login-box-msg">Enter Email To Get Reset Password Link</p>

        <div class='alert' hidden id='alert-msg' style="color: black;">
        </div>

        <form method="POST">
        <div class="input-group">
          <input type="text" class="form-control disable-class" placeholder="Email" name="email" id='emailTxt' onkeyup="validateEmail()" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <small id="email-err-msg" hidden></small>
        <small id="email-err-msg-blank">&nbsp;</small>

        <div class="row mt-3">
          <div class="col-5"></div>

          <div class="col-7">
            <button type="submit"  id='login-btn' class="btn btn-primary btn-block disable-class">Send Reset Link ...</button>
          </div>

        </div>
      </form>

      <div>
        &nbsp;
      </div>

    </div>
  </div>
</div>


<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

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

    $("#login-btn").on('click', function(e) {
        e.preventDefault();

        if(!validateEmail()){
            return false;
        }

        $("#alert-msg").prop('hidden', false);
        $(".disable-class").prop('disabled', true);
        $("#login-btn").html("Proccessing ...");
        $("#login-btn").removeClass("btn-primary");
        $("#login-btn").addClass("btn-warning");


        $.ajax({
            method: "POST",
            url: "./sendpasswordresetlink.php",
            data: {email: $("#emailTxt").val()},
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                if(data['statusCode'] == '1'){
                    if(data['errCode'] == '0'){
                        $("#alert-msg").html('Password Reset Link Has Been Sent To Email ...');
                        $("#alert-msg").addClass('alert-success');
                        $("#alert-msg").removeClass('alert-danger');
                    }
                    else if(data['errCode'] == '1'){
                        $("#alert-msg").html('Account Not Found');
                        $("#alert-msg").removeClass('alert-success');
                        $("#alert-msg").addClass('alert-danger');
                    }
                    else{
                        $("#alert-msg").html('Some Thing Went Wrong ...');
                        $("#alert-msg").removeClass('alert-success');
                        $("#alert-msg").addClass('alert-danger');
                    }
                }
                else{
                    $("#alert-msg").html('Some Thing Went Wrong ...');
                    $("#alert-msg").removeClass('alert-success');
                    $("#alert-msg").addClass('alert-danger');
                }

                $(".disable-class").prop('disabled', false);
                $("#login-btn").html("Send Reset Link ...");
                $("#login-btn").removeClass("btn-warning");
                $("#login-btn").addClass("btn-primary");
            },
            error: function(data){
                $("#alert-msg").html('Some Thing Went Wrong ...');
                $("#alert-msg").removeClass('alert-success');
                $("#alert-msg").addClass('alert-danger');
            }
        });
      

    });

</script>
</body>
</html>
