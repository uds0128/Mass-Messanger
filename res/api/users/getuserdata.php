<?php
    include('../../dbconfig/config.php');

    $query = "SELECT * from users where id={$_GET['id']}";
    $result = $conn -> query($query);

    $result = $result -> fetch_assoc();

    $res = array(
        "firstname" => $result['firstname'],
        "lastname" => $result['lastname'],
        "email" => $result['email']
    );

    echo json_encode($res);
?>
