<?php
include('../../dbconfig/config.php');

$groupid = $conn->real_escape_string($_POST['groupid']);
//echo $groupid;

$total_contacts = "SELECT count(0) as total_contacts from contactgroup WHERE groupid = $groupid";
$result_total_contacts = $conn->query($total_contacts);
$result_total_contacts = $result_total_contacts->fetch_assoc();
$totalRecords = $result_total_contacts['total_contacts'];


$query = "SELECT * from contactgroup where groupid = $groupid  ";
if(isset($_POST["search"]["value"]) && $_POST["search"]["value"] && $_POST["search"]["value"] != ""){
    $query .= "and ( contactid LIKE '%".$_POST["search"]["value"]."%' ";
    $query .= "OR firstname LIKE '%".$_POST["search"]["value"]."%' ";
    $query .= "OR middlename LIKE '%".$_POST["search"]["value"]."%' ";
    $query .= "OR lastname LIKE '%".$_POST["search"]["value"]."%' ";
    $query .= "OR email LIKE '%".$_POST["search"]["value"]."%' ";
    $query .= "OR contactno LIKE '%".$_POST["search"]["value"]."%' ) "; 
}

if(isset($_POST["order"]) && $_POST["order"]!=""){
    $query .= "ORDER BY ".($_POST["order"]["0"]["column"] + 1)." ".$_POST["order"]["0"]["dir"]."  ";
}
else{
    $query .= "ORDER BY contactid ASC ";
}

if($_POST["length"] != -1){
    $query .= "LIMIT " .$_POST["start"].", ".$_POST["length"];
}

//echo $query;

$result = $conn->query($query);
$data = array();
while($row = $result->fetch_assoc()){
    $row_obj = array();

    $row_obj[] = $row["contactid"] ;
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