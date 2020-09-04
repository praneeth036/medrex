<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

// POST DATA
$data = json_decode(file_get_contents("php://input"));

if(isset($data->patientno) 
    && isset($data->admission_date)
    && isset($data->discharge_date)
    && isset($data->doctor_id)
    && isset($data->remarks)
    && isset($data->status)
    && isset($data->support)
    && isset($data->hospital_id)

	&& !empty(trim($data->patientno)) 
    && !empty(trim($data->admission_date))
    && !empty(trim($data->$discharge_date))
    && !empty(trim($data->$doctor_id))
    && !empty(trim($data->$remarks))
    && !empty(trim($data->status))
    && !empty(trim($data->support))
    && !empty(trim($data->hospital_id))
    
    
	){
    $patientno = mysqli_real_escape_string($db_conn, trim($data->patientno));
    $admission_date = mysqli_real_escape_string($db_conn, trim($data->admission_date));
    $discharge_date= mysqli_real_escape_string($db_conn, trim($data->discharge_date));
    $doctor_id=mysqli_real_escape_string($db_conn, trim($data->doctor_id));
    $remarks=mysqli_real_escape_string($db_conn, trim($data->remarks));
    $status=mysqli_real_escape_string($db_conn, trim($data->status));
    $support=mysqli_real_escape_string($db_conn, trim($data->$support));
    $hospital_id=mysqli_real_escape_string($db_conn, trim($data->hospital_id));



        $insertUser = mysqli_query($db_conn,"INSERT INTO `patient-record`(`aadhar_no`, `admission`, `discharge`, `doctor_id`, `remarks`, `support`, `status`,`hospital_id`) VALUES ($patientno,'".$admission_date."','".$discharge_date."',$doctor_id,'$remarks','$support',$status,$hospital_id)");
        if($insertUser){
            
            echo json_encode(["success"=>1,"msg"=>"User Inserted."]);
        }
        else{
            echo json_encode(["success"=>0,"msg"=>"User Not Inserted!"]);
        }
    
}
else{
    echo json_encode(["success"=>0,"msg"=>"Please fill all the required fields!"]);
}
