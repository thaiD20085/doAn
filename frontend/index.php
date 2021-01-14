<?php
if(session_id() === '') session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- IMPORT các style -->
    <?php include_once(__DIR__.'/layouts/styles.php');?>
    <link href="/php/project_D20085/assets/frontend/css/style.css" type="text/css" rel="stylesheet" />
    <title>Trang chủ - Shop Máy vi tính</title>
</head>
<body>
    <!-- HEADER -->
    <?php include_once(__DIR__.'/layouts\partials\header.php')?>
    <!-- CONTENT -->



    <!-- FOOTER -->
    <?php include_once(__DIR__.'/layouts\partials\footer.php')?>
    <!-- IMPORT các script -->
    <?php include_once(__DIR__.'/layouts/scripts.php');?>
</body>
</html>