<?php
session_start();

if(isset($_SESSION['authorized'][0]) && isset($_SESSION['authorized'][1])){
    if(!isset($_GET['dashboard'])){
        header('Location: admin.php?dashboard');
    }
    include("admin_dash.php");
}else{
    include("admin_login.php");
}
