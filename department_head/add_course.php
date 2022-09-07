<?php
define('TITLE', 'add courses');
define('PAGE', 'course');
require_once('./header.php');
require_once('../api/config.php');

$obj = new API();
if (!isset($_SESSION['token'])) {
    $obj->redirect('login.php');
}
$token = $_SESSION['token'];
$result = $obj->getData('department_head', 'department', array('token' => $token));
if ($result) {
    $department = $result[0]['department'];
}

if (isset($_POST['add_course'])) {
    $course = $_POST['course'];
    $dep_id = $_POST['department'];
    if($_POST['course_code'] != " "){
        $course_code = $_POST['course_code'];

    }else{
    $course_code = 0;
        
    }
    $date = date('y-m-d h:i:s');

    $isAbailable = $obj->getData('courses', 'id', array('name' => $course));
    if ($isAbailable) {
        $msg = 'course already exist';
    } else {
        if (isset($_POST['add_course']) && $_POST['update'] == '') {
            $result = $obj->insertData('courses', array('name' => $course,'course_code'=>$course_code, 'department' => $dep_id, 'created_at' => $date));
            if ($result) {
                $msg = "course added successfully";
            } else {
                $msg = "please try again";
            }
        } else {
            $result = $obj->updateData('courses', array('name' => $_POST['course'],'course_code'=>$_POST['course_code']), 'id', $_GET['id']);
            if ($result) {
                $msg = 'data update successfully';
            } else {
                $msg = 'data not updated';
            }
        }
    }
}

// update code
if (isset($_GET['type']) && $_GET['type'] == 'edit' && isset($_GET['id'])) {

    $update_val = $obj->getData('courses', 'name,course_code', array('id' => $_GET['id']));
}

?>

<!-- right box start -->
<section class="right-box">
    <div class="right-box-title">
        <h1>add course <i class="fas fa-chevron-right"></i></h1>
    </div>

    <?php if (isset($msg)) {
        echo "<div class='msg'> $msg </div>";
    } ?>

    <div class="profile-form">
        <h1>course details</h1>
        <div class="setting-form">
            <form method="post" autocomplete="off">
                <div class="form-controller">
                    <label for="course">Course Name</label>
                    <input type="text" name="course" value="<?php if (isset($update_val)) {
                                                                echo $update_val[0]['name'];
                                                            } ?>" id="course" required placeholder="Enter course Name">
                </div>
                <div class="form-controller">
                    <label for="course_code">Course Code</label>
                    <input type="text" name="course_code" value="<?php if (isset($update_val)) {
                                                                echo $update_val[0]['course_code'];
                                                            } ?>" id="course_code" placeholder="Enter course Code">
                </div>
                <div class="form-controller">
                    <input type="hidden" name="department" value="<?php if (isset($department)) {
                                                                        echo $department;
                                                                    } ?>">
                    <input type="hidden" name="update" value="<?php if (isset($update_val)) {
                                                                    echo 'true';
                                                                } ?>">

                </div>
                <div class="from-btn-section">
                    <input type="submit" name="add_course" value="add course">
                    <a href="./courses.php" class="close-btn">close</a>
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