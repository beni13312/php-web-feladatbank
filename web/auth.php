<?php
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    die( "Hiba: rossz kérési protokol!");
}

$username = $_POST['username'];
$password = $_POST['password'];

if(empty($username) || empty($password)){
    $_SESSION['error'] = "Felhasználó név és a jelszó nem lehet üres!";
    header('Location: admin.php');
}