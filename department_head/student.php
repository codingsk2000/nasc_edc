<?php
define('TITLE', 'students');
define('PAGE', 'students');
require_once('./header.php');
require_once('../api/config.php');
$obj = new API();
if (!isset($_SESSION['token'])) {
    $obj->redirect('login.php');
}
// delete code
if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['id'])) {
    $id = $obj->get_safe_value($_GET['id']);
    $cid = $obj->getData('students','course',array('id'=>$id));
    $no_of_max_stu = $obj->getData('courses','max_stu',array('id'=>$cid[0]['course']));
    $update_max = $no_of_max_stu[0]['max_stu']-1;
    $res = $obj->updateData('courses',array('max_stu'=>$update_max),'id',$cid[0]['course']);
    $result = $obj->deleteData('students', array('id' => $id));
    if ($result) {
        $obj->redirect('student.php');
    }
}

$dept_id = $obj->getData('department_head', 'department', array('token' => $_SESSION['token']));
$dept_id = $dept_id[0]['department'];
$result = $obj->getData('students', '*', array('dept' => $dept_id),'register_no','asc');

?>
<!-- right box start -->
<section class="right-box">
    <div class="right-box-title">
        <h1>students <i class="fas fa-chevron-right"></i></h1>
        <a href="./print_student.php?dep_id=<?php echo $dept_id; ?>" class="print-btn"><i class="fas fa-print"></i> print</a>
    </div>
    <div class="data-table">
        <table id="table" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Register no</th>
                    <th>Name</th>
                    <th>year</th>
                    <th>department</th>
                    <th>course</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($result) {
                    $i = 1;
                    foreach ($result as $val) {
                        $dep_name = $obj->getData('department', 'dep_name', array('id' => $val['dept']));
                        $course_name = $obj->getData('courses', 'name', array('id' => $val['course']));
                ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td style="text-transform: uppercase;"><?php echo $val['register_no'] ?></td>
                            <td><?php echo $val['name']; ?></td>
                            <td><?php echo $val['year']; ?></td>
                            <td><?php echo $dep_name[0]['dep_name']; ?></td>
                            <td><?php echo $course_name[0]['name']; ?></td>

                            <td>
                                <a id="delete" href="?type=delete&id=<?php echo $val['id']; ?>">delete</a>
                            </td>
                        </tr>
                <?php $i++;
                    }
                } ?>
            </tbody>
        </table>
    </div>

</section>
<!-- right box end -->

<?php include './footer.php'; ?>