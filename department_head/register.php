<?php
include_once '../api/config.php';
$obj = new API();

if (isset($_SESSION['token'])) {
    $obj->redirect('index.php');
}

if (isset($_POST['register_btn'])) {
    $username = $obj->get_safe_value($_POST['username']);
    $password = $obj->get_safe_value($_POST['password']);
    $department = $obj->get_safe_value($_POST['department']);
    // $total_stu = $obj->get_safe_value($_POST['total_stu']);
    $date = date('y-m-d h:i:s');

    $result = $obj->getData('department', 'id', array('dep_name' => $department));
    if ($result) {
        $dep_id = $result[0]['id'];
    } else {
        $result = $obj->insertData('department', array('dep_name' => $department, 'created_at' => $date));
        if ($result) {
            $dep_id = $result['insert_id'];
            $isExist = true;
            $name = $username;
            $pass = $password;
            $dept = $department;
        }
    }

    $result = $obj->getData('department_head', 'id', array('department' => $dep_id));
    if ($result) {
        $msg = 'user already exist';
    } else {
        if(strtolower($department) == "bca" || strtolower($department) == "bachelor of computer applications" || strtolower($department) == "computer application"){
            $isAdmin = 1;
        }else{
            $isAdmin = 0;
        }
        $password = md5($password);
        $result = $obj->insertData('department_head', array('username' => $username, 'password' => $password, 'department' => $dep_id, 'isAdmin'=> $isAdmin, 'created_at' => $date));
        if ($result) {
            $obj->redirect('login.php');
            // $msg = "department Added click on register button"; 
  } else {
            // $obj->redirect('login.php');
        }
    }
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NASC-EDC Department Register Page</title>
    <!-- custom css file -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

</head>

<body>
    <div class="login">
        <div class="login-form">
            <h1>register</h1>
            <?php if (isset($msg)) {
                echo "<div class='msg'> $msg </div>";
            } ?>
            <div class="form-container">
                <form method="post" id="register-form">
                    <div class="form-controller">
                        <label for="departmet">Department</label>
                        <input type="text" name="department" value="<?php if (isset($dept)) {
                                                                        echo $dept;
                                                                    } ?>" id="department" required placeholder="Enter department name">
                    </div>
                   
                    <div class="form-controller">
                        <label for="name">Username</label>
                        <input type="email" name="username" value="<?php if (isset($name)) {
                                                                        echo $name;
                                                                    } ?>" id="name" required placeholder="Enter Username">
                    </div>
                    <div class="form-controller">
                        <label for="password">password</label>
                        <input type="password" name="password" value="<?php if (isset($pass)) {
                                                                            echo $pass;
                                                                        } ?>" id="password" required placeholder="Enter password">
                    </div>
                    <div class="form-footer">
                        <input type="submit" name="register_btn" value="register" id="register-btn">
                        <a href="login.php">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>