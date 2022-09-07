<?php

require_once('./api/config.php');
$obj = new API();
if(isset($_POST['login'])){
    if(empty($_POST['dob']) || empty($_POST['register_no'])){
        $_SESSION['login_err'] = "All Fields are required";
        $obj->redirect('login.php');
    }else{
        $regNo = $obj->get_safe_value($_POST['register_no']);
        $dob = $_POST['dob'];
        $res = $obj->getData('stu_details','register_no,name',array('register_no'=>$regNo,'dob'=>$dob));
        if($res){
            $_SESSION['is_login'] = true;
            $_SESSION['name'] = $res[0]['name'];
            $_SESSION['reg_no'] = $res[0]['register_no'];
            $obj->redirect('index.php');
        }else{
            $_SESSION['login_err'] = "Invalid Credential";
            $obj->redirect('login.php');
        }
    }
}

?>