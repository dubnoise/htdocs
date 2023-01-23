<?php
    
    if (isset($_GET['lang'])){
        setcookie('lang', $_GET['lang'], time()+60*60*24);
    }
    else{
        require_once('inc/lang/es.inc.php');
    }
    if (isset($_COOKIE['lang'])){
        require_once('inc/lang/'.$_COOKIE['lang'].'.inc.php');
    }
?>