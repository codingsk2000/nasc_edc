<?php
session_start();
unset($_SESSION['token']);
if(isset($_SESSION['isAdmin'])){
    unset($_SESSION['isAdmin']);
}
header('location:login.php');
die();
