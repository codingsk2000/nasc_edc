<?php

define('TITLE', 'Home');
define('PAGE', 'home');
require_once('./header.php');
require_once('./api/config.php');
$obj = new API();
if(!isset($_SESSION['is_login'])){
    $obj->redirect('login.php');
}
// if(isset($_POST['login'])){
//     if(empty($_POST['dob']) || empty($_POST['register_no'])){
//         $_SESSION['login_err'] = "All Fields are required";
//         $obj->redirect('login.php');
//     }else{
//         $regNo = $obj->get_safe_value($_POST['register_no']);
//         $dob = $_POST['dob'];
//         $res = $obj->getData('stu_details','register_no,name',array('register_no'=>$regNo,'dob'=>$dob));
//         if($res){
//             $_SESSION['is_login'] = true;
//             $_SESSION['name'] = $res[0]['name'];
//             $_SESSION['reg_no'] = $res[0]['register_no'];
//         }else{
//             $_SESSION['login_err'] = "Invalid Credential";
//             $obj->redirect('login.php');
//         }
//     }
// }

$depName = $obj->getData('department', 'id,dep_name');

if (isset($_POST['submit-btn'])) {
    $regNo = $obj->get_safe_value($_POST['regNo']);
    $name = $obj->get_safe_value($_POST['name']);
    // $email = $obj->get_safe_value($_POST['email']);
    // $mobile = $obj->get_safe_value($_POST['mobile']);
    $dep = $obj->get_safe_value($_POST['dep']);
    $year = $obj->get_safe_value($_POST['year']);
    $course = $obj->get_safe_value($_POST['course']);
    $date = date('y-m-d h:i:s');

    $findUser = $obj->getData('students', 'id', array('register_no' => $regNo));
    if ($findUser) {
        $msg = "Register number already exist";
    } else {

        $total_stu = $obj->getData('stu_details', 'id');
        $total_stu = sizeof($total_stu);
        $total_course = $obj->getData('courses', 'id');
        $total_course = sizeof($total_course);
        $max_stu_limit = ceil($total_stu / $total_course);
        $max_stu_course = $obj->getData('courses','max_stu',array('id'=>$course));
        
        if($max_stu_course[0]['max_stu']<$max_stu_limit){
            $condition_arr = array('register_no' => $regNo, 'name' => $name, 'dept' => $dep, 'course' => $course, 'year' => $year, 'created_at' => $date);
            $result = $obj->insertData('students', $condition_arr);
        }else{
            $msg = "Course limit full. Try for Another course";
        }


        if ($result) {
            // update max student in course =
            $total_stu = $obj->getData('courses', 'max_stu', array('id' => $course));

            // $total_stu = $total_stu[0]['total_stu']+1;
            $result = $obj->updateData('courses', array('max_stu' => $total_stu[0]['max_stu'] + 1), 'id', $course);
            if ($result) {
                $msg = 'Registered successfully.';
            }
        } else {
            $msg = 'Try again';
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
        <h1>Extra departmental course</h1>
        <p>You can select Your EDC Course From This Online portal Easily.</p>
        <a class="btn-main hero-btn" href="#register">Register<i class="fas fa-long-arrow-alt-right"></i></a>
    </div>

</section>

<!-- banner section end -->

<!-- register form section start -->
<section class="register-form" id="register">
    <h3>Register for <span>EDC</span></h3>
    <?php if (isset($msg)) {
        // print_r($max_stu_course);
        echo "<div class='msg'> $msg </div>";
    } ?>
    <div class="form-container">
        <h3>Select EDC Course</h3>
        <form method="POST">
        <input type="hidden" value="<?php if(isset($_SESSION['reg_no'])){echo $_SESSION['reg_no'];} ?>" class="text-uppercase" name="regNo" required>
        <input type="hidden" value="<?php if(isset($_SESSION['name'])){echo $_SESSION['name'];} ?>" name="name" required>
            
            <div class="form-controller">
                <select name="year" required style="display:none">
                    <option value="" disabled selected>--select Year--</option>
                    <!-- <option value="1">1st</option> -->
                    <option value="2" selected>2<sup>nd</sup></option>
                    <!-- <option value="3">3<sup>rd</sup></option> -->
                    <!-- <option value="4">4th</option> -->

                </select>
            </div>
            <div class="form-controller">
                <label>Select Your Department</label>
                <select id="department" name="dep" required>
                    <option value="" disabled selected>--select Department--</option>
                    <?php
                    if ($depName) {
                        foreach ($depName as $val) { ?>

                            <option value="<?php echo $val['id'] ?>"><?php echo strtoupper($val['dep_name']); ?></option>

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
        // alert("changed");
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
                        var c_name = document.createTextNode(e.name);
                        var attr = document.createAttribute('value');
                        attr.value = e.id;
                        opt.setAttributeNode(attr);
                        // opt.appendChild('('+"hello"+')');
                        opt.appendChild(c_name);
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