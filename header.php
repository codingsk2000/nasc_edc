<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nehru Arts And Science College - EDC <?php echo TITLE; ?> page</title>
    <link rel="icon" href="assets/images/nasc_logo.png" type="image/png" sizes="16x16">
    <!-- custom css file -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

</head>

<body>
    <!-- top navbar nehru logo with name start -->
    <section class="top-navbar">
        <div class="nav-container">
            <img src="./assets/images/nasc_logo.png" alt="">
            <div class="content">
                <h1>Nehru Arts And Science College | AUTONOMOUS</h1>
                <p>Reaccredited with “A” Grade by NASC  ISO 9001:2015 & 14001:2004 Certified Recognised bu UGC with 2(f) & 12(B)</p>
                <p>Affliated to Bharathiar University </p>
            </div>
            <img src="./assets/images/ngi_logo.png" alt="">
        </div>
    </section>
    <!-- top navbar nehru logo with name end -->

    <!-- navbar section start -->
    <header class="header">
        <nav class="navbar">
            <a href="./index.php" class="logo">NASC <span>EDC</span></a>
            <button id="btn-toggler">
                <i class="fas fa-bars"></i>
            </button>
            <ul>
                <li class="<?php if (PAGE == 'home') {
                                echo 'active';
                            } ?>"><a href="./index.php">Home</a></li>
                <li class="<?php if (PAGE == 'course') {
                                echo 'active';
                            } ?>"><a href="./courses.php">Courses</a></li>
                <li class="<?php if (PAGE == 'department') {
                                echo 'active';
                            } ?>"><a href="./departments.php">Department</a></li>
                <li class="sm_logout"><a href="logout.php">Logout</a></li>
               
            </ul>
            <div class="dashboard-btn">
                <a class="btn-main" href="./logout.php">Logout</a>
            </div>
        </nav>

    </header>
    <!-- navbar section end -->