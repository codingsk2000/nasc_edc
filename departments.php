<?php
define('TITLE', 'department');
define('PAGE', 'department');
require_once('./header.php');
require_once('./api/config.php');
$obj = new API();
$obj = new API();
if(!isset($_SESSION['is_login'])){
    $obj->redirect('login.php');
}
$result = $obj->getData('department', 'dep_name');

?>

<!-- banner section start -->
<section class="header-banner">
    <div class="content">
        <h3>departments</h3>
    </div>

</section>

<!-- banner section end -->

<section class="department-list">
    <h1>Department <span>List</span></h1>
    <div class="all-list">
        <ul>
            <?php
            if ($result) {
                foreach ($result as $val) { ?>
                    <li><i class="fas fa-chevron-right"></i> <?php echo strtoupper($val['dep_name']); ?></li>
            <?php }
            } else {
                echo '<div>No any departments available</div>';
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