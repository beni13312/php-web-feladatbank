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
if($cat || $question || sizeof($answers) < 2 || sizeof($solutions) < 1){ // ellenörzés
    $_SESSION['error'] = "Nem lehet egy mező sem üres!!: "."cat:".$cat."question: ".$question."arrays: ".sizeof($answers).":".sizeof($solutions);
    header("Location: admin.php?dashboard");
    exit;


}else{
    try{
         // adatok beírása
        include 'conn.php';
        global $conn;


        /* válaszok */

        $params = "";
        $bind_type = "";

        for($value = 0; $value < sizeof($answers); $value++){
            $params .= "(?)";
            $bind_type .= "s";
        }
        $sql_ans = "INSERT INTO valaszok (valasz) VALUES ".$params;

        $answers_refs = [];

        foreach($answers as $ans){
            $answers_refs[] = &$ans; // hozzáadás memória címmel
        }

        $query = $conn->prepare($sql_ans);
        $query->bind_param($bind_type,...$answers_refs); // válaszok elhelyezése
        $query->execute();

        unset($params);
        unset($bind_type);
        unset($answers_refs);

        /* megoldások */

        $params = "";
        $bind_type = "";

        for($value = 0; $value < sizeof($solutions); $value++){
            $params .= "(?)";
            $bind_type .= "s";
        }
        $sql_sol = "INSERT INTO megoldasok (megoldas) VALUES ".$params;

        $solution_refs = [];

        foreach($solutions as $sol){
            $solution_refs[] = &$sol; // hozzáadás memória címmel
        }

        $query = $conn->prepare($sql_sol);
        $query->bind_param($bind_type,...$solution_refs); // válaszok elhelyezése
        $query->execute();

        unset($params);
        unset($bind_type);
        unset($solution_refs);

        /* feladat */


        $sql_feladat = "INSERT INTO feladat (kat_id, kerdes) VALUES ((?),(?))";

        $query = $conn->prepare($sql_feladat);
        $query->bind_param("is",$cat, $question); // válaszok elhelyezése
        $query->execute();


        /* feladat_valasz */


        $sql_feladat_valasz = "INSERT INTO feladat_valasz (feladat_id, valasz_id) VALUES
                        (
                        (SELECT feladat.id FROM feladat WHERE kerdes = ?),
                        (SELECT valaszok.id FROM valaszok WHERE valasz = @valasz1)
                        ),                        (
                        (SELECT feladat.id FROM feladat WHERE kerdes = ?),
                        (SELECT valaszok.id FROM valaszok WHERE valasz = @valasz2)
                        ),                        (
                        (SELECT feladat.id FROM feladat WHERE kerdes = ?),
                        (SELECT valaszok.id FROM valaszok WHERE valasz = @valasz3)
                        )";

        $query = $conn->prepare($sql_feladat_valasz);
        $query->bind_param("is",$cat, $question); // válaszok elhelyezése
        $query->execute();


    }catch (Exception $e){
        $_SESSION['error'] = $e->getMessage();
    }

}