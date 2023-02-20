<?php
    include('conn.php');
    session_start();
    if(session_destroy()) {
        header("Location: index.php");
    }
    else echo"Not Destroyed!";
?>
