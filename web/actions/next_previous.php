<?php
session_start();

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    die("Hiba: rossz kérési protokol!");
}

/* következő kérdés */

$advance = $_POST['quiz-advance'];
$category = $_SESSION['category'];

if(isset($category) && isset($advance)){
    $_SESSION['feladat'] +=1; // növeljük a sessionben a feladat id-t, a következő feladat érdekében
    $_SESSION['feladat_index'] +=1; // növeljük a sessionben a feladat indexet, hogy megjelenjen a feladat száma az oldalon
    header('Location: quiz_inner.php'); // átirányítjuk a user-t megfelelő oldalra
    exit;
}

/* elöző kérdés */

$advance = $_POST['quiz-before'];

if(isset($category) && isset($advance)){
    $_SESSION['feladat'] -=1; // csökkentjük a sessionben a feladat id-t, az elöző feladat érdekében
    $_SESSION['feladat_index'] -=1; // csökkentjük a sessionben a feladat indexet, hogy megjelenjen a feladat száma az oldalon
    header('Location: quiz_inner.php'); // átirányítjuk a user-t megfelelő oldalra
    exit;
}



