<?php 
    //cette page pour obj faire une deconnetion//
    session_start();
    $_SESSION=array();
    session_destroy();
    header("Locatoion:index.php");
?>