<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/images/nasc_logo.png" type="image/png" sizes="16x16">
    <title>NASC-EDC Department - <?php echo TITLE; ?> page</title>
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
                <a href="./index.php">
                    <p>NASC <span>EDC</span></p>
                    <small>Department head</small>
                </a>
            </div>
            <!-- <form class="search-form">
                <div class="form-controller">
                    <input type="search" onchange="showData(this.value)" name="search" id="search" placeholder="Search..">
                    <input type="button" id="search-btn" value="Search">
                </div>
            </form> -->
            <button class="toggle-btn">
                <i class="fas fa-bars"></i>
            </button>
            <ul>
                <li class="profile-btn"><a href="javascript:void(0)"><img src="./assets/images/nasc-image.jpg" alt="profile"></a><i class="fas fa-sort-down"></i></li>
            </ul>
        </nav>
    </header>
    <div class="profile-menu">
        <ul>
            <li><a href="setting.php"><i class="fas fa-user-cog"></i> setting</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> logout </a></li>
        </ul>
    </div>
    <!-- left box start -->
    <section class="left-box">
        <ul>
            <li class="<?php if (PAGE == 'home') {
                            echo 'active';
                        } ?>"><a href="./index.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
            <li class="<?php if (PAGE == 'students') {
                            echo 'active';
                        } ?>"><a href="./student.php"><i class="fas fa-users"></i> <span>students</span></a></li>
            <li class="<?php if (PAGE == 'department') {
                            echo 'active';
                        } ?>"><a href="./department.php"><i class="fas fa-building"></i> <span>Department</span></a></li>
            <li class="<?php if (PAGE == 'course') {
                            echo 'active';
                        } ?>"><a href="./courses.php"><i class="fas fa-user-graduate"></i> <span>courses</span></a></li>
            <li class="<?php if (PAGE == 'setting') {
                            echo 'active';
                        } ?>"><a href="./setting.php"><i class="fas fa-cog"></i> <span>settings</span></a></li>
            <li><a href="./logout.php"><i class="fas fa-sign-out-alt"></i> <span>logout</span></a></li>

        </ul>
    </section>
    <!-- left box end -->