<?php
include '../api/config.php';
$obj = new API();
$condition_arr = array('username'=>'shanu@gmail.com','password'=>'bca1');
$obj->login('bba@gmail.com','bba','2');
// $obj->updateData('department_head',$condition_arr,'id',1);

?>