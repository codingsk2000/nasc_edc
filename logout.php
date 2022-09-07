<?php
session_start();
// unset($_SESSION['is_login']);
session_destroy();
// die("logout.php hit");
?>
<script>
    window.location.href= "login.php";
</script>