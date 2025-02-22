<?php

$user = "root";
$host = "localhost";
$pass = "";
$db = "feladatbank";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Hiba lépett fel az adatbázis kapcsolódása közben: ".mysqli_connect_error());
}else{
    echo "ok ";
}
