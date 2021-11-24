<?php
require_once('../api/config.php');

$obj = new API();
if (!isset($_SESSION['token'])) {
    $obj->redirect('login.php');
}

if (isset($_POST['add_department']) && $_POST['update'] == '') {
    $department = $_POST['department'];
    $date = date('y-m-d h:i:s');

    $result = $obj->insertData('department', array('dep_name' => $department, 'created_at' => $date));
    if ($result) {
        $msg = "department added successfully";
    } else {
        $msg = "please try again";
    }
}


// update code
if (isset($_POST['add_department']) && $_POST['update'] != '') {

    $result = $obj->updateData('department', array('dep_name' => $_POST['department']), 'id', $_GET['id']);
    if ($result) {
        $msg = 'data update successfully';
    } else {
        $msg = 'data not updated';
    }
}

// update code
if (isset($_GET['type']) && $_GET['type'] == 'edit' && isset($_GET['id'])) {

    $update_val = $obj->getData('department', 'dep_name', array('id' => $_GET['id']));
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
            <li><a href="./setting.html"><i class="fas fa-cog"></i> <span>settings</span></a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i> <span>logout</span></a></li>

        </ul>
    </section>
    <!-- left box end -->
    <!-- right box start -->
    <section class="right-box">
        <div class="right-box-title">
            <h1>add Departments <i class="fas fa-chevron-right"></i></h1>
        </div>

        <?php if (isset($msg)) {
            echo "<div class='msg'> $msg </div>";
        } ?>

        <div class="profile-form">
            <h1>department details</h1>
            <div class="setting-form">
                <form method="post" autocomplete="off">
                    <div class="form-controller">
                        <label for="course">department Name</label>
                        <input type="text" name="department" value="<?php if (isset($update_val)) {
                                                                        echo $update_val[0]['name'];
                                                                    } ?>" id="course" required placeholder="Enter department Name">
                    </div>
                    <input type="hidden" name="update" value="<?php if (isset($update_val)) {
                                                                    echo 'true';
                                                                } ?>">
                    <div class="from-btn-section">
                        <input type="submit" name="add_department" value="add department">
                        <a href="./department" class="close-btn">close</a>
                    </div>
                </form>
            </div>
        </div>

    </section>
    <!-- right box end -->

    <!-- footer section start -->
    <footer class="footer">
        <p>copyright &copy; <span class="footer-date"></span>| All rights reserved</p>
    </footer>

    <!-- footer section end -->
    <!-- custom js file -->
    <script src="./assets/js/custom.js"></script>

</body>

</html>