<?php

    include('../../dbconfig/config.php');
    include('../../mailconfig/mailingfunction.php');

    $ids = $_POST['ids'];
    $mail_body = $_POST['code'];
    $subject = $_POST['subject'];
    $code = $mail_body;
    $subjectCopy = $subject;
    $no_of_ids = sizeof($ids);

    $successfulIds = array();
    $errorIds = array();



    for($i=0; $i<$no_of_ids; $i++){

        $getContactDetails = $conn->prepare("SELECT * FROM contacts WHERE id = ?");
        $getContactDetails->bind_param('i', $ids[$i]);
        $getContactDetails->execute();
        $getContactDetails = $getContactDetails->get_result();

        $fname="";$mname="";$lname="";$email="";$contactno="";
        if($getContactDetails->num_rows > 0){
            $row = $getContactDetails->fetch_assoc();
            $fname = $row['firstname'];
            $mname = $row['middlename'];
            $lname = $row['lastname'];
            $email = $row['email'];
            $contactno = $row['contactno'];

            $mail_body = $code;
            $mail_body = str_replace('<fname></fname>',$fname, $mail_body);
            $mail_body = str_replace('<mname></mname>',$mname, $mail_body);
            $mail_body = str_replace('<lname></lname>',$lname, $mail_body);
            $mail_body = str_replace('<email></email>',$email, $mail_body);
            $mail_body = str_replace('<contactno></contactno>',$contactno, $mail_body);
            
            $subject = $subjectCopy;
            $subject = str_replace('<fname></fname>',$fname, $subject);
            $subject = str_replace('<mname></mname>',$mname, $subject);
            $subject = str_replace('<lname></lname>',$lname, $subject);
            $subject = str_replace('<email></email>',$email, $subject);
            $subject = str_replace('<contactno></contactno>',$contactno, $subject);

            if(mailfunction($fname, $mname, $lname, $email, $contactno, $subject, $mail_body)){
                $successfulIds[] = $ids[$i];
            }
            else{
                $errorIds[] = $ids[$i];
            }
        }
        else{
            $errorIds[] = $ids[$i];
        }
    }

    $subject = $subjectCopy;
    $subject = str_replace('<fname></fname>',"!-FirstName-!", $subject);
    $subject = str_replace('<mname></mname>',"!-MiddleName-!", $subject);
    $subject = str_replace('<lname></lname>',"!-LastName-!", $subject);
    $subject = str_replace('<email></email>',"!-Email-!", $subject);
    $subject = str_replace('<contactno></contactno>',"!-ContactNo-!", $subject);

    $mail_body = $code;
    $mail_body = str_replace('<fname></fname>',"!-FirstName-!", $mail_body);
    $mail_body = str_replace('<mname></mname>',"!-MiddleName-!", $mail_body);
    $mail_body = str_replace('<lname></lname>',"!-LastName-!", $mail_body);
    $mail_body = str_replace('<email></email>',"!-Email-!", $mail_body);
    $mail_body = str_replace('<contactno></contactno>',"!-ContactNo-!", $mail_body);
    
    $contactIds = implode(",", $successfulIds);

    $insertIntoHistory = "INSERT INTO mailhistory (subject, body, contactids) VALUES ('{$subject}','{$mail_body}', '{$contactIds}')";
    $result_insertIntoHistory = $conn->query($insertIntoHistory);

    $res = array(
        "status"=>1,
        "errcode"=>null,
        "errmsg"=>null,
        "data" => array(
            "successids" => $successfulIds,
            "errorids" => $errorIds
        )
    );

    if(!$result_insertIntoHistory){
        $res["historyStatus"] = 1;
    }
    else{
        $res["historyStatus"] = 0;
    }

    echo json_encode($res);
?>