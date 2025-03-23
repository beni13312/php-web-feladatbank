<?php
session_start();

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    die("Hiba: rossz kérési protokol!");
}

/* válasz ellenörzése */

include('../conn/conn.php');
global $conn;

$category = $_SESSION['category'];
$feladat_id = $_SESSION['feladat'];

$answer = $_POST['ans']; // válasz
$answers_id_name = array(); // válaszok
$solutions = array(); // megoldások

/* válaszok kiolvsása */

$sql_ans = "SELECT valaszok.id, valaszok.valasz
        FROM valaszok, feladat_valasz, feladat, kategoria
        WHERE kategoria.id = ? AND
        feladat.id = ? AND
        feladat_valasz.feladat_id = feladat.id AND
        feladat_valasz.valasz_id = valaszok.id
        ";

$query = $conn->prepare($sql_ans);
$query->bind_param("ii",$category, $feladat_id);
$query->execute();
$result = $query->get_result();


while($row = $result->fetch_assoc()){
    $answers_id_name[] = (isset($_POST['ans-'.$row['id']]) && isset($row['valasz'])) ? (['id' => $_POST['ans-'.$row['id']], 'name' => $row['valasz']]) :
        ['id'=> null, 'name' => null]; // ha, a valasz id létezik az oldalon akkor, hozzáadjuk a tömbhöz
}


/* válaszok ellenörzése */

$sql_check = "SELECT valaszok.id AS 'good_ans_id', valaszok.valasz AS 'good_ans_name'
            FROM feladat
            JOIN feladat_megoldas ON feladat.id = feladat_megoldas.feladat_id
            JOIN megoldasok ON feladat_megoldas.megoldas_id = megoldasok.id
            JOIN feladat_valasz on feladat.id = feladat_valasz.feladat_id
            JOIN valaszok ON feladat_valasz.valasz_id = valaszok.id
            WHERE feladat.id = ? AND 
                  megoldasok.megoldas = valaszok.valasz";

$query = $conn->prepare($sql_check);
$query->bind_param("i", $feladat_id);
$query->execute();
$result = $query->get_result();

while($row = $result->fetch_assoc()){
    $solutions[] = $row['good_ans_id']; // helyes id-k hozzáadása tömbhöz
}
$_SESSION['quiz_check'] = $solutions;
header('Location: ../quiz_inner.php');
exit;
