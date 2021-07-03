<?php

    $code = $_POST['code'];


    $contactno = " !--SampleContactNo--! ";
    $fname = " !--SampleFirstName--! ";
    $mname = " !--SampleMiddleName--! ";
    $lname = " !--SampleLastName--! ";
    $email = " !--SampleEmail--! ";

    $code = str_replace('<fname></fname>',$fname, $code);
    $code = str_replace('<mname></mname>',$mname, $code);
    $code = str_replace('<lname></lname>',$lname, $code);
    $code = str_replace('<email></email>',$email, $code);
    $code = str_replace('<contactno></contactno>',$contactno, $code);

    echo "subject : ". $_POST['subject'] . "<br><br><br>" ;
    echo $code;

?>