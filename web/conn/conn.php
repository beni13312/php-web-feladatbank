<?php


$user = "infogy";
$host = "localhost";
$pass = "PF15kap*";
$db = "feladatbank";


try {
    $conn = mysqli_connect($host, $user, $pass, $db);
} catch (mysqli_sql_exception $e) {
    die("Hiba lépett fel az adatbázis kapcsolódása közben: " . $e->getMessage());
}