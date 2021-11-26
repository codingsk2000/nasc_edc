<?php
require_once('./header.php');
require_once('./api/config.php');
$obj = new API();
$depName = $obj->getData('department', 'id,dep_name');

if (isset($_POST['submit-btn'])) {
    $regNo = $obj->get_safe_value($_POST['regNo']);
    $name = $obj->get_safe_value($_POST['name']);
    $email = $obj->get_safe_value($_POST['email']);
    $mobile = $obj->get_safe_value($_POST['mobile']);
    $dep = $obj->get_safe_value($_POST['dep']);
    $year = $obj->get_safe_value($_POST['year']);
    $course = $obj->get_safe_value($_POST['course']);
    $date = date('y-m-d h:i:s');
    $condition_arr = array('register_no' => $regNo, 'name' => $name, 'email' => $email, 'mobile' => $mobile, 'dept' => $dep, 'course' => $course, 'year' => $year, 'created_at' => $date);
    $result = $obj->insertData('students', $condition_arr);
    
    if ($result) {
        $msg = 'registered successfully you can see your course details in dashboard section';
    } else {
        $msg = 'try again';
    }
}
?>

<!-- banner section start -->
<section class="banner">
    <div class="content">
        <h3>First come First Serve</h3>
        <h1>Nehru arts and science college</h1>
        <p>You can select Your EDC Course From This Online portal Easily.</p>
        <a class="btn-main hero-btn" href="#register">Register<i class="fas fa-long-arrow-alt-right"></i></a>
    </div>

</section>

<!-- banner section end -->

<!-- register form section start -->
<section class="register-form" id="register">
    <h3>Register for <span>EDC</span></h3>
    <?php if (isset($msg)) {
        echo "<div class='msg'> $msg </div>";
    } ?>
    
    <div class="form-container">
        <h3>Fill your details</h3>
        <form method="POST">
            <div class="form-controller">
                <label for="registerNo">Register No.</label>
                <input type="text" name="regNo" required id="registerNo" placeholder="Enter Your Register No." value="">
            </div>
            <div class="form-controller">
                <label for="name">Name</label>
                <input type="text" name="name" required id="name" placeholder="Enter Your Name" value="">
            </div>
            <div class="form-controller">
                <label for="email">email</label>
                <input type="email" name="email" required id="email" placeholder="Enter Your Email" value="">
            </div>
            <div class="form-controller">
                <label for="mobile">mobile</label>
                <input type="text" name="mobile" required id="mobile" placeholder="Enter Your contact No." value="">
            </div>
            <div class="form-controller">
                <label>Year</label>
                <select id="year" name="year" required>
                    <option value="" disabled selected>--select Year--</option>
                    <option value="1">1st</option>
                    <option value="2">2nd</option>
                    <option value="3">3rd</option>
                    <option value="4">4th</option>

                </select>
            </div>
            <div class="form-controller">
                <label>Department</label>
                <select id="department" name="dep" required>
                    <option value="" disabled selected>--select Department--</option>
                    <?php
                    if ($depName) {
                        foreach ($depName as $val) { ?>

                            <option value="<?php echo $val['id'] ?>"><?php echo $val['dep_name']; ?></option>

                    <?php  }
                    } else {
                        echo '<option>No data available</option>';
                    } ?>

                </select>
            </div>

            <div class="form-controller">
                <label>Course</label>
                <select required name="course" id="course">
                    <option value="" disabled selected>--Select course--</option>
                </select>
            </div>
            <input type="button" class="next-btn text-uppercase" id="submit-btn" value="Next">
            <input type="submit" class="text-uppercase" id="final-submit-btn" name="submit-btn" value="Submit">
        </form>
    </div>
</section>
<!-- register form section end -->

<!-- confirm dialog section start -->
<section class="dialog">
    <div class="dialog-content">
        <i class="fas fa-exclamation-circle fa-4x"></i>
        <h3>Confirm Your course</h3>
        <p>once you subbmit you can't change your course !</p>
        <a href="javascript:void(0)" class="text-uppercase" id="close">Close</a>
    </div>
</section>
<!-- confirm dialog section end -->

<?php include 'footer.php'; ?>