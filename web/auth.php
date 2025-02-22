<?php
session_start();

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    die("Hiba: rossz kérési protokol!");
}

$username = $_POST['username'];
$password = $_POST['password'];


if(empty($username) || empty($password)){
    $_SESSION['error'] = "Felhasználó név és a jelszó nem lehet üres!";
    header('Location: admin.php');
    exit;
}



include("conn.php");
// lekérdezés prepare(),

$sql = "SELECT fnev, jelszo FROM admin_felhasznalok WHERE fnev= ?";
$query = $conn->prepare($sql);
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();

if(mysqli_num_rows($result) == 1){
    $row = $result->fetch_assoc();

    if($row['fnev'] && password_verify($password, $row['jelszo'])){
        echo "user valid";
    }else{
        $_SESSION['error'] = "Felhasználó név vagy a jelszó helytelen!";
        header('Location: admin.php');
        exit;
    }
}else{
    $_SESSION['error'] = "Felhasználó név vagy a jelszó helytelen!";
    header('Location: admin.php');
    exit;
}



$query->close();
