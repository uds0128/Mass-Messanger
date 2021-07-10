<?php
    include('../../dbconfig/config.php');

    $total_users = "SELECT count(0) as total_users from users WHERE is_admin = 0";
    $result_total_users = $conn->query($total_users);
    $result_total_users = $result_total_users -> fetch_assoc();
    
    

    $totalRecords = $result_total_users['total_users'];

    
    $query = "SELECT * FROM users WHERE is_admin=0 and ";
    if(isset($_POST["search"]["value"])){
        $query .= " ( id LIKE '%".$_POST["search"]["value"]."%' ";
        $query .= "OR firstname LIKE '%".$_POST["search"]["value"]."%' ";
        $query .= "OR lastname LIKE '%".$_POST["search"]["value"]."%' ";
        $query .= "OR email LIKE '%".$_POST["search"]["value"]."%')  ";        
    }

    if(isset($_POST["order"])){
        $query .= "ORDER BY ".($_POST["order"]["0"]["column"] + 1)." ".$_POST["order"]["0"]["dir"]."  ";
    }
    else{
        $query .= "ORDER BY id ASC ";
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
        $row_obj[] = $row["firstname"] ;
        $row_obj[] = $row["lastname"] ;
        $row_obj[] = $row["email"] ;
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