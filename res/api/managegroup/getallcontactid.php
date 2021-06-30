<?php
    include('../../dbconfig/config.php');

    $getAllIds = "SELECT id from contacts";
    $resultGetAllIds = $conn->query($getAllIds);

    if($resultGetAllIds->num_rows > 0){
        $ids = array();
        while($row = $resultGetAllIds->fetch_assoc()){
            $ids[] = $row['id'];
        }

        $res = array('status'=>1, 'errcode'=>null, 'errmsg'=>null, "data" => $ids);
        echo json_encode($res);
    }
    else{
        $res = array('status'=>0, 'errcode'=>1, 'errmsg'=>"No Contacts Found");
        die(json_encode($res));
    }
?>