<?php
  session_start();

  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload Through File</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

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
                            <h1 class="m-0">Upload Through File</h1>
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
                                    <h3 class="card-title">Upload Excel</h3>
                                </div>
                                <form id="fileForm" enctype="multipart/form-data" method="post">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="file-input">File input</label>
                                                    <input type="file" class="" id="file-input" name="excel-file">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <h5>Column Numbers</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label for="first-name-txt" class="col-sm-2 col-form-label">First
                                                        Name</label>
                                                    <div class="col-sm-1">
                                                        <input type="number" class="form-control" id="first-name-txt"
                                                            name="firstNameColumnNo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label for="middle-name-txt" class="col-sm-2 col-form-label">Middle
                                                        Name</label>
                                                    <div class="col-sm-1">
                                                        <input type="number" class="form-control" id="middle-name-txt"
                                                            name="middleNameColumnNo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label for="last-name-txt" class="col-sm-2 col-form-label">Last
                                                        Name</label>
                                                    <div class="col-sm-1">
                                                        <input type="number" class="form-control" id="last-name-txt"
                                                            name="lastNameColumnNo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label for="contact-no-txt" class="col-sm-2 col-form-label">Contact
                                                        No</label>
                                                    <div class="col-sm-1">
                                                        <input type="number" class="form-control" id="contact-no-txt"
                                                            name="contactNoColumnNo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label for="email-txt" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-1">
                                                        <input type="number" class="form-control" id="email-txt"
                                                            name="emailColumnNo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label for="select-group" class="col-sm-2 col-form-label">Group</label>
                                                    <div class="col-sm-3">
                                                        <select name="groupId" id="select-group"
                                                            class="form-control"></select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div style="vertical-align: middle;">Progress</div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" id="file-upload-progress-bar"
                                                        role="progressbar" style="width: 0%" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100">0%</div>
                                                </div>
                                            </div>
                                            <div class="text-right col-md-3">
                                                <input type="button" value="Submit" id="submit-btn"
                                                    class="btn btn-primary mr-2">
                                                <input type="reset" value="Reset" class="btn btn-primary"
                                                    id="reset-btn">
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">Added Contacts</div>
                                <div class="card-body table-responsive">
                                    <table id="table-list" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>First<br>Name</th>
                                                <th>Middle<br>Name</th>
                                                <th>Last<br>Name</th>
                                                <th>Contact<br>No</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
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


    <!-- jQuery -->
    <script src="../plugins/jQuery-3.3.1/jquery-3.3.1.min.js"></script>

    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>


    <script src="../plugins/toastr/toastr.min.js"></script>

    <script src="../plugins/select2/js/select2.full.min.js"></script>

    <script>

        $(document).ready(function () {
            reloadGroupNames();

            $('#select-group').select2({
                theme: 'bootstrap4'
            });
        });

        $("#submit-btn").on('click', function (e) {
            e.preventDefault();

            var formData = new FormData(fileForm);

            var file = $("#file-input");
            var filePath = file.val();
            var allowedExtensions = /(\.xls|\.xlsx|\.csv)$/i;

            if (!allowedExtensions.exec(filePath)) {
                toastr.info("Invalid File Type!, Only .XLS OR .XLSX OR .CSV Supported");
                file.val('');
                return false;
            }
            else {
                if ($("#first-name-txt").val() != "" && $("#middle-name-txt").val() != "" && $("#last-name-txt").val() != "" && $("#email-txt").val() != "" && $("#contact-no-txt").val() != "" && $("#file-input").val() != null) {
                    $.ajax({
                        method: "post",
                        url: "./api/uploadexcel/proccessexcel.php",
                        data: formData,
                        xhr: function () {
                            var myXhr = $.ajaxSettings.xhr();
                            if (myXhr.upload) {
                                myXhr.upload.addEventListener('progress', progress, false);
                            }
                            return myXhr;
                        },
                        dataType: "json",
                        success: function(res){
                            if(res.status == 1){
                                toastr.success("Contacts Added Successfully");
                                $("#reset-btn").click();
                                $("#table-list tbody").empty();
                                for(i=0; i<res.data.length; i++){
                                    $("#table-list tbody:last-child").append("<tr><td>"+res.data[i][0]+"</td><td>"+res.data[i][1]+"</td><td>"+res.data[i][2]+"</td><td>"+res.data[i][3]+"</td><td>"+res.data[i][4]+"</td></tr>");
                                }
                            }
                            else{
                                toastr.error("Something Went Wrong");
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                }
                else {
                    toastr.info("Please Fill ALl The Details");
                }
            }
        });

        function progress(e) {
            if (e.lengthComputable) {
                var max = e.total;
                var current = e.loaded;
                var percentage = (current / max) * 100;
                $("#file-upload-progress-bar").css("width", percentage.toFixed(2) + "%").attr('aria-valuenow', percentage.toFixed(2));
                $("#file-upload-progress-bar").html(percentage.toFixed(2) + "%");
            }
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

        $("#reset-btn").on('click', function () {
            $('#select-group').val("0").trigger('change');
            $("#file-upload-progress-bar").css("width", "0%").attr('aria-valuenow', "0%");
            $("#file-upload-progress-bar").html("0%");
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