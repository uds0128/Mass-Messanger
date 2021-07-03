<?php
    include('../../dbconfig/config.php');

    $getGroupDetails = "SELECT id, name FROM groupsmaster";
    $resultGetGroupDetails = $conn->query($getGroupDetails);

    if($resultGetGroupDetails->num_rows > 0){
        $data = array();
        while($row = $resultGetGroupDetails->fetch_assoc()){
            $groupid = $row['id'];
            $groupname = $row['name'];

            $group = array('id'=>$groupid, 'name'=>$groupname);
            $data[] = $group;
        }

        $res = array(
            "status" => 1,
            "errcode" => null,
            "errmsg" => null,
            "data" => $data
        );

        echo json_encode($res);
    }
    else{
        $res = array(
            "status" => 0,
            "errcode" => 1,
            "errmsg" => "Groups Not Exists Or Error Found",
        );

        die(json_encode($res));
    }
?>