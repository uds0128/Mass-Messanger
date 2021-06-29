<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "massmessanger";
    $isConnected = false;

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
    
    // Check connection
    if ($conn->connect_error) {
      $isConnected = false;
    }
    else{
      $isConnected = true;
    }

    
    
?>