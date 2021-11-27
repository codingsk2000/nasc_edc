<?php
define('TITLE', 'Home');
define('PAGE', 'home');
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

    <div class="card-container">

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
    </div>
    <!-- datatable start -->
    <div class="data-table">
        <table id="table" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>department</th>
                    <th>EDC Courses</th>
                    <th>total students registered</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $result = $obj->getData('department', 'dep_name,id');
                if ($result) {
                    foreach ($result as $val) {
                        $course_count = $obj->getData('courses', 'id,name', array('department' => $val['id']));
                        // echo '<pre>';
                        // print_r($course_count);
                        if ($course_count) {
                            echo " <tr>
                               <td rowspan=" . sizeof($course_count) . ">" . $i . "</td>
                               <td rowspan=" . sizeof($course_count) . ">" . $val['dep_name'] . "</td>";
                            foreach ($course_count as $count) {
                                echo "<td>" . $count['name'] . "</td>";
                                $student_count = $obj->getData('students', 'id', array('course' => $count['id']));
                                if ($student_count) {
                                    echo "<td>" . sizeof($student_count) . "</td></tr>";
                                } else {
                                    echo "<td>0</td></tr>";
                                }
                            }
                        } else {
                            echo "<tr>
                               <td>" . $i . "</td>
                               <td>" . $val['dep_name'] . "</td>
                               <td>0</td>
                               <td>0</td>
                           </tr>";
                        }
                        $i++;
                    }
                } ?>

            </tbody>
        </table>
    </div>

    <!-- datatable end -->

</section>
<!-- right box end -->

<?php include_once 'footer.php'; ?>