<?php
    include('../../dbconfig/config.php');

    $groupid = $conn->real_escape_string($_GET['groupid']);

    $getAllIds = $conn->prepare("SELECT contactid from contactgroup WHERE groupid = ?");
    $getAllIds->bind_param('i', $groupid);
    $getAllIds->execute();
    $resultGetAllIds = $getAllIds->get_result();

    if($resultGetAllIds->num_rows > 0){
        $ids = array();
        while($row = $resultGetAllIds->fetch_assoc()){
            $ids[] = $row['contactid'];
        }

        $res = array('status'=>1, 'errcode'=>null, 'errmsg'=>null, "data" => $ids);
        echo json_encode($res);
    }
    else{
        $res = array('status'=>0, 'errcode'=>1, 'errmsg'=>"No Contacts Found");
        die(json_encode($res));
    }
?>