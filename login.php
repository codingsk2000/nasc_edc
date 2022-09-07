<?php
session_start();
if(isset($_SESSION['is_login'])){
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/nasc_logo.png" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="assets/css/style.css"/>
    <title>NASC-Student-LOGIN</title>
</head>
<body>
<section class="login-form">
    <div class="form-container">
    <div class="login_logo">
    <img src="assets/images/nasc_logo.png" alt="">
    </div>
        <h3>Log In</h3>
        <form method="post" action="login_api.php">
            <div class="form-controller">
                <div class="lebel-container">
                    <label for="registerNo">Register No.</label>
                </div>
                <input type="text" class="text-uppercase" id="registerNo" name="register_no" placeholder="Enter Your Register No.">
            </div>
            <div class="form-controller">
                    <label for="dob">DOB</label>
                    <input type="date" placeholder="Date-of-Birth" required name="dob" id="dob">
            </div>
            <small class="error_msg"><?php if(isset($_SESSION['login_err'])){echo $_SESSION['login_err'];unset($_SESSION['login_err']);} ?></small>
            <div class="form-controler">
                <input type="submit" class="login-btn text-uppercase" name="login" value="Login">
            
            </div>
            
        </form>
    </div>
</section>
</body>
</html>