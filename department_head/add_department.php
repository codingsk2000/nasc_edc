<?php
define('TITLE', 'add department');
define('PAGE', 'department');
require_once('./header.php');
require_once('../api/config.php');

$obj = new API();
if (!isset($_SESSION['token'])) {
    $obj->redirect('login.php');
}


// update code
if (isset($_POST['add_department']) && $_POST['update'] != '') {
    $department = $obj->get_safe_value($_POST['department']);
    $id = $obj->get_safe_value($_GET['id']);
    $date = date('y-m-d h:i:s');

    $isAvailable = $obj->getData('department', 'id', array('dep_name' => $department));

    if ($isAvailable) {
        $msg = 'department already exist';
    } else {
        $result = $obj->updateData('department', array('dep_name' => $department), 'id', $id);
        if ($result) {
            $msg = 'data update successfully';
        } else {
            $msg = 'data not updated';
        }
    }
}

// get data for update code
if (isset($_GET['type']) && $_GET['type'] == 'edit' && isset($_GET['id'])) {

    $update_val = $obj->getData('department', 'dep_name', array('id' => $_GET['id']));
}

?>

<!-- right box start -->
<section class="right-box">
    <div class="right-box-title">
        <h1>add Departments <i class="fas fa-chevron-right"></i></h1>
    </div>
    <?php if (isset($msg)) {
        echo "<div class='msg'> $msg </div>";
    } ?>

    <div class="profile-form">
        <h1>department details</h1>
        <div class="setting-form">
            <form method="post" autocomplete="off">
                <div class="form-controller">
                    <label for="course">department Name</label>
                    <input type="text" name="department" value="<?php if (isset($update_val)) {
                                                                    echo $update_val[0]['dep_name'];
                                                                } ?>" id="course" required placeholder="Enter department Name">
                </div>
                <input type="hidden" name="update" value="<?php if (isset($update_val)) {
                                                                echo 'true';
                                                            } ?>">
                <div class="from-btn-section">
                    <input type="submit" name="add_department" value="add department">
                    <a href="department.php" class="close-btn">close</a>
                </div>
            </form>
        </div>
    </div>

</section>
<!-- right box end -->

<!-- footer section start -->
<footer class="footer">
    <p>copyright &copy; <span class="footer-date"></span>| All rights reserved</p>
</footer>

<!-- footer section end -->
<!-- custom js file -->
<script src="./assets/js/custom.js"></script>

</body>

</html>