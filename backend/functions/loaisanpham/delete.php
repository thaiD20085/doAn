<?php
    if(isset($_GET['lsp_ma'])){
        $lsp_ma = $_GET['lsp_ma'];
        include_once(__DIR__ . '/../../../dbconnect.php');
        $sql = <<<EOT
        DELETE FROM loaisanpham WHERE lsp_ma='$lsp_ma'
EOT;
        mysqli_query($conn, $sql);
        header('Location: ./');
    }