<?php
    include('../../dbconfig/config.php');

    $groupid = $conn->real_escape_string($_GET['id']);

    $stmnt = $conn->prepare("SELECT * from groupsmaster where id = ?");
    $stmnt->bind_param('d', $groupid);
    $stmnt->execute();

    $result = $stmnt -> get_result();

    if(!$result){
        $res = array(
            "status"=>0,
            "errcode"=>-1,
            "errmsg"=>"Err In Fetching",
        );
        die(json_encode($res));
    }

    $result = $result -> fetch_assoc();

    $res = array(
        "status"=>1,
        "errcode"=>null,
        "errmsg"=>null,
        "data" => array("name" => $result['name'], "description"=>$result['description'])
    );

    echo json_encode($res);
?>
