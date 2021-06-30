<?php
    include("../../dbconfig/config.php");

    $groupid = $conn->real_escape_string($_GET['groupid']);
    $getAllContactOfGroup = $conn->prepare("SELECT * FROM groupdetails, contacts WHERE groupdetails.contactid = contacts.id and groupdetails.groupid = ?");
    $getAllContactOfGroup->bind_param('i', $groupid);
    $getAllContactOfGroup->execute();
    $resultGetAllContactOfGroup = $getAllContactOfGroup->get_result();

    if(!$resultGetAllContactOfGroup){
        $res = array(
            "status" => 0,
            "errcode" => -1,
            "errmsg" => "Err In Searching Contacts"
        );

        die(json_encode($res));
    }
    
    if($resultGetAllContactOfGroup->num_rows == 0){
        $res = array(
            "status" => 0,
            "errcode" => 1,
            "errmsg" => "No Contacts Available"
        );

        die(json_encode($res));
    }

    while($row = $resultGetAllContactOfGroup->fetch_assoc()){
        $id = $row['id'];
        echo $id;
    }

?>