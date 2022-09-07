<?php
define('TITLE', 'courses');
define('PAGE', 'course');
require_once('./header.php');
require_once('../api/config.php');

$obj = new API();
if (!isset($_SESSION['token'])) {
    $obj->redirect('login.php');
}
$dp_id = $obj->getData('department_head', 'department', array('token' => $_SESSION['token']));
$result = $obj->getData('courses', '*', array('department' => $dp_id[0]['department']));
// delete code
if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['id'])) {

    $result = $obj->deleteData('courses', array('id' => $_GET['id']));
    if ($result) {
        $obj->redirect('courses');
    }
}

?>

<!-- right box start -->
<section class="right-box">
    <div class="right-box-title">
        <h1>courses <i class="fas fa-chevron-right"></i></h1>
        <a href="./add_course.php">Add course</a>
    </div>
    <div class="data-table">
        <table id="table" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>departmet</th>
                    <th>EDC courses</th>
                    <th>Course Code</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    $i = 1;
                    foreach ($result as $val) {
                        $dep_name = $obj->getData('department', 'dep_name', array('id' => $val['department']));
                ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $dep_name[0]['dep_name']; ?></td>
                            <td><?php echo $val['name']; ?></td>
                            <td><?php echo $val['course_code']; ?></td>
                            <td>
                                <a id="edit" href="add_course.php?type=edit&id=<?php echo $val['id']; ?>">Edit</a>
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

<?php include_once 'footer.php'; ?>