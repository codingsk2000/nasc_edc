<?php
require_once('./header.php');
?>
    <!-- form section start -->
    <section class="login-form active">
        <div class="form-container">
            <h3>Log In</h3>
            <form>
                <div class="form-controller">
                    <label for="registerNo">Register No.</label>
                    <input type="text" required id="registerNo" placeholder="Enter Your Register No." value="">
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
                    <input type="text" id="registerNo" value="">
                </div>
                <div class="form-controller">
                    <label>Name</label>
                    <input type="text" id="name" value="">
                </div>
                <div class="form-controller">
                    <label>email</label>
                    <input type="text" id="email" value="">
                </div>
                <div class="form-controller">
                    <label>mobile</label>
                    <input type="text" id="mobile" value="">
                </div>
                <div class="form-controller">
                    <label>Department</label>
                    <input type="text" id="department" value="">
                </div>
                <div class="form-controller">
                    <label>Course</label>
                    <input type="text" id="course" value="">
                </div>
                <a href="./index" class="btn-logout text-uppercase">Log out</a>
            </form>
        </div>
    </section>
    <!-- user details section end -->
<?php
require_once('./footer.php');
?>