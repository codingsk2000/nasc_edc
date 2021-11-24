<?php
require_once('../api/config.php');

$obj = new API();
if (!isset($_SESSION['token'])) {
    $obj->redirect('login.php');
}
$dp_id = $obj->getData('department_head','department',array('token'=>$_SESSION['token']));
$result = $obj->getData('courses','*',array('department'=>$dp_id[0]['department']));
// delete code
if(isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['id'])){

    $result = $obj->deleteData('courses', array('id' => $_GET['id']));
    if($result){
        $obj->redirect('courses');
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NASC-EDC Department Home Page</title>
    <!-- datatables cdn link -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <!-- custom css file -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

</head>

<body>
    <header class="header">
        <nav class="navbar">
            <div class="logo">
                <a href="">
                    <p>NASC <span>EDC</span></p>
                    <small>Department head</small>
                </a>
            </div>
            <form action="" class="search-form">
                <div class="form-controller">
                    <input type="text" name="search" id="search" placeholder="Search..">
                    <input type="button" id="search-btn" value="Search">
                </div>
            </form>
            <button class="toggle-btn">
                <i class="fas fa-bars"></i>
            </button>
            <ul>
                <li class="profile-btn"><a href="javascript:void(0)"><img src="./assets/images/nasc-image.jpg" alt="profile"></a></li>
            </ul>
        </nav>
    </header>
    <div class="profile-menu">
        <ul>
            <li><a href=""><i class="fas fa-user-cog"></i> setting</a></li>
            <li><a href=""><i class="fas fa-sign-out-alt"></i> logout </a></li>
        </ul>
    </div>
    <!-- left box start -->
    <section class="left-box">
        <ul>
            <li class="active"><a href="./index.html"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
            </li>
            <li><a href="./student.html"><i class="fas fa-users"></i> <span>students</span></a></li>
            <li><a href="./departmet.html"><i class="fas fa-building"></i> <span>Department</span></a></li>
            <li><a href="./courses.html"><i class="fas fa-user-graduate"></i> <span>courses</span></a></li>
            <li><a href="setting.html"><i class="fas fa-cog"></i> <span>settings</span></a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i> <span>logout</span></a></li>

        </ul>
    </section>
    <!-- left box end -->
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
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result) {
                        $i = 1;
                        foreach ($result as $val) {
                            $dep_name = $obj->getData('department', 'dep_name',array('id' => $val['department']));
                    ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $dep_name[0]['dep_name']; ?></td>
                                <td><?php echo $val['name']; ?></td>
                                <td>
                                    <a id="edit" href="add_course?type=edit&id=<?php echo $val['id']; ?>">Edit</a>
                                    <a id="delete" href="?type=delete&id=<?php echo $val['id']; ?>">delete</a>
                                </td>
                            </tr>
                        <?php $i++; }  }?>

                </tbody>
            </table>
        </div>

    </section>
    <!-- right box end -->

    <!-- footer section start -->
    <footer class="footer">
        <p>copyright &copy; <span class="footer-date"></span>| All rights reserved</p>
    </footer>

    <!-- footer section end -->

    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <!-- custom js file -->
    <script src="./assets/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                responsive: true
            });
        });
    </script>

</body>

</html>