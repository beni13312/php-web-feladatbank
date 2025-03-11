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
    header('Location: exam.php?cat='.$category); // átirányítjuk a user-t megfelelő oldalra
}

/* elöző kérdés */

$advance = $_POST['exam-before'];
$category = $_SESSION['category'];

if(isset($category) && isset($advance)){
    $_SESSION['feladat'] -=1; // csökkentjük a sessionben a feladat id-t, az elöző feladat érdekében
    $_SESSION['feladat_index'] -=1; // csökkentjük a sessionben a feladat indexet, hogy megjelenjen a feladat száma az oldalon
    header('Location: exam.php?cat='.$category); // átirányítjuk a user-t megfelelő oldalra
}

/* válasz ellenörzése */


