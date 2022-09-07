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