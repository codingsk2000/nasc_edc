<footer>
    <p>copyright &copy; <span id="footerDate"></span>| All Rights Reserved</p>
</footer>

<!-- custom js file -->
<script src="./assets/js/custom.js"></script>
<script>
    document.querySelector('#submit-btn').onclick = () => {
        document.querySelector('.dialog').classList.add('active');
        document.querySelector('#final-submit-btn').classList.add('active');
        document.querySelector('#submit-btn').classList.add('disabled');
    };
    document.querySelector('#close').onclick = () => {
        document.querySelector('.dialog').classList.remove('active');

    };
</script>

</body>

</html>