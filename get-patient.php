<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';
$data = json_decode(file_get_contents("php://input"));

if(isset($data->hospital_id) && !empty(trim($data->hospital_id)) && isset($data->patient_id) && !empty(trim($data->patient_id))){
$hospital_id = mysqli_real_escape_string($db_conn, trim($data->hospital_id));
$patient_id = mysqli_real_escape_string($db_conn, trim($data->patient_id));
    
    $allUsers = mysqli_query($db_conn,"SELECT `aadhar_no`, `admission`, `discharge`, `doctor_id`, `remarks`, `support`, `status`, `hospital_id` FROM `patient-record` WHERE aadhar_no=$patient_id");
    
    
    
    if(mysqli_num_rows($allUsers) > 0){
        $records=[];
        while($row = mysqli_fetch_assoc($allUsers)) {
            if($row["hospital_id"]!=$hospital_id){
                $row["support"]='Not accessible!';
            }
            array_push($records,$row);


            
         }
        echo json_encode(["success"=>1,"users"=>$records]);
    }
    else{
        echo json_encode(["success1"=>0]);
    }

}
else{
    echo json_encode(["success"=>0]);
}  


