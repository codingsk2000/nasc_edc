<?php
class functions
{
    function pr($arr)
    {
        echo '<pre>';
        print_r($arr);
    }

    function prx($arr)
    {
        echo '<pre>';
        print_r($arr);
        die();
    }
    function get_safe_value($con, $str)
    {
        $str = trim($str);
        $str = mysqli_real_escape_string($con, $str);
        $str = htmlentities($str);
        $str = htmlspecialchars($str);
        return $str;
    }

    function redirect($link)
    {
?>
        <script>
            window.location.href = '<?php echo $link ?>';
        </script>
<?php
        die();
    }
}
?>