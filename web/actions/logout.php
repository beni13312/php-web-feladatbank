<?php
session_start();

if(isset($_SESSION['authorized'])){
    unset($_SESSION['authorized']);
    unset($_SESSION['session_id']);
    header('Location: ../admin.php');
    exit;
}