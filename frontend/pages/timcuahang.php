<?php
if (session_id() == null) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once(__DIR__ . '/../layouts/config.php'); ?>

<head>
    <?php include_once(__DIR__ . '/../layouts/head.php'); ?>
    <style>

    </style>
</head>

<body>
    <!-- nav-bar -------------------------------------------------------------------------------- -->
    <?php include_once(__DIR__ . '/../partials/header.php') ?>
    <!-- main content-------------------------------------------------------------------------------- -->
    <div id="app">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <h3 class="text-center" style="color: #FCA311">Uy tín và chất lượng cao</h3>
                    <p class="text-center">Đưa bạn đến với những sự lựa chọn chất lượng với mức giá tốt nhất.</p>
                    <hr style="width:50%">
                </div>
                <div class="col">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15715.173609546753!2d105.7798736!3d10.0339003!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xfa43fbeb2b00ca73!2sCUSC%20-%20Cantho%20University%20Software%20Center!5e0!3m2!1svi!2s!4v1601185034054!5m2!1svi!2s" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>


    </div>
    <!--Footer-->
    <?php include_once(__DIR__ . '/../partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>

    <script>

    </script>
</body>

</html>