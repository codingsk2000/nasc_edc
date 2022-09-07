<?php
require_once('../api/config.php');
$obj = new API();
if (!isset($_SESSION['token'])) {
    $obj->redirect('login.php');
}


$dept_id = $obj->getData('department_head', 'department', array('token' => $_SESSION['token']));
$dept_id = $dept_id[0]['department'];
$dep_name = $obj->getData('department', 'dep_name', array('id' => $dept_id));
// $result = $obj->getData('students', '*', array('dept' => $dept_id));


// Department id validation
if (isset($_GET['dep_id']) && $_GET['dep_id'] == $dept_id) {
    $id = $obj->get_safe_value($_GET['dep_id']);
    $result = $obj->getData('students', '*', array('dept' => $id),'register_no','asc');
} else {
    $obj->redirect('student.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>students list</title>
    <style>
        .print-title {
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 2rem;
            margin: 0;
            margin-top: 3rem;
        }

        p{
            text-align: center;
            margin: 0;
        }
        h3{
            text-align: center;
            font-size: 1.5rem;
            margin-top: 10px;
        }
        .cname{
            margin-top: 0!important;
        }
        .footer{
            display: flex;
            justify-content: space-around;
            /* margin-top: 17rem; */
        }
        .footer p{
            text-transform: uppercase;
            font-weight: bold;
            font-size: 15px;
            margin-top:10rem;
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
            title{
                display: none;
            }

            @page {
                margin: 2rem;
                /* padding: 1rem; */
            }
        }
    </style>
</head>

<body id="body">
    <h2 class="print-title">Nehru Arts And Science college</h2>
    <p>(An Autonoumous Institution affiliated to Bharathiar University)</p>
    <p>Nehru Gardens, Thirumalayampalayam, Coimbatore - 641105, Tamil Nadu</p>
    <hr>
    <h3>EDC: Students Registration Details</h3>
    <h3 class="cname">Department Name: <?php echo strtoupper($dep_name[0]['dep_name']); ?></h3>
    <div class="container">
        <table class="table" border="1">
            <thead>
                <tr>
                    <th>S.no</th>
                    <th>Name</th>
                    <th>Register no</th>
                    <th>Course</th>
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
                            <td class="text-uppercase"><?php echo strtoupper($val['register_no']); ?></td>
                            <td><?php echo $course_name[0]['name']; ?></td>
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
    <div class="footer">
        <p>CDC</p>
        <p>controller of examinations</p>
        <p>Principal</p>
    </div>
    <script>
        window.print();
        window.onafterprint = (e) => {
            setTimeout(() => {
                window.location.href = './student.php';
            }, 500);

        }
    </script>
</body>

</html>