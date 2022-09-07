<?php

/*=====================================================
# Write your own databse cnnection
# Replace stu_details with your own table name and change fields name like register_no,name with your own 

=======================================================*/
//Database Connection
$host = 'localhost';
$user = 'root';
$pass = 'Risk1891911@';
$db_name = 'nasc_edc';



    $con = new mysqli($host, $user, $pass, $db_name);
    if ($con->connect_error) {
        die('connection failed');
    }

        $regNo = $_POST['register_no'];
        $dob = date('Y-m-d',strtotime($_POST['dob']));
        $sql = "SELECT register_no,name FROM stu_details WHERE register_no ='$regNo' AND dob='$dob'";
        $res = $con->query($sql);
        
        if($res->num_rows>0){
            $result = $res->fetch_assoc();
            
            $name = $result['name'];
            $reg_no = $result['register_no'];
            echo "login success";   //Testing
        }else{
            $_SESSION['login_err'] = "Invalid Credential";
        }
        


?>