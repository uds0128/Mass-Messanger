<?php
    include('../../dbconfig/config.php');

    //$fromDate = $_POST['from-date'];
    //$toDate = $_POST['to-date'];

    $total_mails = "SELECT count(0) as total_mails from mailhistory";
    $result_total_mails = $conn->query($total_mails);
    $result_total_mails = $result_total_mails -> fetch_assoc();
    
    
    $totalRecords = $result_total_mails['total_mails'];

    $query = "SELECT id, date, subject from mailhistory WHERE ";
    
    if(isset($_POST["search"]["value"])){
        $query .= " subject LIKE '%".$_POST["search"]["value"]."%' ";
    }

    if(isset($_POST["order"])){
        $query .= "ORDER BY ".($_POST["order"]["0"]["column"] + 1)." ".$_POST["order"]["0"]["dir"]."  ";
    }
    else{
        $query .= "ORDER BY date DESC, id DESC ";
    }

    if($_POST["length"] != -1){
        $query .= "LIMIT " .$_POST["start"].", ".$_POST["length"];
    }

    //echo $query;

    $result = $conn -> query($query);
    $data = array();

    while($row = $result->fetch_assoc()){
        $row_obj = array();

        $row_obj[] = $row["id"] ;
        $row_obj[] = $row["date"] ;
        $row_obj[] = $row["subject"] ;
    
        $data[] = $row_obj;
    }

    $output = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalRecords,
    "data" => $data
    );

    echo json_encode($output);

?>