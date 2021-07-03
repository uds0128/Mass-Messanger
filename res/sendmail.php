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

    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">

    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">

    <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <style>
        th {
            color: white;
        }

        .modal-busy {
            position: fixed;
            z-index: 999;
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            background-color: Black;
            filter: alpha(opacity=60);
            opacity: 0.6;
            -moz-opacity: 0.8;
        }

        .center-busy {
            z-index: 1000;
            margin: 300px auto;
            padding: 0px;
            width: 130px;
            filter: alpha(opacity=100);
            opacity: 1;
            -moz-opacity: 1;
        }

        .center-busy img {
            height: 128px;
            width: 128px;
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
                            <h1 class="m-0">Mailing</h1>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Loader -->
            <div class="modal-busy" id="loader" style="display: none">
                <div class="center-busy" id="test-git">
                    <img alt="" src="../dist/loaders/Iphone-spinner-2.gif" />
                    <h3>Don't Refreash The Page</h3>
                </div>
            </div>


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    To
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="select-group">Select Group</label>
                                                <select class="form-control select2bs4" id='select-group'
                                                    style="width: 100%;">
                                                    <option value="-1">Select</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-primary mt-4">
                                        <div class="card-header">Contacts From : <div id="group-name"></div>
                                        </div>
                                        <div class="card-body table-responsive">
                                            <table id="contact-tbl"
                                                class="table table-bordered table-striped table-hover table-sm">
                                                <thead align="center">
                                                    <th>Id</th>
                                                    <th>First<br>Name</th>
                                                    <th>Middle<br>Name</th>
                                                    <th>Last<br>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact<br>No</th>
                                                    <th></th>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-footer" style="display: flex; justify-content: flex-end;">
                                            <div class="icheck-primary mr-3">
                                                <input type="checkbox" id="check-all" onchange="updateIsCheckAll()">
                                                <label for="check-all">
                                                    Check All
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Compose New Message</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Subject:" id='mail-subject-txt'>
                                    </div>
                                    <div class="form-group">
                                        <textarea id="compose-textarea" class="form-control" style="height: 300px">
                                        </textarea>
                                    </div>
                                    <!-- <div class="form-group">
                                        <div class="btn btn-default btn-file">
                                            <i class="fas fa-paperclip"></i> Attachment
                                            <input type="file" name="attachment">
                                        </div>
                                        <p class="help-block">Max. 32MB</p>
                                    </div> -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="float-right">
                                        <button type="button" class="btn btn-default mr-3" id='preview-btn'><i
                                                class="fas fa-window-close"></i>
                                            Preview</button>
                                        <button type="button" class="btn btn-default mr-3" id='reset-editor'><i
                                                class="fas fa-window-close"></i>
                                            Reset</button>
                                        <button type="button" id="send-btn" class="btn btn-primary"><i
                                                class="far fa-envelope"></i>
                                            Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="./previewmail.php" method="POST" target="_blank" hidden id="preview-form">
                    <input type="text" name="subject" id="preview-subject">
                    <input type="text" name="code" id="preview-code">
                </form>>

                </form>
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

    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Summernote -->
    <script src="../plugins/summernote/summernote-bs4.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard2.js"></script>

    <script src="../plugins/toastr/toastr.min.js"></script>

    <script src="../plugins/select2/js/select2.full.min.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script>

        var contacttbl = null;
        var selectedIdsSet = new Set();

        $(document).ready(function () {

            $('#select-group').select2({
                theme: 'bootstrap4'
            });

            loadGroupNames();

            contacttbl = $("#contact-tbl").DataTable({
                "deferLoading": false,
                "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "order": [],
                "info": true,
                "lengthChange": false,
                "paging": true,
                "ajax": {
                    type: "POST",
                    data: function (d) {
                        d.groupid = $('#select-group').val();
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
                                'select': makeCheckbox(json.data[i][0])
                            });
                        }
                        return return_data;
                    }
                },
                "columnDefs": [
                    {
                        "targets": [-1, -2],
                        "orderable": false,
                    }],
                "columns": [
                    { 'data': 'id' },
                    { 'data': 'fname' },
                    { 'data': 'mname' },
                    { 'data': 'lname' },
                    { 'data': 'email' },
                    { 'data': 'contactno' },
                    { 'data': 'select' },
                    // { 'data': 'action' }
                ]
            });

            $('#compose-textarea').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['codeview'],
                    ['fullscreen']
                ],
                codeviewFilter: false,
                codeviewIframeFilter: true
            });

        });

        $("#send-btn").on('click', function () {


            if (selectedIdsSet.size != 0) {
                $("#loader").show();

                $.ajax({
                    method: "post",
                    url: "./api/sendmail/sendmails.php",
                    data: {
                        code: $('#compose-textarea').val(),
                        ids: Array.from(selectedIdsSet),
                        subject: $("#mail-subject-txt").val()
                    },
                    dataType: "json",
                    success: function (res) {
                        console.log(res);
                        $("#loader").hide();
                        if(res.data.successids.length > 0){
                            toastr.success("Successfully Sended To Ids : " + res.data.successids);
                        }
                        if(res.data.errorids.length > 0){
                            toastr.error("Error In Sending This Ids: " + res.data.errorids);
                        }
                    },
                    error: function (err) {
                        console.log("Err In ./api/sendmail/sendmails.php");
                        $("#loader").hide();
                        toastr.error("Something Went Wrong");
                    }
                });
            }
            else {
                toastr.info("Please Select Recipents");
            }
        });

        $("#select-group").on('change', function () {
            var groupid = $("#select-group").val();
            selectedIdsSet.clear();
            $("#check-all").prop("checked", false);
            if (groupid != -1) {
                if (groupid == 0) {
                    contacttbl.ajax.url("./api/sendmail/fetchcontact.php");
                }
                else {
                    contacttbl.ajax.url("./api/sendmail/getallcontactofgroup.php");
                }
                $("#contact-tbl").DataTable().ajax.reload();
            }
            else {
                contacttbl.ajax.url("./api/sendmail/getallcontactofgroup.php");
                contacttbl.clear().draw()
                toastr.info("Please Select Group To Load Contacts");
            }
        });

        function loadGroupNames() {
            $.ajax({
                method: 'get',
                url: "./api/sendmail/getallgroupnames.php",
                dataType: "json",
                success: function (res) {
                    if (res.status == 1) {
                        $("#select-group").append(new Option("All", 0));
                        for (let i = 0; i < res.data.length; i++) {
                            $("#select-group").append(new Option(res.data[i]['name'], res.data[i]['id']));
                        }
                    }
                    else {
                        toastr.error("Something Went Wrong");
                    }
                },
                error: function (err) {
                    console.log("Err In ./api/sendmail/getallgroupnames.php");
                    toastr.error("Something Went Wrong");
                }
            });
        }

        function makeCheckbox(id) {
            if (selectedIdsSet.has(parseInt(id))) {
                return "<div class='checkbox-inline'><input type='checkbox' class='selectforadd' id='select-" + id + "' onchange='updateIsChecked(" + id + ")' checked></div>";
            }
            else {
                return "<div class='checkbox-inline'><input type='checkbox' class='selectforadd' id='select-" + id + "' onchange='updateIsChecked(" + id + ")'></div>";
            }
        }

        function updateIsChecked(id) {
            if ($("#select-" + id).prop("checked")) {
                selectedIdsSet.add(id);
            }
            else {
                selectedIdsSet.delete(id);
                $("#check-all").prop('checked', false);
            }
        }

        function printSet() {
            console.log(selectedIdsSet);
        }

        function updateIsCheckAll() {
            if ($("#check-all").prop("checked")) {
                if ($("#select-group").val() != -1) {
                    $.ajax({
                        method: "get",
                        url: "./api/sendmail/getContactsId.php?groupid=" + $("#select-group").val(),
                        dataType: "json",
                        success: function (res) {
                            if (res.status == 1) {
                                res.data.forEach(data => selectedIdsSet.add(parseInt(data)));
                                $("#contact-tbl").DataTable().ajax.reload();
                            }
                            else {
                                if (res.errcode == 1) {
                                    toastr.info("No Records Found For Selected Group");
                                }
                                else {
                                    toastr.error("Something Went Wrong");
                                }
                            }
                        },
                        error: function (err) {
                            console.log("Err in ./api/sendmail/getContactsId.php");
                            toastr.error("Something Went Wrong");
                        }
                    });
                }
                else {
                    toastr.info("Please Select Group");
                    $("#check-all").prop('checked', false);
                }
            }
            else {
                selectedIdsSet.clear();
                if ($("#select-group").val() != -1) {
                    $("#contact-tbl").DataTable().ajax.reload();
                }
            }
        }

        $("#reset-editor").on('click', function () {
            $('#compose-textarea').summernote('reset');
        });

        $("#preview-btn").on('click', function () {
            $("#preview-code").val($('#compose-textarea').val());
            $("#preview-subject").val($('#mail-subject-txt').val());
            $("#preview-form").submit();
        })

    </script>

</body>

</html>

<?php
  }
  else{
    header("Location: ../index.php");
  }
?>