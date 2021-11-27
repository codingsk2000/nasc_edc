<?php
define('TITLE', 'students');
define('PAGE', 'students');
require_once('./header.php');
require_once('../api/config.php');
$obj = new API();
if (!isset($_SESSION['token'])) {
    $obj->redirect('login');
}
$result = $obj->getData('students');

// delete code
if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['id'])) {
    $id = $obj->get_safe_value($_GET['id']);
    $result = $obj->deleteData('students', array('id' => $id));
    if ($result) {
        $obj->redirect('student');
    }
}
?>
<!-- right box start -->
<section class="right-box">
    <div class="right-box-title">
        <h1>students <i class="fas fa-chevron-right"></i></h1>
    </div>
    <div class="data-table">
        <table id="table" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Register no</th>
                    <th>Name</th>
                    <th>mobile</th>
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
                            <td><?php echo $val['mobile']; ?></td>
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