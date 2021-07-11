<?php
  session_start();

  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

    include('./dbconfig/config.php');

    $getData = "SELECT * from mailhistory WHERE id = {$_GET['id']} ";
    $getData = $conn->query($getData);

    if($getData->num_rows == 0){
        die("404 Not Found");
    }
    $getData = $getData->fetch_assoc();
    $date = $getData["date"];
    $date = explode("-", $date);
    $date = $date[2]."-".$date[1]."-".$date[0];

    $subject = $getData['subject'];
    $body = $getData['body'];
    $contactIds = $getData['contactids'];
    $contactIds = explode(",", $contactIds);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>


    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">


</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <?php include('preloader.php'); ?>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header"><h3>View Report</h3></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="date-txt" class="col-sm-2 col-form-label">Date</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="date-txt" value="<?php echo $date; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="subject-txt" class="col-sm-2 col-form-label">Subject</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="<?php echo $subject; ?>" id="subject-txt" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="body-txt" class="col-sm-2 col-form-label">Body</label>
                                            <div class="col-sm-10">
                                                <textarea type="text" class="form-control" id="body-txt" rows="10" disabled><?php echo $body;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3>Recepient's List</h3>
                                <div class="row mt-4">
                                    <div class="col-md-8 table-responsive">
                                        <table id="history-tbl" class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no_of_contacts = count($contactIds);
                                                for($i=0;$i<$no_of_contacts; $i++){
                                                    $query = "select firstname, lastname, email from contacts where id = $contactIds[$i]";
                                                    $result = $conn->query($query);
                                                    $row = $result->fetch_assoc();
                                                    echo "<tr><td>".$row['firstname']."</td><td>".$row['lastname']."</td><td>".$row['email']."</td></tr>";                
                                                }
                                                ?>
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

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="../plugins/jQuery-3.3.1/jquery-3.3.1.min.js"></script>

    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>


</body>

</html>

<?php
  }
  else{
    header("Location: ../index.php");
  }
?>