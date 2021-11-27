<?php
require_once('./header.php');
?>

<!-- loader section -->
<div class="loader">
    <img src="./assets/images/loading.gif" alt="loading..">
</div>

<!-- form section start -->
<section class="login-form active">
    <div class="form-container">
        <h3>Log In</h3>
        <form>
            <div class="form-controller">
                <div class="lebel-container">
                    <label for="registerNo">Register No.</label>
                    <small class="error_msg"></small>
                </div>
                <input type="text" class="text-uppercase" id="registerNo" placeholder="Enter Your Register No.">
            </div>
            <!-- <div class="form-controller">
                    <label for="password">PIN</label>
                    <input type="password" required id="password" placeholder="Enter Your Pin" value="">
                </div> -->

            <input type="button" class="login-btn text-uppercase" id="login-btn" value="Get In">
            <p>Not registered?<a href="./index"> register here</a></p>
        </form>
    </div>
</section>
<!-- form section end -->

<!-- user details section start -->
<section class="user-details">
    <div class="form-container">
        <h3>Profile</h3>
        <form>
            <div class="form-controller">
                <label>Register No.</label>
                <input readonly type="text" class="text-uppercase" id="read_reg_no" value="">
            </div>
            <div class="form-controller">
                <label>Name</label>
                <input readonly type="text" id="name" value="">
            </div>
            <div class="form-controller">
                <label>email</label>
                <input readonly type="text" id="email" value="">
            </div>
            <div class="form-controller">
                <label>mobile</label>
                <input readonly type="text" id="mobile" value="">
            </div>
            <div class="form-controller">
                <label>Department</label>
                <input readonly type="text" class="text-uppercase" id="department" value="">
            </div>
            <div class="form-controller">
                <label>Course</label>
                <input readonly type="text" class="text-uppercase" id="course" value="">
            </div>
            <a href="./index" class="btn-logout text-uppercase">Log out</a>
        </form>
    </div>
</section>
<!-- user details section end -->

<script>
    // code for user login
    document.querySelector('#login-btn').onclick = () => {
        const regNo = document.querySelector('#registerNo').value;
        if (regNo == '') {
            document.querySelector('.error_msg').innerHTML = "please fill this field";
            return;
        }
        document.querySelector('.error_msg').innerHTML = "";

        // loader class
        document.querySelector('.loader').classList.add('active');

        //http request
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "login_api.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json");
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Response
                var response = this.responseText;
                response = JSON.parse(response);
                if (response.status == 0) {
                    document.querySelector('.error_msg').innerHTML = "invalid register no";

                } else {
                    e = response;
                    setData('#read_reg_no', e.register_no);
                    setData('#name', e.name);
                    setData('#email', e.email);
                    setData('#mobile', e.mobile);
                    setData('#department', e.dept);
                    setData('#course', e.course);

                    document.querySelector('.user-details').classList.add('active');
                    document.querySelector('.login-form').classList.remove('active');

                }


            }
            // loader class
            document.querySelector('.loader').classList.remove('active')

        };
        var data = {
            'reg_no': regNo
        };
        xhttp.send(JSON.stringify(data));
    };

    function setData(field, val) {
        document.querySelector(field).value = val;
    }
</script>
<?php
require_once('./footer.php');
?>