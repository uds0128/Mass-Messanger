<?php
    include('../../dbconfig/config.php');

    $groupid = $_POST['groupid'];

    if($groupid == 0){
        $total_contact = "SELECT count(0) as total_contacts from contacts ";
        $query = "SELECT * FROM contacts ";
        if(isset($_POST["search"]["value"])){
            $query .= " WHERE ";
            $query .= " (id LIKE '%".$_POST["search"]["value"]."%' ";
        }
    }
    else{
        $total_contact = "SELECT count(0) as total_contacts from contactgroup WHERE groupid={$groupid} ";
        $query = "SELECT contactid as id, firstname, middlename, lastname, email, contactno FROM contactgroup WHERE groupid = {$groupid} and ";
        if(isset($_POST["search"]["value"])){
            $query .= " (contactid LIKE '%".$_POST["search"]["value"]."%' ";
        }
    }
    $result_total_contact = $conn->query($total_contact);
    $result_total_contact = $result_total_contact -> fetch_assoc();
    
    

    $totalRecords = $result_total_contact['total_contacts'];

    
    
    if(isset($_POST["search"]["value"])){
        $query .= "OR firstname LIKE '%".$_POST["search"]["value"]."%' ";
        $query .= "OR middlename LIKE '%".$_POST["search"]["value"]."%' ";
        $query .= "OR lastname LIKE '%".$_POST["search"]["value"]."%' ";
        $query .= "OR email LIKE '%".$_POST["search"]["value"]."%' ";
        $query .= "OR contactno LIKE '%".$_POST["search"]["value"]."%') ";
        
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
        $row_obj[] = $row["middlename"] ;
        $row_obj[] = $row["lastname"] ;
        $row_obj[] = $row["email"] ;
        $row_obj[] = $row["contactno"] ;
    
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