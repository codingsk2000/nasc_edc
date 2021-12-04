<?php
require_once('./api/config.php');
// header('content-type','text/html');
$obj = new API();
// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json, true);
$dep_id = $data['dep_id'];
$dep_id = $obj->get_safe_value($dep_id);

$total_stu = $obj->getData('department_head', 'total_stu');
foreach ($total_stu as $student) {
    $total_student += $student['total_stu'];
}
$total_course = $obj->getData('courses', 'id');
$total_course = sizeof($total_course);
$max_stu_limit = ceil($total_student / $total_course);
$result = $obj->con->query("select id,name from courses where department != '$dep_id' and max_stu < '$max_stu_limit'");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $res[] = $row;
    }
} else {
    $res =  array('status' => 0, 'msg' => 'no data found');
}
print_r(json_encode($res));
