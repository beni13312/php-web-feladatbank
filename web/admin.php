<?php
session_start();

if(isset($_SESSION['authorized']) && isset($_SESSION['session_id'])){
    if(!isset($_GET['dashboard'])){
        header('Location: admin.php?dashboard');
    }
    include("admin_dash.php");
}else{
    include("admin_login.php");
}
