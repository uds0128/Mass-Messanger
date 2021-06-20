<?php
    include('../../dbconfig/config.php');

    $query = "SELECT * from contacts where id={$_GET['id']}";
    $result = $conn -> query($query);

    $result = $result -> fetch_assoc();

    $res = array(
        "firstname" => $result['firstname'],
        "middlename" => $result['middlename'],
        "lastname" => $result['lastname'],
        "email" => $result['email'],
        "contactno" => $result['contactno']
    );

    echo json_encode($res);
?>
