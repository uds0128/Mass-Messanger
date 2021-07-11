<?php
  session_start();

  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Config</title>

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
                                <div class="card-header">Email Config</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="server-txt" class="col-sm-3 col-form-label">SMTP
                                                    Server</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="server-txt">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="port-txt" class="col-sm-3 col-form-label">Port</label>
                                                <div class="col-sm-6">
                                                    <input type="number" class="form-control" id="port-txt">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="sender-email-txt" class="col-sm-3 col-form-label">Sender's
                                                    Email</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="sender-email-txt">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="sender-password-txt"
                                                    class="col-sm-3 col-form-label">Sender's Password</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="sender-password-txt">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="sender-name-txt" class="col-sm-3 col-form-label">Sender's
                                                    Name</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="sender-name-txt">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" id="save-btn">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">Send A Test Mail</div>
                                <div class="card-body">
                                    <div class="row">Send A Mail To Check Email Config</div>
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="testing-email-txt" class="col-sm-3 col-form-label">Testing Email</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="testing-email-txt">
                                                </div>
                                                <div class="col-sm-2">
                                                    <button class="btn btn-primary" id="send-test-mail-btn">Send</button>
                                                </div>
                                            </div>
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


    <script src="../plugins/toastr/toastr.min.js"></script>


    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>

    <script>

        $(document).ready(function () {
            getEmailConfigData();
        });

        function getEmailConfigData() {
            $.ajax({
                method: "get",
                url: "./api/emailconfig/getemailconfig.php",
                dataType: "json",
                success: function (res) {
                    if (res.status == 1) {
                        $("#server-txt").val(res.data.host);
                        $("#port-txt").val(res.data.port);
                        $("#sender-email-txt").val(res.data.sendersemail);
                        $("#sender-password-txt").val(res.data.senderspassword);
                        $("#sender-name-txt").val(res.data.sendersname);
                    }
                    else {
                        toastr.error("Something Went Wrong");
                    }
                }
            })
        }

        $("#save-btn").on('click', function () {
            if ($("#server-txt").val() == ""){
                toastr.info("Server Field Is Empty, Please Fill The Field");
                return;
            }
            
            if($("#port-txt").val() == "" ){
                toastr.info("Port Field Is Empty, Please Fill The Field");
                return;
            }
            
            if($("#sender-email-txt").val() == ""){
                toastr.info("Sender's Email Field Is Empty, Please Fill The Field");
                return;
            } 
            
            if($("#sender-password-txt").val() == ""){
                toastr.info("Sender's Password Field Is Empty, Please Fill The Field");
                return;
            } 
            
            if($("#sender-name-txt").val() == "") {
                toastr.info("Sender's Name Field Is Empty, Please Fill The Field");
                return;
            }

            $.ajax({
                type: "post",
                url: "./api/emailconfig/updateemailconfig.php",
                data: {
                    server: $("#server-txt").val(),
                    port: $("#port-txt").val(),
                    sendersemail: $("#sender-email-txt").val(),
                    senderspassword: $("#sender-password-txt").val(),
                    sendersname: $("#sender-name-txt").val()
                },
                dataType: "json",
                success: function(res){
                    if(res.status == 1){
                        toastr.success("Email Config Updated Successfully");
                        getEmailConfigData();
                    }
                    else{
                        toastr.error("Something Went Wrong");
                    }
                },
                error: function(err){
                    console.log("Err in ./api/emailconfig/updateemailconfig.php");
                    toastr.error("Something Went Wrong");
                }
            });
        });

        $("#send-test-mail-btn").on('click', function(){
            toastr.info("Please Wait for reply DOnt Refreash the page", "",10000);
            if($("#testing-email-txt").val() != ""){
                $.ajax({
                    type: "post",
                    url: "./api/emailconfig/sendtestmail.php",
                    dataType: "json",
                    data: {
                        testmail: $("#testing-email-txt").val()
                    },
                    success: function(res){
                        if(res.status == 1){
                            toastr.success("Successfully Send A Test Mail To Given Email Address");
                        }
                        else{
                            toastr.error("Something Went Wrong");
                        }
                    },
                    error: function(err){
                        console.log("Err In ./api/emailconfig/sendtestmail.php");
                        toastr.error("Something Went Wrong");
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