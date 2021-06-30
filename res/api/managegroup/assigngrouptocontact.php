<?php

    include('../../dbconfig/config.php');

    $groupid = $conn->real_escape_string($_POST['groupid']);
    $idArray = $_POST['contactidslist'];
    $idArray_size = sizeof($idArray);

    $existedEntries = 0;

    $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

    for($i=0; $i<$idArray_size; $i++){
        $isExist = $conn->prepare("SELECT id FROM contactgroup WHERE groupid = ? and contactid = ?");
        $isExist->bind_param('ii', $groupid, $idArray[$i]);
        $isExist->execute();
        $isExist = $isExist->get_result();

        if($isExist->num_rows > 0){
            $existedEntries++;
        }
        else{
            $insertContact = $conn->prepare("INSERT INTO groupdetails (groupid, contactid) VALUES (?, ?)");
            $insertContact->bind_param('ii', $groupid, $idArray[$i]);
            $insertContact = $insertContact->execute();

            if(!$insertContact){
                $conn->rollback();
                $res = array('status'=>0, "errcode"=>-1, "errmsg"=>"Error While Insering Contactid".$idArray[$i]);
                die(json_encode($res));
            }
        }
    }   

    $conn->commit();

    $res = array(
        'status'=>1,
        "errcode" => null,
        "errmsg" => null,
        "data" => array(
            "total" => $idArray_size,
            "existed" => ($existedEntries)
        )
    );

    echo json_encode($res);
?>