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

        $valaszok_ids = [];

        foreach ($answers as $ans){
            $query->bind_param("s",$ans);
            $query->execute();
            $valaszok_ids[] = $query->insert_id; // valaszok_id
        }

        /* megoldások */



        $sql_sol = "INSERT INTO megoldasok (megoldas) VALUES (?)";

        $query = $conn->prepare($sql_sol);

        $megoldasok_ids = [];

        foreach ($solutions as $sol){
            $query->bind_param("s",$sol);
            $query->execute();
            $megoldasok_ids[] = $query->insert_id; // megoldasok_id
        }

        /* feladat */


        $sql_feladat = "INSERT INTO feladat (kat_id, kerdes) VALUES (?,?)";

        $query = $conn->prepare($sql_feladat);
        $query->bind_param("is",$cat, $question);
        $query->execute();
        $feladat_id = $query->insert_id; // feladat_id


        /* feladat_valasz */


        $sql_feladat_valasz = "INSERT INTO feladat_valasz (feladat_id, valasz_id) VALUES (?,?)";

        $query = $conn->prepare($sql_feladat_valasz);

        foreach($valaszok_ids as $valasz_id){
            $query->bind_param("ss",$feladat_id,$valasz_id);
            $query->execute();
        }


        /* feladat_megoldas */


        $sql_feladat_megoldas = "INSERT INTO feladat_megoldas (feladat_id, megoldas_id) VALUES (?,?)";

        $query = $conn->prepare($sql_feladat_megoldas);

        foreach($megoldasok_ids as $megoldas_id){
            $query->bind_param("ss",$feladat_id,$megoldas_id);
            $query->execute();

        }

        $_SESSION['success'] = "Az adatok bekerültek az adatbázisba!";
        header("Location: admin.php?dashboard");
        exit;
    }catch (Exception $e){
        $_SESSION['error'] = $e->getMessage();
    }

}