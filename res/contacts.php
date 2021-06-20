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

  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

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

    tr {
      text-align: center;
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
                        <input type="hidden" id='contact-id'>
                        <label for="first-name-txt">First Name</label>
                        <input type="text" class="form-control is-disable" id="first-name-txt" placeholder="First Name">
                        <small><label for="first-name-txt" id="first-name-err-msg"></label></small>
                      </div>
                      <div class="form-group col-md-2">
                        <label for="middle-name-txt">Middle Name</label>
                        <input type="text" class="form-control is-disable" id="middle-name-txt"
                          placeholder="Middle Name">
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
                      <button type="submit" id="add-contact-btn" class="btn btn-primary mr-1 is-disable">AddContact</button>
                      <button id="update-btn" class="btn btn-primary mr-1" disabled>Update</button>
                      <input type="reset" name="" class="btn btn-primary" id="reset-btn" value="reset">
                      <!-- <button onclick="resetFor" class="btn btn-primary is-disable">Reset</button> -->
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Contacts</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <table id="contact-table" class="table table-bordered table-striped table-hover table-sm">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>First<br>Name</th>
                  <th>Middle<br>Name</th>
                  <th>Last<br>Name</th>
                  <th>Email</th>
                  <th>Mobile<br>No</th>
                  <th width="10%">Actions</th>
                </tr>
              </thead>
              <tbody>

              </tbody>

            </table>
          </div>
          <!-- /.card-body -->
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
  <script src="../plugins/jQuery-3.3.1/jquery-3.3.1.min.js"></script>

  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.js"></script>

  <!-- DataTables  & Plugins -->
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../plugins/jszip/jszip.min.js"></script>
  <script src="../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <script src="../plugins/toastr/toastr.min.js"></script>



  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../dist/js/pages/dashboard2.js"></script>


  <script>

    $(document).ready(function () {
      $("#contact-table").DataTable({
        "autoWidth": false,
        "paging": true,
        "processing": true,
        "serverSide": true,
        "order": [],
        "info": true,
        "ajax": {
          url: "./api/contacts/fetchcontact.php",
          type: "POST"
        },
        "columnDefs": [
          {
            "targets": [-1],
            "orderable": false,
          }
        ]
      });
    });

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
              $("#contact-table").DataTable().ajax.reload();
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
      $("#contact-id").val(null);
      $("#first-name-err-msg").html("");
      $("#middle-name-err-msg").html("");
      $("#last-name-err-msg").html("");
      $("#mobile-no-err-msg").html("");
      $("#email-err-msg").html("");
      $("#add-contact-btn").prop("disabled", false);
      $("#update-btn").prop("disabled", true);
    }

    $("#first-name-txt").on('change', validateFirstNameMaster);

    function validateFirstNameMaster() {
      console.log("First Name M");
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
      console.log("First Name M");
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

    $("tbody").on('click', '.update-contact', function () {
      resetAddContactForm();
      var id = $(this).attr('contact-id');
      $("#add-contact-btn").attr('disabled', true);
      $("#update-btn").attr('disabled', false);
      

      $.ajax({
        url: "./api/contacts/getcontactdata.php?id="+id,
        method: "get",
        data: { id: id },
        dataType: "json",
        success: function (res) {
          $("#contact-id").val(id);
          $("#first-name-txt").val(res.firstname);
          $("#middle-name-txt").val(res.middlename);
          $("#last-name-txt").val(res.lastname);
          $("#email-txt").val(res.email);
          $("#mobile-no-txt").val(res.contactno);
        },
        error: function (err) {
          console.log("Err In ", err);
        }
      });
    });

    $("#update-btn").on('click', function (e) {
        e.preventDefault();
        
        var id = $("#contact-id").val();

        if(id == null){
          toastr.error("Something Went Worng, Please refresh the page");
        }

        if (validateFirstNameMaster() && validateMiddleNameMaster() && validateLastNameMaster() && validateEmailMaster() && validateMobileNoMaster()) {

          $(".is-disable").prop('disabled', true);
          $.ajax({
            method: "POST",
            url: "./api/contacts/updatecontact.php",
            data: {
              id: id,
              firstname: $("#first-name-txt").val(),
              middlename: $("#middle-name-txt").val(),
              lastname: $("#last-name-txt").val(),
              email: $("#email-txt").val(),
              contactno: $("#mobile-no-txt").val()
            },
            dataType: "json",
            success: function (res) {
              if (res.status == 1) {
                $("#contact-table").DataTable().ajax.reload();
                toastr.success("Contact Updated Successfully");
                resetAddContactForm();
                $(".is-disable").prop('disabled', false);
                $("#update-btn").prop("disabled", true);
                
              }
              else {
                toastr.error("Something Went Worng");
                $(".is-disable").prop('disabled', false);
                $("#add-contact-btn").prop("disabled", true);
              }
            },
            error: function (err) {
              toastr.error("Something Went Worng");
              console.error("Err In ./api/contacts/addcontact.php");
              $(".is-disable").prop('disabled', false);
              $("#add-contact-btn").prop("disabled", true);
            }
          });
        }
        else {
          toastr.error("Something Went Worng, Please refresh the page");
        }
      });

    $("#reset-btn").on('click', resetForm);
    
    $("tbody").on("click", '.delete-contact', function() {
      var id = $(this).attr("contact-id");
      
      $.ajax({
        url: "./api/contacts/deletecontact.php",
        type: "POST",
        data: {id: id},
        dataType: "json",
        success: function(res){
          if(res.status == 1){
            $("#contact-table").DataTable().ajax.reload();
            toastr.success("Contact deleted successfully");
          }
          else{
            toastr.error("Something Went Worng, Please try again");
          }
        },
        error: function(err){
          console.log("Err in ./api/contacts/deletecontact.php");
          toastr.error("Something Went Worng, Please refresh the page");
        }
        
      })
    });

    function resetForm(){
      resetAddContactForm();
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