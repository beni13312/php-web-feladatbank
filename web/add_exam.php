<?php
session_start();

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    die("Hiba: rossz kérési protokol!");
}

$cat = $_POST['category'];
$question = $_POST['exam-question'];
$answers = array(); // válaszok
$solutions = array(); // megoldások

// válaszok hozzáadása tömbhöz
for($ans = 1; $ans<=10; $ans++){
    if(isset($_POST['ans-'.$ans])){
        $answers[] = $_POST['ans-' . $ans];
    }
}

// megoldások hozzáadása tömbhöz
for($sol = 1; $sol<=10; $sol++){
    if(isset($_POST['isSol-'.$sol])){
        $solutions[] = $_POST['isSol-'.$sol];
    }
}
if(!isset($cat) || !isset($question) || sizeof($answers) < 2 || sizeof($solutions) < 1){ // ellenörzés
    $_SESSION['error'] = "Nem lehet egy mező sem üres!!: "."cat:".$cat."question: ".$question."arrays: ".sizeof($answers).":".sizeof($solutions);
    header("Location: admin.php?dashboard");
    exit;


}else{
    try{
        // adatok beírása
        include 'conn.php';
        global $conn;


        /* válaszok */


        $sql_ans = "INSERT INTO valaszok (valasz) VALUES (?)";

        $query = $conn->prepare($sql_ans);

        foreach ($answers as $ans){
            $query->bind_param("s",$ans); // válaszok elhelyezése
            $query->execute();
        }

        /* megoldások */



        $sql_sol = "INSERT INTO megoldasok (megoldas) VALUES (?)";

        $query = $conn->prepare($sql_sol);

        foreach ($solutions as $sol){
            $query->bind_param("s",$sol); // válaszok elhelyezése
            $query->execute();
        }

        /* feladat */


        $sql_feladat = "INSERT INTO feladat (kat_id, kerdes) VALUES ((?),(?))";

        $query = $conn->prepare($sql_feladat);
        $query->bind_param("is",$cat, $question); // válaszok elhelyezése
        $query->execute();


        /* feladat_valasz */


        $sql_feladat_valasz = "INSERT INTO feladat_valasz (feladat_id, valasz_id) VALUES (
            (SELECT feladat.id FROM feladat WHERE kerdes = ?),
            (SELECT valaszok.id FROM valaszok WHERE valasz = ?)
                                    )";

        $query = $conn->prepare($sql_feladat_valasz);

        foreach($answers as $ans){
            $query->bind_param("ss",$question,$ans);
            $query->execute();
        }


        /* feladat_megoldas */


        $sql_feladat_megoldas = "INSERT INTO feladat_megoldas (feladat_id, megoldas_id) VALUES (
                        (SELECT feladat.id FROM feladat WHERE kerdes = ?),
                        (SELECT megoldasok.id FROM megoldasok WHERE megoldas = ?)
                        )";

        $query = $conn->prepare($sql_feladat_megoldas);
        foreach($solutions as $sol){
            $query->bind_param("ss",$question,$sol);
            $query->execute();

        }

        $_SESSION['success'] = "Az adatok bekerültek az adatbázisba!";
        header("Location: admin.php?dashboard");
        exit;
    }catch (Exception $e){
        $_SESSION['error'] = $e->getMessage();
    }

}