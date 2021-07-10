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

   <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

   <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">

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
                        <div class="card-header">Add Contacts</div>
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="select-group">Select Group</label>
                                    <select id="select-group" class="form-control">
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-2">
                                 <input type="hidden" id='contact-id'>
                                 <label for="first-name-txt">First Name</label>
                                 <input type="text" class="form-control is-disable" id="first-name-txt"
                                    placeholder="First Name">
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
                                 <input type="text" class="form-control is-disable" id="last-name-txt"
                                    placeholder="Last Name">
                                 <small><label for="last-name-txt" id="last-name-err-msg"></label></small>
                              </div>
                              <div class="form-group col-md-4">
                                 <label for="email-txt">Email</label>
                                 <input type="text" class="form-control is-disable" id="email-txt" contactid=""
                                    placeholder="Email">
                                 <small><label for="email-txt" id="email-err-msg"></label></small>
                              </div>
                              <div class="form-group col-md-2">
                                 <label for="mobile-no-txt">Mobile No</label>
                                 <input type="number" class="form-control is-disable" id="mobile-no-txt"
                                    placeholder="Mobile No">
                                 <small><label for="mobile-no-txt" id="mobile-no-err-msg"></label></small>
                              </div>
                           </div>
                        </div>
                        <div class="card-footer text-right">
                           <button id="add-contact-btn" class="btn btn-sm btn-primary mr-1">Add Contact</button>
                           <button id="update-contact-btn" class="btn btn-sm btn-secondary mr-1" hidden>Update
                              Contact</button>
                           <button id="add-contact-reset-btn" class="btn btn-sm btn-secondary">Reset</button>
                        </div>
                     </div>

                     <div class="card card-primary">
                        <div class="card-header">Contacts In <span id='show-group-name'></span></div>
                        <div class="card-body">
                           <div class="row mb-3">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="select-group-for-tbl">Select Group</label>
                                    <select id="select-group-for-tbl" class="form-control">
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12 table-responsive">
                                 <table id="contact-table"
                                    class="table table-bordered table-striped table-hover table-sm">
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
                           </div>
                        </div>
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

   <script src="../plugins/select2/js/select2.full.min.js"></script>

   <!-- AdminLTE for demo purposes -->
   <script src="../dist/js/demo.js"></script>
   <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
   <script src="../dist/js/pages/dashboard2.js"></script>


   <script>
      $(document).ready(function () {
         reloadGroupNames();

         $('#select-group').select2({
            theme: 'bootstrap4'
         });

         $('#select-group-for-tbl').select2({
            theme: 'bootstrap4'
         });

         $("#contact-table").DataTable({
            "autoWidth": false,
            "paging": true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "info": true,
            "ajax": {
               url: "./api/contacts/fetchcontact.php",
               type: "POST",
               data: function (d) {
                  d.groupid = $('#select-group-for-tbl').val();
               },
               dataSrc: function (json) {
                  var return_data = new Array();
                  for (i = 0; i < json.data.length; i++) {
                     return_data.push({
                        'id': json.data[i][0],
                        'fname': json.data[i][1],
                        'mname': json.data[i][2],
                        'lname': json.data[i][3],
                        'email': json.data[i][4],
                        'contactno': json.data[i][5],
                        'action': formActionButtons(json.data[i][0])
                     });
                  }
                  return return_data;
               }
            },
            "columnDefs": [
               {
                  "targets": [-1],
                  "orderable": false,
               }
            ],
            "columns": [
               { 'data': 'id' },
               { 'data': 'fname' },
               { 'data': 'mname' },
               { 'data': 'lname' },
               { 'data': 'email' },
               { 'data': 'contactno' },
               { 'data': 'action' },
            ]
         });
      });

      $("#add-contact-btn").on('click', function () {
         if (validateFirstNameMaster() && validateMiddleNameMaster() && validateLastNameMaster() && validateEmailMaster() && validateMobileNoMaster()) {
            $("#add-contact-btn").prop('disabled', true);
            $.ajax({
               type: "post",
               url: "./api/contacts/addcontact.php",
               data: {
                  firstname: $("#first-name-txt").val(),
                  middlename: $("#middle-name-txt").val(),
                  lastname: $("#last-name-txt").val(),
                  email: $("#email-txt").val(),
                  contactno: $("#mobile-no-txt").val(),
                  groupid: $("#select-group").val()
               },
               dataType: "json",
               success: function (res) {
                  if (res.status == 1) {
                     $("#contact-table").DataTable().ajax.reload();
                     toastr.success("Contact : " + $("#first-name-txt").val() + " " + $("#last-name-txt").val() + " Added Succesfully");
                     resetForm();
                     $("#add-contact-btn").prop('disabled', false);
                  }
                  else {
                     toastr.error("Something Went Worng");
                     $("#add-contact-btn").prop('disabled', false);
                  }
               },
               error: function (err) {
                  console.error("Err In ./api/contacts/addcontact.php");
                  $("#add-contact-btn").prop('disabled', false);
               }
            });
         }
      });

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
         var mailformat = /^[6789]\d{9}$/;
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

      function reloadGroupNames() {
         $.ajax({
            method: 'get',
            url: "./api/contacts/getallgroupnames.php",
            dataType: 'json',
            async: false,
            success: function (res) {
               if (res.status == 1) {
                  $("#select-group").append(new Option("All", 0));
                  $("#select-group-for-tbl").append(new Option("All", 0));
                  for (let i = 0; i < res.data.length; i++) {
                     $("#select-group").append(new Option(res.data[i]['name'], res.data[i]['id']))
                     $("#select-group-for-tbl").append(new Option(res.data[i]['name'], res.data[i]['id']))
                  }
               }
               else {
                  tostr.error("Something Went Wrong");
               }
            },
            error: function (err) {
               console.log("Err In ./api/managegroup/getallgroupnames.php");
               tostr.error("Something Went Wrong");
            }
         });
      }

      function resetForm() {
         $("#first-name-txt").val("");
         $("#first-name-txt").removeClass("border-success");
         $("#first-name-txt").removeClass("border-danger");
         $("#middle-name-txt").val("");
         $("#middle-name-txt").removeClass("border-success");
         $("#middle-name-txt").removeClass("border-danger");
         $("#last-name-txt").val("");
         $("#last-name-txt").removeClass("border-success");
         $("#last-name-txt").removeClass("border-danger");
         $("#mobile-no-txt").val("");
         $("#mobile-no-txt").removeClass("border-success");
         $("#mobile-no-txt").removeClass("border-danger");
         $("#email-txt").val("");
         $("#email-txt").attr("contactid", "");
         $("#email-txt").removeClass("border-success");
         $("#email-txt").removeClass("border-danger");
         $("#first-name-err-msg").html("");
         $("#middle-name-err-msg").html("");
         $("#last-name-err-msg").html("");
         $("#mobile-no-err-msg").html("");
         $("#email-err-msg").html("");
         $("#add-contact-btn").prop("disabled", false);
         $("#add-contact-btn").attr('hidden', false);
         $("#update-contact-btn").attr('hidden', true);
      }

      $("#add-contact-reset-btn").on('click', resetForm);

      function formActionButtons(id) {
         return "<div class='d-flex'><button class='btn btn-sm btn-success mr-2' onclick='updateContact(" + id + ")'>Update</button><button class='btn btn-sm btn-danger' onclick='deleteContact(" + id + ")'>Delete</button></div>";
      }

      $("#select-group-for-tbl").on('change', function () {
         $("#contact-table").DataTable().ajax.reload();
      });

      function updateContact(id) {
         resetForm();
         $("#add-contact-btn").attr('hidden', true);
         $("#update-contact-btn").attr('hidden', false);

         $.ajax({
            url: "./api/contacts/getcontactdata.php?id=" + id,
            method: "get",
            dataType: "json",
            success: function (res) {
               $("#first-name-txt").val(res.firstname);
               $("#middle-name-txt").val(res.middlename);
               $("#last-name-txt").val(res.lastname);
               $("#email-txt").val(res.email);
               $("#mobile-no-txt").val(res.contactno);
               $("#email-txt").attr('contactid', id);
            },
            error: function (err) {
               console.log("Err In ./api/contacts/getcontactdata.php");
               toastr.error("Something Went Wrong");
            }
         });
      }

      function deleteContact(id) {
         $.ajax({
            url: "./api/contacts/deletecontact.php",
            type: "POST",
            data: { id: id },
            dataType: "json",
            success: function (res) {
               if (res.status == 1) {
                  $("#contact-table").DataTable().ajax.reload();
                  toastr.success("Contact deleted successfully");
               }
               else {
                  toastr.error("Something Went Worng, Please try again");
               }
            },
            error: function (err) {
               console.log("Err in ./api/contacts/deletecontact.php");
               toastr.error("Something Went Worng, Please refresh the page");
            }

         })
      }

      $("#update-contact-btn").on('click', function () {
         contactid = $("#email-txt").attr('contactid');

         if (contactid == '' || contactid == null) {
            toastr.error("Something Went Wrong");
            return;
         }
         if (validateFirstNameMaster() && validateMiddleNameMaster() && validateLastNameMaster() && validateEmailMaster() && validateMobileNoMaster()) {
            $.ajax({
               method: "POST",
               url: "./api/contacts/updatecontact.php",
               data: {
                  id: contactid,
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
                     resetForm();
                  }
                  else {
                     toastr.error("Something Went Worng");
                  }
               },
               error: function (err) {
                  toastr.error("Something Went Worng");
                  console.error("Err In ./api/contacts/addcontact.php");
               }
            });
         }
      });

   </script>
</body>

</html>

<?php
  }
  else{
    header("Location: ../index.php");
  }
?>