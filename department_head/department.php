<?php
define('TITLE', 'Department');
define('PAGE', 'department');
require_once('./header.php');
require_once('../api/config.php');

$obj = new API();
if (!isset($_SESSION['token'])) {
    $obj->redirect('login.php');
}

?>
<!-- right box start -->
<section class="right-box">
    <div class="right-box-title">
        <h1>Departments <i class="fas fa-chevron-right"></i></h1>
    </div>
    <div class="data-table">
        <table id="table" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Department</th>
                    <th>No. of courses offers</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $login_id = $obj->getData('department_head', 'department', array('token' => $_SESSION['token']));
                $result = $obj->getData('department', '*', array('id' => $login_id[0]['department']));
                if ($result) {
                    $i = 1;
                    foreach ($result as $val) { ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $val['dep_name']; ?></td>
                            <td>
                                <?php
                                $result = $obj->getData('courses', 'id', array('department' => $val['id']));
                                if ($result) {
                                    echo sizeof($result);
                                } else {
                                    echo 0;
                                }
                                ?>
                            </td>
                            <td>
                                <a id="edit" href="add_department.php?type=edit&id=<?php echo $val['id']; ?>">Edit</a>
                            </td>
                        </tr>

                <?php }
                    $i++;
                } ?>

            </tbody>
        </table>
    </div>

</section>
<!-- right box end -->

<?php include './footer.php'; ?>