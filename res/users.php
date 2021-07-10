<?php
  session_start();

  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
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
                            <h1 class="m-0">Users</h1>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            <div class="card card-primary">
                                <div class="card-header"></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="firstNameTxt">First Name</label>
                                                <input type="text" class="form-control temp-disable"
                                                    placeholder="First Name" id="firstNameTxt">
                                                <small id="first-name-err-msg" class='text-danger'></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="lastNameTxt">Last Name</label>
                                                <input type="text" class="form-control temp-disable"
                                                    placeholder="Last Name" id="lastNameTxt">
                                                <small id="last-name-err-msg" class='text-danger'></small>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="emailTxt">Email</label>
                                                <input type="text" class="form-control temp-disable" placeholder="Email"
                                                    id="emailTxt" user-id="">
                                                <small id="email-err-msg" class='text-danger'></small>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="passwordTxt">Password</label>
                                                <input type="text" class="form-control temp-disable"
                                                    placeholder="Password" id="passwordTxt">
                                                <small id="password-err-msg" class='text-danger'></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer" align="right">
                                    <input type="button" class="btn btn-primary mr-2" id="create-user-btn"
                                        value="Create">
                                    <input type="button" class="btn btn-primary mr-2" id="update-user-btn"
                                        value="Update" hidden>
                                    <input type="button" class="btn btn-primary" id="reset-btn" value="Reset">
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
                            <table id="users-table" class="table table-bordered table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>First<br>Name</th>
                                        <th>Last<br>Name</th>
                                        <th>Email</th>
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

    <!-- Bootstrap -->
    <!-- <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->

    </script> -->
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>


    <script>
        $(document).ready(function () {
            $("#users-table").DataTable({
                "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "order": [],
                "info": true,
                "lengthChange": false,
                "paging": true,
                "ajax": {
                    url: "./api/users/fetchusers.php",
                    type: "POST",
                    dataSrc: function (json) {
                        var return_data = new Array();
                        for (i = 0; i < json.data.length; i++) {
                            return_data.push({
                                'id': json.data[i][0],
                                'fname': json.data[i][1],
                                'lname': json.data[i][2],
                                'email': json.data[i][3],
                                'action': setActionsBtn(json.data[i][0])
                            });
                        }
                        return return_data;
                    }
                },
                "columnDefs": [
                    {
                        "targets": [-1],
                        "orderable": false,
                    }],
                "columns": [
                    { 'data': 'id' },
                    { 'data': 'fname' },
                    { 'data': 'lname' },
                    { 'data': 'email' },
                    { 'data': 'action' }
                ]
            });
        });

        $("#create-user-btn").on('click', function () {
            if (validateFirstName() && validateLastName() && validateEmail() && validatePassword()) {
                $.ajax({
                    method: "POST",
                    url: "./api/users/registeruser.php",
                    data: {
                        firstname: $("#firstNameTxt").val(),
                        lastname: $("#lastNameTxt").val(),
                        email: $('#emailTxt').val(),
                        _password: $("#passwordTxt").val()
                    },
                    dataType: "json",
                    success: function (res) {
                        if (res.status == 1) {
                            $("#users-table").DataTable().ajax.reload();
                            toastr.success("User Added Successfully");
                            resetForm();
                        }
                        else {
                            if (res.errcode == 1) {
                                toastr.info("User Or Email Already Exists");
                            }
                            else {
                                toastr.error("Something Went Wrong");
                            }
                        }
                    },
                    error: function (err) {
                        console.log("Err In ./api/users/registeruser.php");
                        toastr.error("Something Went Wrong");
                    }
                });
            }
        });

        $("#update-user-btn").on('click', function () {
            if (validateFirstName() && validateLastName() && validateEmail()) {
                $.ajax({
                    method: "POST",
                    url: "./api/users/updateuser.php",
                    data: {
                        firstname: $("#firstNameTxt").val(),
                        lastname: $("#lastNameTxt").val(),
                        email: $('#emailTxt').val(),
                        id: $('#emailTxt').attr('user-id')
                    },
                    dataType: "json",
                    success: function (res) {
                        if (res.status == 1) {
                            toastr.success("User Updated Successfully");
                            $("#create-user-btn").prop('hidden', false);
                            $("#update-user-btn").prop('hidden', true);
                            resetForm();
                            $("#users-table").DataTable().ajax.reload();
                        }
                        else {
                            toastr.error("Something Went Wrong");
                        }
                    },
                    error: function (err) {
                        console.log("Err In ./api/users/registeruser.php");
                        toastr.error("Something Went Wrong");
                    }
                });
            }
        });

        $("#reset-btn").on('click', resetForm);

        function validateFirstName() {
            let firstName = $("#firstNameTxt").val();
            firstName = firstName.replace(/\s+/g, " ").replace(/\w\S*/g, function (txt) { return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); });
            $("#firstNameTxt").val(firstName);

            if (firstName.length == 0) {
                $("#first-name-err-msg").html('First Name is required ...');
                return false;
            }

            if (firstName.length > 30) {
                $("#first-name-err-msg").html('Max Character 30 ...');
                return false;
            }
            $("#first-name-err-msg").html('');
            return true;
        }

        function validateLastName() {
            let lastName = $("#lastNameTxt").val();
            lastName = lastName.replace(/\s+/g, " ").replace(/\w\S*/g, function (txt) { return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); });
            $("#lastNameTxt").val(lastName);

            if (lastName.length == 0) {
                $("#last-name-err-msg").html('First Name is required ...');
                return false;
            }

            if (lastName.length > 30) {
                $("#last-name-err-msg").html('Max Character 30 ...');
                return false;
            }
            $("#last-name-err-msg").html('');
            return true;
        }

        function validateEmail() {
            let isValid = false;
            let email = $('#emailTxt').val();
            email = email.replace(/\s+/g, "").trim().toLowerCase();
            email = email.trim();
            $('#emailTxt').val(email);

            let mailformat = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            if (email.length == 0) {
                $("#email-err-msg").html('Email is required ...');
            }
            else if (email.length > 320) {
                $("#email-err-msg").html('Maximum Email 320 Character ...');
            }
            else {
                if (email.match(mailformat)) {
                    isValid = true;
                    $("#email-err-msg").html('');
                }
                else {
                    $("#email-err-msg").html('Invalid Email ...');
                }
            }

            if (isValid) {
                return true;
            }
            else {
                return false;
            }
        }

        function validatePassword() {
            let password = $("#passwordTxt").val();

            if (password.length == 0) {
                $("#password-err-msg").html('Password is Required ...');
                return false;
            }

            if (password.length < 8) {
                $("#password-err-msg").html('Password Must Contain at least 8 character');
                return false;
            }

            password = password.replace(/\s+/g, " ");
            if (password.includes(' ')) {
                $("#password-err-msg").html('Password Must Not Contain White Spaces ...');
                return false;
            }

            if (password.length > 20) {
                $("#password-err-msg").html('Password Must Contain at Most 20 character');
                return false;
            }

            let validPasswordFormate = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$/;
            if (!password.match(validPasswordFormate)) {
                $("#password-err-msg").html('Password Should Contain One Uppercase, One Digit And One Special Character ...');
                return false;
            }
            $("#password-err-msg").html('');
            return true;
        }

        function setActionsBtn(id) {
            return "<div style='display: flex;'><input type='button' class='btn btn-success btn-sm mr-2' value='update' onclick='getUserData(" + id + ")' ><input type='button' class='btn btn-danger btn-sm' value='delete' onclick='deleteUser(" + id + ")'><div>";
        }

        function getUserData(id) {
            $("#create-user-btn").prop('hidden', true);
            $("#update-user-btn").prop('hidden', false);
            $.ajax({
                method: "get",
                url: "./api/users/getuserdata.php?id=" + id,
                dataType: "json",
                success: function (res) {
                    $("#firstNameTxt").val(res.firstname);
                    $("#lastNameTxt").val(res.lastname);
                    $("#emailTxt").val(res.email);
                    $("#emailTxt").attr('user-id', id);
                },
                error: function (err) {
                    console.log("Err In ./api/users/getuserdata.php");
                }
            });
        }

        function resetForm() {
            $("#create-user-btn").prop('hidden', false);
            $("#update-user-btn").prop('hidden', true);
            $("#first-name-err-msg").html("");
            $("#last-name-err-msg").html("");
            $("#email-err-msg").html("");
            $("#emailTxt").attr("user-id", "");
            $("#firstNameTxt").val("");
            $("#lastNameTxt").val("");
            $("#emailTxt").val("");
            $("#passwordTxt").val("");
        }

        function deleteUser(id) {
            $.ajax({
                url: "./api/users/deleteuser.php",
                type: "POST",
                data: { id: id },
                dataType: "json",
                success: function (res) {
                    if (res.status == 1) {
                        $("#users-table").DataTable().ajax.reload();
                        toastr.success("Contact deleted successfully");
                    }
                    else {
                        toastr.error("Something Went Worng, Please try again");
                    }
                },
                error: function (err) {
                    console.log("Err in ./api/users/deleteuser.php");
                    toastr.error("Something Went Worng, Please refresh the page");
                }

            })
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