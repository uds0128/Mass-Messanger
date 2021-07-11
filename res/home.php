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

    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

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
                            <h1 class="m-0">Home</h1>
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
                                <div class="card-header">Mail History</div>
                                <div class="card-body">
                                    <!-- <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label for="from-date">From Date</label>
                                            <input type="date" name="" id="from-date" class="form-control">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="to-date">To Date</label>
                                            <input type="date" name="" id="to-date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button class="btn btn-sm btn-primary">Show</button>
                                        </div>
                                    </div> -->
                                    <div class="row mt-4">
                                        <div class="col-md-12 table-responsive">
                                            <table id="history-tbl" class="table table-bordered table-sm">
                                                <thead>
                                                    <tr>
                                                        <th width="12%">Date</th>
                                                        <th>Subject</th>
                                                        <th width="5%">Show</th>
                                                    </tr>
                                                </thead>
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

    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>

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

    <script>
        $(document).ready(function () {
            $("#history-tbl").DataTable({
                "autoWidth": false,
                "paging": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                "info": true,
                "ajax": {
                    url: "./api/home/fetchmailhistory.php",
                    type: "POST",
                    data: function (d) {
                        //d.fromdate = $('#from-date').val();
                        //d.todate = $('#to-date').val();
                    },
                    dataSrc: function (json) {
                        var return_data = new Array();
                        for (i = 0; i < json.data.length; i++) {
                            return_data.push({
                                'date': changeDateFormate(json.data[i][1]),
                                'subject': json.data[i][2],
                                'show': formShowBtn(json.data[i][0])
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
                    { 'data': 'date' },
                    { 'data': 'subject' },
                    { 'data': 'show' }
                ]
            });
        });

        function formShowBtn(id) {
            return "<a class='btn btn-sm btn-primary' href='./viewreport.php?id="+id+"' target='_blank'>Show</a>";
        }

        function changeDateFormate(date) {
            var datearray = date.split("-");
            var newdate =  datearray[2] + "-" +datearray[1] + '-' + datearray[0];
            return newdate;
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