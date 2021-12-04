<?php
require_once('./api/config.php');
// header('content-type','text/html');
$obj = new API();
// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json, true);
$reg_no = $data['reg_no'];
$reg_no = $obj->get_safe_value($reg_no);

$result = $obj->getData('students','*',array('register_no'=>$reg_no));
if($result){
    $dep = $obj->getData('department','dep_name',array('id'=>$result[0]['dept']));
    $course = $obj->getData('courses','name',array('id'=>$result[0]['course']));
    print_r(json_encode(array('register_no'=>$result[0]['register_no'], 'name' => $result[0]['name'], 'email' => $result[0]['email'], 'mobile' => $result[0]['mobile'], 'dept' => $dep[0]['dep_name'],'course'=>$course[0]['name'])));
}else{
    print_r(json_encode(array('status'=>0)));
}
