<?php
define('TITLE', 'course');
define('PAGE', 'course');
require_once('./header.php');
require_once('./api/config.php');

$obj = new API();
if(!isset($_SESSION['is_login'])){
    $obj->redirect('login.php');
}
$result = $obj->getData('courses', 'name');
?>

<!-- banner section start -->
<section class="header-banner">
    <div class="content">
        <h3>courses</h3>
    </div>

</section>

<!-- banner section end -->

<section class="department-list">
    <h1>All <span>EDC</span> Courses List</h1>
    <div class="all-list">
        <ul>
            <?php
            if ($result) {
                foreach ($result as $val) { ?>
                    <li><i class="fas fa-chevron-right"></i> <?php echo ucwords($val['name']); ?></li>
            <?php }
            } else {
                echo '<div>No courses available</div>';
            } ?>

        </ul>
    </div>
</section>

<footer>
    <p>copyright &copy; <span id="footerDate"></span>| All Rights Reserved</p>
</footer>

<!-- custom js file -->
<script src="./assets/js/custom.js"></script>

</body>

</html>