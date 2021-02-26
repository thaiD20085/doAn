<?php
    if(session_id() === ''){
        session_start();
    }
    include_once(__DIR__.'/pages/dashboard.php');
