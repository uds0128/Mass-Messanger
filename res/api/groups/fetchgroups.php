<?php
    include('../../dbconfig/config.php');

    $total_groups = "SELECT count(0) as total_contacts from groupsmaster";
    $result_total_groups = $conn->query($total_groups);
    $result_total_groups = $result_total_groups -> fetch_assoc();
    
    

    $totalRecords = $result_total_groups['total_contacts'];

    
    $query = "SELECT * FROM groupsmaster ";
    if(isset($_POST["search"]["value"])){
        $query .= "WHERE id LIKE '%".$_POST["search"]["value"]."%' ";
        $query .= "OR name LIKE '%".$_POST["search"]["value"]."%' ";
        $query .= "OR description LIKE '%".$_POST["search"]["value"]."%' "; 
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
        $row_obj[] = $row["name"] ;
        $row_obj[] = $row["description"] ;
        $row_obj[] = "<div style='display: flex;' >" .
                    "<button class='btn btn-sm btn-success mr-1 update-group' group-id='".$row["id"]."'>Update</button>" .
                    "<button class='btn btn-sm btn-danger delete-group' group-id='".$row["id"]."'>Delete</button></div>";

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