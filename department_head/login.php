<?php
include_once '../api/config.php';
$obj = new API();

if (isset($_SESSION['token'])) {
    $obj->redirect('index.php');
}

if (isset($_POST['login'])) {
    $username = $obj->get_safe_value($_POST['username']);
    $password = $obj->get_safe_value($_POST['password']);
    $department = $obj->get_safe_value($_POST['department']);

    if (isset($_POST['remember']) && $_POST['remember'] != '') {
        setcookie('username', $username, time() + (86400 * 30));
        setcookie('password', $password, time() + (86400 * 30));
        setcookie('dep_id', $department, time() + (86400 * 30));
    } else {
        setcookie('username', $_POST['username'], time() - 1);
        setcookie('password', $_POST['password'], time() - 1);
        setcookie('dep_id', $_POST['department'], time() - 1);
    }
    $result = $obj->login($username, $password, $department);
    // print_r($_POST);
   
    if($result['isAdmin'] == 1 && isset($_POST['admin']) && $_POST['admin'] != ""){
        $_SESSION['isAdmin'] = true;
        // print_r($_SESSION);
    }
    
    if ($result) {
        $obj->redirect('index.php');
    } else {
        $msg = 'invalid credintial';
    }
}

// get department information

$data = $obj->getData('department', 'id,dep_name', array(''), 'dep_name','asc');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/images/nasc_logo.png" type="image/png" sizes="16x16">
    <title>NASC-EDC Department Login Page</title>
    <!-- custom css file -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

</head>

<body>
    <div class="login">
        <div class="login-form">
            <h1>login</h1>
            <?php if (isset($msg)) {
                echo "<div class='msg'> $msg </div>";
            } ?>
            <div class="form-container">
                <form method="post" autocomplete="off">
                    <div class="form-controller">
                        <label for="departmet">Department</label>
                        <select name="department" id="department" style="text-transform:uppercase">
                            <option>-- selec department --</option>
                            <?php
                            if ($data) {
                                foreach ($data as $val) { ?>

                                    <option <?php if (isset($_COOKIE['dep_id']) && $_COOKIE['dep_id'] == $val['id']) {
                                                echo 'selected';
                                            } ?> value="<?php echo $val['id']; ?>"><?php echo strtoupper($val['dep_name']) ?></option>

                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="form-controller">
                        <label for="name">Username</label>
                        <input type="email" value="<?php if (isset($_COOKIE['username'])) {
                                                        echo $_COOKIE['username'];
                                                    } ?>" name="username" id="name" required placeholder="Enter Username">
                    </div>
                    <div class="form-controller">
                        <label for="password">password</label>
                        <input type="password" value="<?php if (isset($_COOKIE['password'])) {
                                                            echo $_COOKIE['password'];
                                                        } ?>" name="password" id="password" required placeholder="Enter password">
                    </div>
                    <div class="remember-me">
                        <input checked type="checkbox" <?php if (isset($_COOKIE['username'])) {
                                                            echo 'checked';
                                                        } ?> name="remember" id="remember">
                        <label for="remember">remember me</label>
                    </div>
                    <div class="remember-me">
                        <input type="checkbox" name="admin" id="admin">
                        <label for="admin">Login as admin</label>
                    </div>
                    <div class="form-footer">
                        <input type="submit" name="login" value="login">
                        <a href="./register.php">Register here ?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>