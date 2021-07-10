<?php
require_once '../../../vendor/autoload.php';
require_once '../../dbconfig/config.php';
  
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if ($_FILES["excel-file"]["error"] == 0 && $_FILES["excel-file"]['size'] > 0) {

    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
     
    if(isset($_FILES["excel-file"]['name']) && in_array($_FILES["excel-file"]['type'], $file_mimes)) {
     
        $arr_file = explode('.', $_FILES["excel-file"]['name']);
        $extension = end($arr_file);
     
        if('csv' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
 
        $spreadsheet = $reader->load($_FILES["excel-file"]['tmp_name']);
 
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
    
        $data = array();

        $firstNameColumnNo = $_POST["firstNameColumnNo"];
        $middleNameColumnNo = $_POST["middleNameColumnNo"];
        $lastNameColumnNo = $_POST["lastNameColumnNo"];
        $contactNoColumnNo = $_POST["contactNoColumnNo"];
        $emailColumnNo = $_POST["emailColumnNo"];
        $groupId = $_POST["groupId"];
        $data = [];        
        if (!empty($sheetData)) {
            $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
            for ($i=0; $i<count($sheetData); $i++) {
                $firstName = $sheetData[$i][$firstNameColumnNo];
                $middleName = $sheetData[$i][$middleNameColumnNo];
                $lastName = $sheetData[$i][$lastNameColumnNo];
                $contactNo = $sheetData[$i][$contactNoColumnNo];
                $email = $sheetData[$i][$emailColumnNo];
                $obj = [];
                $obj[] = $firstName;
                $obj[] = $middleName;
                $obj[] = $lastName;
                $obj[] = $contactNo;
                $obj[] = $email;

                $data[] = $obj;
                
                $insertContact = "INSERT INTO contacts (firstname, middlename, lastname, contactno, email) VALUE ('{$firstName}', '{$middleName}', '{$lastName}', '{$contactNo}', '$email')";
                $result_insertContact = $conn->query($insertContact);

                if(!$result_insertContact){
                    $conn->rollback();
                    $res = array("status"=>0, "errcode"=>-4, "errmsg"=>"Error While Inserting COntact");
                    die(json_encode($res));
                }
                $lastContactId = $conn->insert_id;

                if($groupId != 0){
                    $insertIntoGroup = "INSERT INTO groupdetails (contactid, groupid) VALUES ({$lastContactId}, {$groupId})";
                    $result_insertIntoGroup = $conn->query($insertIntoGroup);
                    
                    if(!$result_insertIntoGroup){
                        $conn->rollback();
                        $res = array("status"=>0, "errcode"=>-3, "errmsg"=>"Error While Inserting Into Group");
                        die(json_encode($res));
                    }
                }
                 
            }

            $conn->commit();
            $res = array("status"=>1, "errcode"=>null, "errmsg"=>null, "data"=>$data);
            die(json_encode($res));
        }
    }
    else{
        $res = array("status"=>0, "errcode"=>-2, "errmsg"=>"Error File Name Or Type");
        die(json_encode($res));
    }
}
else{
    $res = array("status"=>0, "errcode"=>-1, "errmsg"=>"Error In File Uploading");
    die(json_encode($res));
}
?>