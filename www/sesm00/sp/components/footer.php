<footer class="py-3 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Česká dálnice CZ</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="<?php echo getProtocol() . $_SERVER['HTTP_HOST'] . BASE_URL; ?>assets/js/app.js"></script>
<script>
    var BASE_URL = "<?php echo getProtocol() . $_SERVER['HTTP_HOST'] . BASE_URL; ?>";
    <?php echo MediaManager::printAllJavascriptConstants(); ?>
</script>
<?php echo MediaManager::printAllScripts(); ?>

</body>

</html>