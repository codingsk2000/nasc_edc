<?php
define('TITLE', 'Home');
define('PAGE', 'home');
include_once './header.php';
require_once('../api/config.php');

$obj = new API();
if (!isset($_SESSION['token'])) {
    $obj->redirect('login.php');
}

?>
<!-- right box start -->
<section class="right-box">
    <div class="right-box-title">
        <h1>Dashboard <i class="fas fa-chevron-right"></i></h1>
    </div>

    <div class="card-container">

        <a href="./department.php" class="card-link">
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

        <a href="./courses.php" class="card-link">
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

        <a href="./student.php" class="card-link">
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
    <!-- only for admin print student list course wise and department wise -->
    <?php if(isset($_SESSION['isAdmin'])){ ?>
    <div class="course_list" style="margin-top: 2rem; padding:2rem;display:flex;">
    <div>
            <h1 style="font-size:20px;">Course Wise List:</h1>
            <form action="./cprint.php" method="post">
                <div>
                    <div>
                        <input type="text" style="margin-top:15px;padding:10px;border:1px solid;border-radius:10px;width:350px" id="csearch" placeholder="Search..." name="search" onkeyup="filter('csearch','cselect')">
                    </div>
                    <div>
                        <select style="margin-top:15px;padding:10px;border:1px solid;border-radius:10px;width:350px;overflow:auto;" name="cid" id="cselect" size="7">
                        <?php
                            $res = $obj->getData('courses','name,id',array(''),'name','asc');
                            if($res[0]){
                                foreach($res as $dep){?>

                                <option value="<?php echo $dep['id']; ?>"><?php echo ucwords($dep['name']); ?></option>
                               <?php }
                            }else{
                                echo '<option value="">No Data Found</option>';
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <input type="submit" style="padding:10px;margin-top:10px;background:#002147;color:white" name="csubmit" value="Print">
            </form>
        </div>

        <div style="margin-left:10px;" class="dep_list">
            <h1 style="font-size:20px;">Department Wise List:</h1>
            <form action="./dprint.php" method="post">
                <div>
                    <div>
                        <input type="text" style="margin-top:15px;padding:10px;border:1px solid;border-radius:10px;width:350px" id="dsearch" placeholder="Search..." name="search" onkeyup="filter('dsearch','dselect')">
                    </div>
                    <div>
                        <select style="margin-top:15px;padding:10px;border:1px solid;border-radius:10px;width:350px" name="did" id="dselect" size="7">
                        <?php
                            $res = $obj->getData('department','dep_name,id',array(''),'dep_name','asc');
                            if($res[0]){
                                foreach($res as $dep){?>

                                <option value="<?php echo $dep['id']; ?>"><?php echo strtoupper($dep['dep_name']); ?></option>
                               <?php }
                            }else{
                                echo '<option value="">No Data Found</option>';
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <input type="submit" style="padding:10px;margin-top:10px;background:#002147;color:white" name="csubmit" value="Print">
            </form>
        </div>
    </div>
    <?php } ?>
    <!-- datatable start -->
    <div class="data-table">
        <h1 style="font-size:2rem;margin-top:10px;margin-bottom:10px;">All List of Courses & Departments</h1>
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
<script>
    function filter(key,val) {
        var keyword = document.getElementById(key).value;
        var select = document.getElementById(val);
        for (var i = 0; i < select.length; i++) {
            var txt = select.options[i].text;
            if (txt.substring(0, keyword.length).toLowerCase() !== keyword.toLowerCase() && keyword.trim() !== "") {
                select.options[i].style.display = 'none';
            } else {
                select.options[i].style.display = 'list-item';
            }
        }
    }
</script>
<?php include_once 'footer.php'; ?>