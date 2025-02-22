<?php
session_start();

if(isset($_SESSION['authorized'][0]) && isset($_SESSION['authorized'][1]) && isset($_GET['dashboard'])){
    include("admin_dash.php");
}else{
    include("admin_login.php");
}
