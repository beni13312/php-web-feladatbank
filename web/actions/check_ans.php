<?php
session_start();

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    die("Hiba: rossz kérési protokol!");
}

/* válasz ellenörzése */

include('conn.php');
global $conn;

$feladat_id = $_SESSION['feladat'];
$answers = array(); // válaszok

$i = 1;
$sql = "SELECT valaszok.id 
FROM valaszok, megoldasok WHERE id = '$feladat_id'";
while(isset($_POST['answer-'.$i])){
    $i++;
}

