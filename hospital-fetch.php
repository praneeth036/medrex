<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';
$data = json_decode(file_get_contents("php://input"));

if(isset($data->hospital_id) && !empty(trim($data->hospital_id))){
    $id = mysqli_real_escape_string($db_conn, trim($data->hospital_id));

    $allUsers = mysqli_query($db_conn,"SELECT `hospital_id`, `username`, `hospital_name`, `contact` FROM `hospital-details` WHERE hospital_id=$id");
    if(mysqli_num_rows($allUsers) > 0){
        $all_users = mysqli_fetch_all($allUsers,MYSQLI_ASSOC);
        echo json_encode(["success"=>1,"users"=>$all_users]);
    }
    else{
        echo json_encode(["success1"=>0]);
    }

}
else{
    echo json_encode(["success"=>0]);
}  

