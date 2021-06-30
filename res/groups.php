<?php
  session_start();

  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Groups</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <!-- <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> -->
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
                            <h1 class="m-0">Groups</h1>
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
                                    Groups
                                </div>
                                <div class="card-body form-horizontal">
                                    <input type="hidden" name="" id="group-id">
                                    <div class="row">
                                        <div class="form-group row col-12">
                                            <label for="group-name-txt" class="col-sm-4 col-form-label">Group
                                                Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="" id="group-name-txt"
                                                    onchange="validateGroupNameMaster()">
                                                <small><label for="group-name-txt" id="group-name-err-msg"
                                                        class="text-danger"></label></small>
                                            </div>
                                        </div>
                                        <div class="form-group row col-12">
                                            <label for="group-desc-txt" class="col-sm-4 col-form-label">Group
                                                Description</label>
                                            <div class="col-sm-8">
                                                <textarea name="" id="group-desc-txt" class="form-control" cols="30"
                                                    rows="5" onchange="validateGroupDescMaster()"></textarea>
                                                <small><label for="group-desc-txt" id="group-desc-err-msg"
                                                        class="text-danger"></label></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer" align="right">
                                    <input type="button" value="Create Group" id='create-group-btn'
                                        class="btn btn-primary mr-1">
                                    <input type="button" value="Update" id='update-group-btn'
                                        class="btn btn-primary mr-1" hidden>
                                    <input type="button" value="Reset" id="reset-btn" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Contacts</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table id="all-groups-table"
                                    class="table table-bordered table-striped table-hover table-sm">
                                    <thead align="center">
                                        <tr>
                                            <th width="8%">Group ID</th>
                                            <th>Group Name</th>
                                            <th>Group Description</th>
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

    <script src="../plugins/Sweet-Alert-2/sweetalert2.js"></script>
    <script>
        $(document).ready(function () {
            $("#all-groups-table").DataTable({
                "autoWidth": false,
                "paging": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                "info": true,
                "ajax": {
                    url: "./api/groups/fetchgroups.php",
                    type: "POST"
                },
                "columnDefs": [
                    {
                        "targets": [-1],
                        "orderable": false,
                    }
                ]
            });

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })



        });

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        function validateGroupNameMaster() {
            var groupName = $("#group-name-txt").val();
            groupName = groupName.trim().replace(/\s+/g, " ").replace(/\w\S*/g, function (txt) { return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); });
            $("#group-name-txt").val(groupName);

            var errMsg = validateName(groupName, 50);

            if (errMsg) {
                $("#group-name-txt").removeClass('border-success');
                $("#group-name-txt").addClass('border-danger');
            }
            else {
                $("#group-name-txt").removeClass('border-danger');
                $("#group-name-txt").addClass('border-success');
            }

            $("#group-name-err-msg").html(errMsg);
            if (errMsg) {
                return false;
            }
            return true;
        }

        function validateGroupDescMaster() {
            var groupDesc = $("#group-desc-txt").val();
            groupDesc = groupDesc.trim().replace(/\s+/g, " ").replace(/\w\S*/g, function (txt) { return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); });
            $("#group-desc-txt").val(groupDesc);

            var errMsg = "";

            if (groupDesc.length > 255) {
                errMsg = "Max " + 255 + " Characters";
            }

            if (errMsg) {
                $("#group-desc-txt").removeClass('border-success');
                $("#group-desc-txt").addClass('border-danger');
            }
            else {
                $("#group-desc-txt").removeClass('border-danger');
                $("#group-desc-txt").addClass('border-success');
            }

            $("#group-desc-err-msg").html(errMsg);
            if (errMsg) {
                return false;
            }
            return true;
        }

        function validateName(name, size) {
            var errMsg = "";
            if (name.length == 0) {
                errMsg = "Field Is Required";
                return errMsg;
            }

            if (name.length > size) {
                errMsg = "Max " + size + " Characters";
                return errMsg;
            }
            return errMsg;
        }

        $("#create-group-btn").on('click', function () {

            if (validateGroupDescMaster() && validateGroupNameMaster()) {
                $.ajax({
                    type: "POST",
                    url: "./api/groups/createnewgroup.php",
                    data: { groupname: $("#group-name-txt").val(), groupdesc: $("#group-desc-txt").val() },
                    dataType: "json",
                    success: function (res) {
                        if (res['status'] == 1) {
                            toastr.success("Group Created Successfully");
                            $("#all-groups-table").DataTable().ajax.reload();
                        }
                        else {
                            if (res['errcode'] == 1) {
                                toastr.warning("Group Already Exists");
                            }
                            else {
                                toastr.error("Something Went Wrong");
                            }
                        }
                    },
                    error: function (err) {
                        toastr.error("Something Went Wrong");
                        console.log("Err In ./api/groups/createnewgroup.php API");
                    }
                });
            }

        });

        $("#reset-btn").on('click', resetForm);

        function resetForm() {
            $("#group-name-txt").val("");
            $("#group-desc-txt").val("");
            $("#group-name-txt").removeClass('border-danger');
            $("#group-name-txt").removeClass('border-success');
            $("#group-desc-txt").removeClass('border-danger');
            $("#group-desc-txt").removeClass('border-success');
            $("#group-name-err-msg").html("");
            $("#group-desc-err-msg").html("");
            $("#group-id").val("");
            $("#create-group-btn").prop('hidden', false);
            $("#update-group-btn").prop('hidden', true);
        }

        $("tbody").on('click', '.update-group', function () {
            resetForm();
            var id = $(this).attr('group-id');
            $("#create-group-btn").prop('hidden', true);
            $("#update-group-btn").prop('hidden', false);


            $.ajax({
                url: "./api/groups/getgroupdata.php?id=" + id,
                method: "get",
                dataType: "json",
                success: function (res) {
                    if (res.status == 1) {
                        $("#group-id").val(id);
                        $("#group-name-txt").val(res.data.name);
                        $("#group-desc-txt").val(res.data.description);
                    }
                    else {
                        toastr.error("Something Went Wrong");
                    }

                },
                error: function (err) {
                    console.log("Err In ./api/contacts/getgroupdata.php ", err);
                    toastr.error("Something Went Wrong");
                }
            });
        });

        $("#update-group-btn").on('click', function (e) {
            //e.preventDefault();

            var id = $("#group-id").val();

            if (id == null) {
                toastr.error("Something Went Worng, Please refresh the page");
            }

            if (validateGroupDescMaster() && validateGroupNameMaster()) {

                groupname = $("#group-name-txt").val();
                groupdesc = $("#group-desc-txt").val();

                $.ajax({
                    method: "post",
                    url: "./api/groups/updategroup.php",
                    data: {
                        id: id,
                        groupname: groupname,
                        groupdesc: groupdesc
                    },
                    dataType: "json",
                    success: function (res) {
                        console.log(res);
                        if (res.status == 1) {
                            $("#all-groups-table").DataTable().ajax.reload();
                            toastr.success("Group Details Updated Successfully");
                            resetForm();
                        }
                        else {
                            if (res.errcode == 1) {
                                swalWithBootstrapButtons.fire({
                                    title: 'Group Name Already Exists',
                                    text: "Do you want to update Description?",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes',
                                    cancelButtonText: 'No',
                                    reverseButtons: true,
                                    allowOutsideClick: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        updateDescription(id, groupname, groupdesc);
                                    }
                                    else {
                                        toastr.warning("Updation Cancelled");
                                    }
                                });
                            }
                            else {
                                toastr.error("Something Went Worng");
                            }
                        }
                    },
                    error: function (err) {
                        toastr.error("Something Went Worng");
                        console.error("Err In ./api/groups/updategroup.php", err);
                    }
                });
            }
            else {
                toastr.error("Something Went Worng, Please refresh the page");
            }
        });

        function updateDescription(id, groupname, groudesc) {
            $.ajax({
                type: "post",
                url: "./api/groups/updatedescriptiononly.php",
                data: {
                    id: id,
                    groupname: groupname,
                    groupdesc: groupdesc
                },
                dataType: "json",
                success: function (res) {
                    if (res.status == 1) {
                        $("#all-groups-table").DataTable().ajax.reload();
                        toastr.success("Description Updated Successfully");
                        resetForm();
                    }
                    else {
                        toastr.error("Something Went Worng");
                    }
                },
                error: function (err) {
                    console.log('Err in ./api/groups/updatedescriptiononly.php');
                    toastr.error("Something Went Worng");
                }
            });
        }

        $("tbody").on("click", '.delete-group', function () {
            var id = $(this).attr("group-id");

            $.ajax({
                url: "./api/groups/deletegroup.php",
                type: "POST",
                data: { id: id },
                dataType: "json",
                success: function (res) {
                    if (res.status == 1) {
                        $("#all-groups-table").DataTable().ajax.reload();
                        toastr.success("Group deleted successfully");
                    }
                    else {
                        toastr.error("Something Went Worng");
                    }
                },
                error: function (err) {
                    console.log("Err in ./api/contacts/deletecontact.php");
                    toastr.error("Something Went Worng");
                }

            })
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