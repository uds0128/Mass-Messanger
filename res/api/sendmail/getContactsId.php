<?php

    include("../../dbconfig/config.php");

    $groupid = $_GET["groupid"];
    $getIds = "";
    if($groupid == 0){
        $getIds .= "SELECT id from contacts";
        $getIds = $conn->prepare($getIds);     
    }
    else{
        $getIds .= "SELECT contactid as id from contactgroup WHERE groupid = ?";
        $getIds = $conn->prepare($getIds); 
        $getIds->bind_param('i', $groupid);
    }

    $getIds->execute();
    $getIds = $getIds->get_result();
    $ids = array();

    if($getIds->num_rows>0){
        while($row = $getIds->fetch_assoc()){
            $ids[] = $row['id'];
        }

        $res = array(
            "status" => 1,
            "errcode" => null,
            "errmsg" => null,
            "data" => $ids
        );

        die(json_encode($res));
    }
    else{
        $res = array(
            "status" => 0,
            "errcode" => 1,
            "errmsg" => "No Records Found",
        );

        die(json_encode($res));
    }
?>