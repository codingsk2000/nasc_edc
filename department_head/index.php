<?php
define('TITLE', 'Home');
include_once './header.php';
require_once('../api/config.php');

$obj = new API();
if (!isset($_SESSION['token'])) {
    $obj->redirect('login');
}

?>
<!-- right box start -->
<section class="right-box">
    <div class="right-box-title">
        <h1>Dashboard <i class="fas fa-chevron-right"></i></h1>
    </div>
    <!-- datatable start -->
    <div class="data-table">
        <table id="table" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>EDC Courses</th>
                    <th>total students registered</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Row 1 Data 1</td>
                    <td>Row 1 Data 2</td>
                    <td>Row 1 Data 2</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Row 1 Data 1</td>
                    <td>Row 1 Data 2</td>
                    <td>Row 1 Data 2</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Row 2 Data 2</td>
                    <td>Row 1 Data 1</td>
                    <td>Row 1 Data 2</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- datatable end -->


    <a href="./department" class="card-link">
        <div class="card">
            <div class="icon">
                <i class="fas fa-building fa-5x"></i>
            </div>
            <div class="content">
                <small>total Departments</small>
                <h3>

                    <?php
                    $result = $obj->getData('department', 'id');
                    if ($result) {
                        echo sizeof($result);
                    } else {
                        echo 0;
                    }

                    ?>
                </h3>
            </div>
        </div>
    </a>

    <a href="./courses" class="card-link">
        <div class="card">
            <div class="icon">
                <i class="fas fa-user-graduate fa-5x"></i>
            </div>
            <div class="content">
                <small>total courses</small>
                <h3>
                    <?php
                    $result = $obj->getData('courses', 'id');
                    if ($result) {
                        echo sizeof($result);
                    } else {
                        echo 0;
                    }

                    ?>
                </h3>
            </div>
        </div>
    </a>

    <a href="./student" class="card-link">
        <div class="card">
            <div class="icon">
                <i class="fas fa-users fa-5x"></i>
            </div>
            <div class="content">
                <small>Registerd Students</small>
                <h3>
                    <?php
                    $result = $obj->getData('students', 'id');
                    if ($result) {
                        echo sizeof($result);
                    } else {
                        echo 0;
                    }
                    ?>
                </h3>
            </div>
        </div>
    </a>

</section>
<!-- right box end -->

<?php include_once 'footer.php'; ?>