<?php

    include("./dbconfig/config.php");

    for($i=0; $i<100; $i++){
        $query = "INSERT INTO contacts (firstname, middlename, lastname, email, contactno) values ('".bin2hex(random_bytes(3))."', '".bin2hex(random_bytes(3))."', '".bin2hex(random_bytes(3))."', '".bin2hex(random_bytes(3))."', '".random_bytes(3)."' )";
        $conn->query($query);
    }
?>
