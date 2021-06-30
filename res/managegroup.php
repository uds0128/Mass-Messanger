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

    <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
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
                            <h1 class="m-0">Manage Group</h1>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card card-primary">
                        <div class="card-header">Select Group</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="select-group">Select Group, You Want To Manage</label>
                                <select class="form-control select2bs4" id='select-group' style="width: 100%;">
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-sm" id='load-group-contacts-btn'>Load Group
                                Contacts</button>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            All Contacts
                        </div>
                        <div class="card-body table-responsive">
                            <table id="all-contact-tbl" class="table table-bordered table-striped table-hover table-sm">
                                <thead align="center">
                                    <th>Id</th>
                                    <th>First<br>Name</th>
                                    <th>Middle<br>Name</th>
                                    <th>Last<br>Name</th>
                                    <th>Email</th>
                                    <th>Contact<br>No</th>
                                    <th>Select</th>
                                    <!-- <th width="5%">Actions</th> -->
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer" style="display: flex; justify-content: flex-end;">
                            <div class="icheck-primary mr-3">
                                <input type="checkbox" id="checkAll" onchange="updateCheckAll()">
                                <label for="checkAll">
                                    Check All
                                </label>
                            </div>
                            <button class="btn btn-success btn-sm" id="add-into-group-btn"><i
                                    class='fas fa-plus-circle mr-1'></i>Add</button>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header ">
                            Contacts In <span id='group-name-div'></span>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="group-contact-tbl"
                                class="table table-bordered table-striped table-hover table-sm">
                                <thead align="center">
                                    <th>Id</th>
                                    <th>First<br>Name</th>
                                    <th>Middle<br>Name</th>
                                    <th>Last<br>Name</th>
                                    <th>Email</th>
                                    <th>Contact<br>No</th>
                                    <th width="5%">Actions</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer" style="display: flex; justify-content: flex-end;">
                            <div class="icheck-primary mr-3">
                                <input type="checkbox" id="check-all-for-group" onchange="updateCheckAllForGroup()">
                                <label for="check-all-for-group">
                                    Check All
                                </label>
                            </div>
                            <button class="btn btn-danger btn-sm" id="remove-from-group-btn"><i
                                    class='fas fa-trash-alt mr-1'></i>Remove</button>
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

    <script src="../dist/js/adminlte.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>

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

    <script src="../plugins/toastr/toastr.min.js"></script>

    <script src="../plugins/select2/js/select2.full.min.js"></script>

    <script>
        var selectedIdsAllContactsTbl = new Set();
        var selectedIdsGroupContactsTbl = new Set();



        $('#select-group').select2({
            theme: 'bootstrap4'
        });

        $(document).ready(function () {

            let groupIdGlobal = null;

            reloadGroupNames();

            groupIdGlobal = $('#select-group').val();
            
            $("#group-name-div").html($('#select-group option:selected').text());

            $("#all-contact-tbl").DataTable({
                "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "order": [],
                "info": true,
                "lengthChange": false,
                "paging": true,
                "ajax": {
                    url: "./api/managegroup/fetchcontact.php",
                    type: "POST",
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
                                'select': formateAllContactsCheckbox(json.data[i][0])
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

            $("#group-contact-tbl").DataTable({
                "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "order": [],
                "info": true,
                "lengthChange": false,
                "paging": true,
                "ajax": {
                    url: "./api/managegroup/getallcontactofgroup.php",
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
                                'select': formateGroupContactsCheckbox(json.data[i][0])
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

            $("#load-group-contacts-btn").on('click', function () {
                var groupid = $("#select-group").val();
                groupIdGlobal = groupid;
                console.log(groupIdGlobal);
                var groupname = $("#select-group option:selected").text();
                $("#group-name-div").html(groupname);
                $("#group-contact-tbl").DataTable().ajax.reload();
                selectedIdsGroupContactsTbl.clear();
                updateCheckAllForGroup();
            });

            $("#add-into-group-btn").on('click', function () {
                if(selectedIdsAllContactsTbl.size > 0){
                    $.ajax({
                        method: "post",
                        url: "./api/managegroup/assigngrouptocontact.php",
                        data: {
                            groupid: $("#select-group").val(),
                            contactidslist: Array.from(selectedIdsAllContactsTbl)
                        },
                        dataType: "json",
                        success: function(res){
                            
                            if(res.status == 1){
                                toastr.success("Contacts Inserted: " + (res.data.total-res.data.existed));
                                toastr.success(" Contact Existed: " + res.data.existed);
                                selectedIdsAllContactsTbl.clear();
                                $("#all-contact-tbl").DataTable().ajax.reload();
                                $("#group-contact-tbl").DataTable().ajax.reload();
                            }
                            else{
                                toastr.error("Something Went Wrong");
                            }
                        },
                        error: function (err){
                            console.log("Err In ./api/managegroup/assigngrouptocontact.php");
                            toastr.error("Something Went Wrong");
                        }
                    })
                }
                else{
                    toastr.info("Please Select Contact To Insert");
                }
            });

            $("#remove-from-group-btn").on('click', function (){
                if(selectedIdsGroupContactsTbl.size > 0){
                    $.ajax({
                        method: "post",
                        url: "./api/managegroup/removecontactfromgroup.php",
                        data: {
                            groupid: $("#select-group").val(),
                            contactidslist: Array.from(selectedIdsGroupContactsTbl)
                        },
                        dataType: "json",
                        success: function(res){
                            
                            if(res.status == 1){
                                toastr.success((res.data.total) + " Contacts Deleted");
                                selectedIdsGroupContactsTbl.clear();
                                $("#group-contact-tbl").DataTable().ajax.reload();
                            }
                            else{
                                toastr.error("Something Went Wrong");
                            }
                        },
                        error: function (err){
                            console.log("Err In ./api/managegroup/removecontactfromgroup.php");
                            toastr.error("Something Went Wrong");
                        }
                    })
                }
                else{
                    toastr.info("Please Select Contact To Insert");
                }
            });






            function addGmail(data) {
                return (data + "@gmail.com");
            }

            function formateAllContactsCheckbox(id) {
                if (selectedIdsAllContactsTbl.has(parseInt(id))) {
                    return "<div class='checkbox-inline'><input type='checkbox' class='selectforadd' value='select-" + id + "' id='select-" + id + "' contactid='" + id + "'  onchange='updateSelectedIdsSet(" + id + ")' checked></div>";
                }
                else {
                    return "<div class='checkbox-inline'><input type='checkbox' class='selectforadd' value='select-" + id + "' id='select-" + id + "' contactid='" + id + "' onchange='updateSelectedIdsSet(" + id + ")'></div>";
                }
            }

            function formateGroupContactsCheckbox(id) {
                if (selectedIdsGroupContactsTbl.has(parseInt(id))) {
                    return "<div class='checkbox-inline'><input type='checkbox' class='selectforadd' value='select-in-group-" + id + "' id='select-in-group-" + id + "' contactid='" + id + "'  onchange='updateSelectedIdsInGroupSet(" + id + ")' checked></div>";
                }
                else {
                    return "<div class='checkbox-inline'><input type='checkbox' class='selectforadd' value='select-in-group-" + id + "' id='select-in-group-" + id + "' contactid='" + id + "' onchange='updateSelectedIdsInGroupSet(" + id + ")'></div>";
                }
            }

            function reloadGroupNames() {
                $.ajax({
                    method: 'get',
                    url: "./api/managegroup/getallgroupnames.php",
                    dataType: 'json',
                    async: false,
                    success: function (res) {
                        if (res.status == 1) {
                            for (let i = 0; i < res.data.length; i++) {
                                $("#select-group").append(new Option(res.data[i]['name'], res.data[i]['id']))
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
        });

        function updateCheckAll() {
            if ($("#checkAll").prop('checked')) {
                $.ajax({
                    method: "get",
                    url: "./api/managegroup/getallcontactid.php",
                    dataType: "json",
                    success: function (res) {
                        if (res.status == 1) {
                            res.data.forEach(data => selectedIdsAllContactsTbl.add(parseInt(data)));
                            $("#all-contact-tbl").DataTable().ajax.reload();
                        }
                        else {
                            toastr.error("Something Went Wrong");
                        }
                    },
                    error: function (err) {
                        console.log("Err In ./api/managegroup/getallcontactid.php");
                        console.log(err);
                    }
                });
            }
            else {
                selectedIdsAllContactsTbl.clear();
                $("#all-contact-tbl").DataTable().ajax.reload();
            }
        }

        function updateCheckAllForGroup() {
            if ($("#check-all-for-group").prop('checked')) {
                $.ajax({
                    method: "get",
                    url: "./api/managegroup/getallcontactidsofgroup.php?groupid="+$("#select-group").val(),
                    dataType: "json",
                    success: function (res) {
                        if (res.status == 1) {
                            res.data.forEach(data => selectedIdsGroupContactsTbl.add(parseInt(data)));
                            $("#group-contact-tbl").DataTable().ajax.reload();
                        }
                        else {
                            toastr.error("Something Went Wrong");
                        }
                    },
                    error: function (err) {
                        console.log("Err In ./api/managegroup/getallcontactid.php");
                        console.log(err);
                    }
                });
            }
            else {
                selectedIdsGroupContactsTbl.clear();
                $("#group-contact-tbl").DataTable().ajax.reload();
            }
        }

        function updateSelectedIdsSet(id) {
            if ($("#select-" + id).prop('checked')) {
                selectedIdsAllContactsTbl.add(id);
            }
            else {
                selectedIdsAllContactsTbl.delete(id);
                $("#checkAll").prop('checked', false);
            }
        }

        function updateSelectedIdsInGroupSet(id) {
            if ($("#select-in-group-" + id).prop('checked')) {
                selectedIdsGroupContactsTbl.add(id);
            }
            else {
                selectedIdsGroupContactsTbl.delete(id);
                $("#check-all-for-group").prop('checked', false);
            }
        }

        function printSetAll(){
            console.log(selectedIdsAllContactsTbl);
            console.log(Array.from(selectedIdsAllContactsTbl));
        }

        function printSetAllG(){
            console.log(selectedIdsGroupContactsTbl);
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