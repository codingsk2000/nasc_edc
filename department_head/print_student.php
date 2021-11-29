<?php
require_once('../api/config.php');
$obj = new API();
if (!isset($_SESSION['token'])) {
    $obj->redirect('login');
}


$dept_id = $obj->getData('department_head', 'department', array('token' => $_SESSION['token']));
$dept_id = $dept_id[0]['department'];
$dep_name = $obj->getData('department', 'dep_name', array('id' => $dept_id));
// $result = $obj->getData('students', '*', array('dept' => $dept_id));


// delete code
if (isset($_GET['dep_id']) && $_GET['dep_id'] == $dept_id) {
    $id = $obj->get_safe_value($_GET['dep_id']);
    $result = $obj->getData('students', '*', array('dept' => $id));
} else {
    $obj->redirect('student');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>students list</title>
    <style>
        .print-title {
            text-align: center;
            text-transform: capitalize;
        }

        .container {
            width: 60%;
            margin: auto;
            margin-top: 2rem;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            text-transform: capitalize;
        }

        .table tr td,
        .table tr th {
            padding: .3rem;
        }

        .table .text-uppercase {
            text-transform: uppercase;
        }

        @media(max-width:768) {
            .container {
                width: 80%;
            }
        }

        @media print {
            .container {
                width: 100%;
            }
            @page{
                margin: 2rem;
            }
        }
    </style>
</head>

<body>
    <h2 class="print-title"><?php echo $dep_name[0]['dep_name']; ?> students list (EDC)</h2>
    <div class="container">
        <table class="table" border="1">
            <thead>
                <tr>
                    <th>S.no</th>
                    <th>Name</th>
                    <th>Register no</th>
                    <th>course</th>
                    <th>year</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    $i = 1;
                    foreach ($result as $val) {

                        $course_name = $obj->getData('courses', 'name', array('id' => $val['course']));
                ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $val['name'] ?></td>
                            <td class="text-uppercase"><?php echo $val['register_no']; ?></td>
                            <td><?php echo $course_name[0]['name']; ?></td>
                            <td><?php echo $val['year']; ?></td>
                        </tr>
                <?php $i++;
                    }
                } else {
                    echo '<tr>
                    <td colspan="5">No data Available</td>
                    </tr>';
                }

                ?>

            </tbody>
        </table>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>