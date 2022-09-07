<?php
define('TITLE', 'setting');
define('PAGE', 'setting');
require_once('./header.php');
require_once('../api/config.php');
$obj = new API();
if (!isset($_SESSION['token'])) {
    $obj->redirect('login.php');
}
if (isset($_POST['update'])) {
    $username = $obj->get_safe_value($_POST['username']);
    $password = $obj->get_safe_value($_POST['password']);
    // $total_stu = $obj->get_safe_value($_POST['total_stu']);
    $password = md5($password);

    $result = $obj->updateData('department_head', array('username' => $username, 'password' => $password), 'token', $_SESSION['token']);
    if ($result) {
        $msg = 'updated successfully';
    } else {
        $msg = 'try again';
    }
}

$result = $obj->getData('department_head', '*', array('token' => $_SESSION['token']));


?>
<!-- right box start -->
<section class="right-box">
    <div class="right-box-title">
        <h1>setting <i class="fas fa-chevron-right"></i></h1>
    </div>
    <?php if (isset($msg)) {
        echo "<div class='msg'> $msg </div>";
    } ?>
    <div class="profile-form">
        <h1>Update details</h1>
        <div class="setting-form">
            <form method="POST" autocomplete="off">
                <div class="form-controller">
                    <label for="name">Username</label>
                    <input type="email" value="<?php echo $result[0]['username'] ?>" name="username" id="name" required placeholder="Enter Username">
                </div>
                <!-- <div class="form-controller">
                    <label for="total_stu">total students</label>
                    <input type="text" name="total_stu" value="<?php echo $result[0]['total_stu']; ?>" id="total_stu" required placeholder=" total no. of students">
                </div> -->
                <div class="form-controller">
                    <label for="password">password</label>
                    <input type="password" name="password" id="password" required placeholder="Enter password">
                </div>
                <div class="from-btn-section">
                    <input type="submit" name="update" value="update">
                    <a href="index.php" class="close-btn">close</a>
                </div>
            </form>
        </div>
    </div>

</section>
<!-- right box end -->

<?php include './footer.php'; ?>