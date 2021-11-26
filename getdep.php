<?php
require_once('./api/config.php');
// header('content-type','text/html');
$obj = new API();
// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json,true);
$dep_id = $data['dep_id'];
$dep_id = $obj->get_safe_value($dep_id);

$result = $obj->con->query("select id,name from courses where department != '$dep_id'");
if($result->num_rows >0){
    while($row = $result->fetch_assoc()){
        $res[] = $row;
    }
}else{
    $res =  array('status'=> 0,'msg'=>'no data found');
}
print_r(json_encode($res));

?>