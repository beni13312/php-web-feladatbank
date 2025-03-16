<?php
session_start();

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    die("Hiba: rossz kérési protokol!");
}

/* következő kérdés */

$advance = $_POST['exam-advance'];
$category = $_SESSION['category'];

if(isset($category) && isset($advance)){
    $_SESSION['feladat'] +=1; // növeljük a sessionben a feladat id-t, a következő feladat érdekében
    $_SESSION['feladat_index'] +=1; // növeljük a sessionben a feladat indexet, hogy megjelenjen a feladat száma az oldalon
    header('Location: quiz_inner.php'); // átirányítjuk a user-t megfelelő oldalra
}

/* elöző kérdés */

$advance = $_POST['exam-before'];

if(isset($category) && isset($advance)){
    $_SESSION['feladat'] -=1; // csökkentjük a sessionben a feladat id-t, az elöző feladat érdekében
    $_SESSION['feladat_index'] -=1; // csökkentjük a sessionben a feladat indexet, hogy megjelenjen a feladat száma az oldalon
    header('Location: quiz_inner.php'); // átirányítjuk a user-t megfelelő oldalra
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



