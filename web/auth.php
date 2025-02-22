<?php
session_start();

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    die("Hiba: rossz kérési protokol!");
}

$username = str_replace(["'",'"'],"",$_POST['username']);
$password = str_replace(["'",'"'],"",$_POST['password']);


if(empty($username) || empty($password)){
    $_SESSION['error'] = "Felhasználó név és a jelszó nem lehet üres!";
    header('Location: admin.php');
    exit;
}



include("conn.php");

$sql = "SELECT fnev, jelszo FROM admin_felhasznalok WHERE fnev='".$username."'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);

if($row['fnev'] && password_verify($password, $row['jelszo'])){
    echo "user valid";
}else{
    $_SESSION['error'] = "Felhasználó név vagy a jelszó helytelen!";
    header('Location: admin.php');
    exit;
}
