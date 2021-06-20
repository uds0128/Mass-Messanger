<?php
    include('../../dbconfig/config.php');
    $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
    $query = "DELETE from contacts WHERE id = {$_POST['id']}";
    $result = $conn -> query($query);

    
    if($result){
        $conn->commit();
        echo json_encode(['status' => 1]);
    }
    else{
        $conn->rollback();
        echo json_encode(['status' => 0]);
    }
?>