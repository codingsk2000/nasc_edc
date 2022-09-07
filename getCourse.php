<?php

require_once('./api/config.php');
// header('content-type','text/html');
$obj = new API();
// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json, true);
$dep_id = $data['dep_id'];
// $dep_id = 0;     //TESTING
$dep_id = $obj->get_safe_value($dep_id);
$total_students = 0;
$total_stu = $obj->getData('stu_details', 'id');
$total_stu = sizeof($total_stu);

// foreach ($total_stu as $student) {
//     $total_students += $student['total_stu'];
// }
$total_course = $obj->getData('courses', 'id');
$total_course = sizeof($total_course);
$max_stu_limit = ceil($total_stu / $total_course);
$result = $obj->con->query("select cours.id,cours.name,`dep`.dep_name from courses as cours,department as dep where `cours`.department = `dep`.id and `cours`.department != '$dep_id' and `cours`.max_stu < '$max_stu_limit' order by `cours`.name");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $res[] = [
            "name"=>ucwords($row['name']." -> (Offered By ".strtoupper($row['dep_name']).")"),
            "id"=>$row['id']
        ];
    }
} else {
    $res =  array('status' => 0, 'msg' => 'no data found');
}
print_r(json_encode($res));

// print_r(json_encode(['status' => 0, 'msg' => 'no data found']));
