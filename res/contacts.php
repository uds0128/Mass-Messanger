<?php
  session_start();

  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contacts</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">

  <style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style>
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <?php include('preloader.php'); ?>

    <!-- Navbar -->
    <?php include('navbar.php'); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include('sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Contacts</h1>
            </div>
          </div>
        </div>
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add Contacts</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="add-contact-form">
                  <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-2">
                        <label for="first-name-txt">First Name</label>
                        <input type="text" class="form-control is-disable" id="first-name-txt" placeholder="First Name">
                        <small><label for="first-name-txt" id="first-name-err-msg"></label></small>
                      </div>
                      <div class="form-group col-md-2">
                        <label for="middle-name-txt">Middle Name</label>
                        <input type="text" class="form-control is-disable" id="middle-name-txt" placeholder="Middle Name">
                        <small><label for="middle-name-txt" id="middle-name-err-msg"></label></small>
                      </div>
                      <div class="form-group col-md-2">
                        <label for="last-name-txt">Last Name</label>
                        <input type="text" class="form-control is-disable" id="last-name-txt" placeholder="Last Name">
                        <small><label for="last-name-txt" id="last-name-err-msg"></label></small>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="email-txt">Email</label>
                        <input type="text" class="form-control is-disable" id="email-txt" placeholder="Email">
                        <small><label for="email-txt" id="email-err-msg"></label></small>
                      </div>
                      <div class="form-group col-md-2">
                        <label for="mobile-no-txt">Mobile No</label>
                        <input type="number" class="form-control is-disable" id="mobile-no-txt" placeholder="Mobile No">
                        <small><label for="mobile-no-txt" id="mobile-no-err-msg"></label></small>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <div align="right">
                      <button type="submit" id="add-contact-btn" class="btn btn-primary mr-1 is-disable">Add Contact</button>
                      <button type="reset" class="btn btn-primary is-disable">Reset</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?php include('footer.php'); ?>

  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.js"></script>

  <script src="../plugins/toastr/toastr.min.js"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <!-- <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
ChartJS
<script src="plugins/chart.js/Chart.min.js"></script> -->

  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../dist/js/pages/dashboard2.js"></script>

  <script>
    $("#add-contact-btn").on('click', function (e) {
      e.preventDefault();

      if (validateFirstNameMaster() && validateMiddleNameMaster() && validateLastNameMaster() && validateEmailMaster() && validateMobileNoMaster()) {
        $(".is-disable").prop('disabled', true);
        $.ajax({
          type: "post",
          url: "./api/contacts/addcontact.php",
          data: {
            firstname: $("#first-name-txt").val(),
            middlename: $("#middle-name-txt").val(),
            lastname: $("#last-name-txt").val(),
            email: $("#email-txt").val(),
            contactno: $("#mobile-no-txt").val()
          },
          dataType: "json",
          success: function (res) {
            if (res.status == 1) {
              toastr.success("Contact : " + $("#first-name-txt").val() + " " + $("#last-name-txt").val() + " Added Succesfully");
              resetAddContactForm();
              $(".is-disable").prop('disabled', false);
            }
            else {
              toastr.error("Something Went Worng");
              $(".is-disable").prop('disabled', false);
            }
          },
          error: function (err) {
            console.error("Err In ./api/contacts/addcontact.php");
            $(".is-disable").prop('disabled', false);
          }
        });
      }
    });

    function resetAddContactForm() {
      $("#add-contact-form").trigger("reset");
      $("#first-name-txt").removeClass("border-success");
      $("#first-name-txt").removeClass("border-danger");
      $("#middle-name-txt").removeClass("border-success");
      $("#middle-name-txt").removeClass("border-danger");
      $("#last-name-txt").removeClass("border-success");
      $("#last-name-txt").removeClass("border-danger");
      $("#mobile-no-txt").removeClass("border-success");
      $("#mobile-no-txt").removeClass("border-danger");
      $("#email-txt").removeClass("border-success");
      $("#email-txt").removeClass("border-danger");
    }

    $("#first-name-txt").on('change', validateFirstNameMaster);

    function validateFirstNameMaster() {
      var firstName = $("#first-name-txt").val();
      firstName = firstName.trim().replace(/\s+/g, " ").replace(/\w\S*/g, function (txt) { return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); });
      $("#first-name-txt").val(firstName);

      var errMsg = validateName(firstName);

      if (errMsg) {
        $("#first-name-txt").removeClass('border-success');
        $("#first-name-txt").addClass('border-danger');
      }
      else {
        $("#first-name-txt").removeClass('border-danger');
        $("#first-name-txt").addClass('border-success');
      }

      $("#first-name-err-msg").html(errMsg);
      if (errMsg) {
        return false;
      }
      return true;
    }

    $("#middle-name-txt").on('change', validateMiddleNameMaster);

    function validateMiddleNameMaster() {
      var middleName = $("#middle-name-txt").val();
      middleName = middleName.trim().replace(/\s+/g, " ").replace(/\w\S*/g, function (txt) { return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); });
      $("#middle-name-txt").val(middleName);

      var errMsg = validateName(middleName);

      if (errMsg) {
        $("#middle-name-txt").removeClass('border-success');
        $("#middle-name-txt").addClass('border-danger');
      }
      else {
        $("#middle-name-txt").removeClass('border-danger');
        $("#middle-name-txt").addClass('border-success');
      }

      $("#middle-name-err-msg").html(errMsg);
      if (errMsg) {
        return false;
      }
      return true;
    }

    $("#last-name-txt").on('change', validateLastNameMaster);

    function validateLastNameMaster() {
      var lastName = $("#last-name-txt").val();
      lastName = lastName.trim().replace(/\s+/g, " ").replace(/\w\S*/g, function (txt) { return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); });
      $("#last-name-txt").val(lastName);

      var errMsg = validateName(lastName);

      if (errMsg) {
        $("#last-name-txt").removeClass('border-success');
        $("#last-name-txt").addClass('border-danger');
      }
      else {
        $("#last-name-txt").removeClass('border-danger');
        $("#last-name-txt").addClass('border-success');
      }

      $("#last-name-err-msg").html(errMsg);
      if (errMsg) {
        return false;
      }
      return true;
    }

    function validateName(name) {
      var errMsg = "";
      if (name.length == 0) {
        errMsg = "Field Is Required";
        return errMsg;
      }

      if (name.length > 20) {
        errMsg = "Max 20 Characters";
        return errMsg;
      }

      return errMsg;

    }

    $("#email-txt").on('change', validateEmailMaster);

    function validateEmailMaster() {
      var email = $("#email-txt").val();
      email = email.trim().replace(/\s+/g, "").toLowerCase();
      $("#email-txt").val(email);

      var errMsg = validateEmail(email);

      if (errMsg) {
        $("#email-txt").removeClass('border-success');
        $("#email-txt").addClass('border-danger');
      }
      else {
        $("#email-txt").removeClass('border-danger');
        $("#email-txt").addClass('border-success');
      }

      $("#email-err-msg").html(errMsg);
      if (errMsg) {
        return false;
      }
      return true;
    }

    function validateEmail(email) {
      var mailformat = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      var errMsg = "";
      if (email.length == 0) {
        errMsg = "Field is Required";
        return errMsg;
      }


      if (!email.match(mailformat)) {
        errMsg = "Invalid Email Formate";
        return errMsg;
      }



      if (email.length > 255) {
        errMsg = "Max 255 Characters";
        return errMsg;
      }

      return errMsg;
    }

    $("#mobile-no-txt").on('change', validateMobileNoMaster);

    function validateMobileNoMaster() {
      var mobileNo = $("#mobile-no-txt").val();
      mobileNo = mobileNo.trim().replace(/\s+/g, "").toLowerCase();
      $("#mobile-no-txt").val(mobileNo);

      var errMsg = validateMobileNo(mobileNo);

      if (errMsg) {
        $("#mobile-no-txt").addClass('border-danger');
        $("#mobile-no-txt").removeClass('border-success');
      }
      else {
        $("#mobile-no-txt").addClass('border-success');
        $("#mobile-no-txt").removeClass('border-danger');
      }

      $("#mobile-no-err-msg").html(errMsg);
      if (errMsg) {
        return false;
      }
      return true;
    }

    function validateMobileNo(mobileNo) {
      var mailformat = /^[789]\d{9}$/;
      var errMsg = "";

      if (mobileNo.length == 0) {
        errMsg = "Field Is Required";
        return errMsg;
      }

      if (mobileNo.length < 10) {
        errMsg = "Incomplete Mobile No";
        return errMsg;
      }

      if (!mobileNo.match(mailformat)) {
        errMsg = "Invalid No";
        return errMsg;
      }

      return errMsg;
    }

  </script>
</body>

</html>

<?php
  }
  else{
    header("Location: ../index.php");
  }
?>