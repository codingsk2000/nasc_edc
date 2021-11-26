<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nehru Arts And Science College - EDC</title>
    <!-- custom css file -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

</head>

<body>
    <!-- navbar section start -->
    <header class="header">
        <nav class="navbar">
            <a href="./index" class="logo">NASC <span>EDC</span></a>
            <button id="btn-toggler">
                <i class="fas fa-bars"></i>
            </button>
            <ul>
                <li class="active"><a href="./index">Home</a></li>
                <li><a href="./courses">Courses</a></li>
                <li><a href="./departments">Department</a></li>
                <li><a target="_blank" href="https://www.nehrucolleges.net/">NASC</a></li>
                <li id="dashboard"><a href="./login">Dashboard</a></li>
            </ul>
            <div class="dashboard-btn">
                <a class="btn-main" href="./login">Dashboard</a>
            </div>
        </nav>

    </header>
    <!-- navbar section end -->