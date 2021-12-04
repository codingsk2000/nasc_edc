<?php
define('TITLE', 'Home');
define('PAGE', 'home');
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

    $findUser = $obj->getData('students', 'id', array('register_no' => $regNo));
    if ($findUser) {
        $msg = "register no. already exist";
    } else {

        $condition_arr = array('register_no' => $regNo, 'name' => $name, 'email' => $email, 'mobile' => $mobile, 'dept' => $dep, 'course' => $course, 'year' => $year, 'created_at' => $date);
        $result = $obj->insertData('students', $condition_arr);

        if ($result) {
            // update max student in course =
            $total_stu = $obj->getData('courses', 'max_stu', array('id' => $course));

            // $total_stu = $total_stu[0]['total_stu']+1;
            $result = $obj->updateData('courses', array('max_stu' => $total_stu[0]['max_stu'] + 1), 'id', $course);
            if ($result) {
                $msg = 'registered successfully you can see your course details in dashboard section';
            }
        } else {
            $msg = 'try again';
        }
    }
}
?>


<!-- loader section -->
<div class="loader">
    <img src="./assets/images/loading.gif" alt="loading..">
</div>

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
                <input type="text" class="text-uppercase" name="regNo" required id="registerNo" placeholder="Enter Your Register No." value="">
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
                    <!-- <option value="1">1st</option> -->
                    <option value="2" selected>2<sup>nd</sup></option>
                    <!-- <option value="3">3<sup>rd</sup></option> -->
                    <!-- <option value="4">4th</option> -->

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
<script>
    // department select code
    const dep = document.querySelector('#department');
    let course = document.querySelector('#course');
    dep.addEventListener('change', () => {
        const dep_id = dep.value;
        course.innerHTML = '';
        // loader class
        document.querySelector('.loader').classList.add('active');

        //http request
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "getCourse.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json");
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Response
                var response = this.responseText;
                response = JSON.parse(response);
                if (response.status == 0) {
                    var opt = document.createElement('option');
                    var text = document.createTextNode(response.msg);
                    var attr = document.createAttribute('disabled');
                    attr = document.createAttribute('selected');
                    attr = document.createAttribute('value');
                    opt.setAttributeNode(attr);
                    opt.appendChild(text);
                    course.appendChild(opt);
                } else {
                    response.forEach((e) => {
                        var opt = document.createElement('option');
                        var text = document.createTextNode(e.name);
                        var attr = document.createAttribute('value');
                        attr.value = e.id;
                        opt.setAttributeNode(attr);
                        opt.appendChild(text);
                        course.appendChild(opt);
                    });
                }

            }
            setTimeout(() => {
                // loader class
                document.querySelector('.loader').classList.remove('active')
            }, 900);
        };
        var data = {
            dep_id: dep_id
        };
        xhttp.send(JSON.stringify(data));
    });


    document.querySelector('#submit-btn').onclick = () => {
        document.querySelector('.dialog').classList.add('active');
        document.querySelector('#final-submit-btn').classList.add('active');
        document.querySelector('#submit-btn').classList.add('disabled');
    };
    document.querySelector('#close').onclick = () => {
        document.querySelector('.dialog').classList.remove('active');

    };
</script>

<?php include 'footer.php'; ?>