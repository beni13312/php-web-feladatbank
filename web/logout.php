<?php
session_start();

if(isset($_SESSION['authorized'][0]) && isset($_SESSION['authorized'][1])){
    session_unset();
    session_destroy();
    header('Location: admin.php');
    exit;
}