<?php

$user = "root";
$host = "localhost";
$pass = "";
$db = "feladatbank";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    // echo "<script>console.log('Hiba lépett fel az adatbázis kapcsolódása közben: ".mysqli_connect_error()."');</script>";
    die("Hiba lépett fel az adatbázis kapcsolódása közben: ".mysqli_connect_error());
}else{
    // echo "ok ";
}
