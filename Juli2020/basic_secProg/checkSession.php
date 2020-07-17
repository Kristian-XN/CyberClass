<?php
    session_start();
    
    // timeout 30m
    $timeout = 1800;
    if(isset($_SESSION['time']) && time()-$_SESSION['time'] > $timeout)
    {
        header('Location: ./logout.php');
        exit();
    }
?>
