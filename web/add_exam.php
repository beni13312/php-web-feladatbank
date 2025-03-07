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

        $params = "";
        $bind_type = "";

        for($value = 0; $value < sizeof($answers); $value++){
            $params .= "(?),";
            $bind_type .= "s";
        }
        $params = rtrim($params, ",");

        $sql_ans = "INSERT INTO valaszok (valasz) VALUES ".$params;

        $query = $conn->prepare($sql_ans);
        $query->bind_param($bind_type,...$answers); // válaszok elhelyezése
        $query->execute();

        unset($params);
        unset($bind_type);

        /* megoldások */

        $params = "";
        $bind_type = "";

        for($value = 0; $value < sizeof($solutions); $value++){
            $params .= "(?),";
            $bind_type .= "s";
        }

        $params = rtrim($params, ",");

        $sql_sol = "INSERT INTO megoldasok (megoldas) VALUES ".$params;


        $query = $conn->prepare($sql_sol);
        $query->bind_param($bind_type,...$solutions); // válaszok elhelyezése
        $query->execute();

        unset($params);
        unset($bind_type);

        /* feladat */


        $sql_feladat = "INSERT INTO feladat (kat_id, kerdes) VALUES ((?),(?))";

        $query = $conn->prepare($sql_feladat);
        $query->bind_param("is",$cat, $question); // válaszok elhelyezése
        $query->execute();


        /* feladat_valasz */

        $sql_pattern = "(
                        (SELECT feladat.id FROM feladat WHERE kerdes = ?),
                        (SELECT valaszok.id FROM valaszok WHERE valasz = ?)
                        )";
        $params = "";
        $bind_type = "";
        $question_ans = array();

        foreach($answers as $ans){
            $params .= $sql_pattern.",";
            $bind_type .= "ss";
            $question_ans[]= $question;
            $question_ans[]= $ans;
        }
        $params = rtrim($params,",");

        $sql_feladat_valasz = "INSERT INTO feladat_valasz (feladat_id, valasz_id) VALUES".$sql_pattern;

        $query = $conn->prepare($sql_feladat_valasz);
        $query->bind_param($bind_type,...$question_ans);
        $query->execute();

        unset($params);
        unset($bind_type);
        unset($sql_pattern);

        /* feladat_megoldas */

        $sql_pattern = "(
                        (SELECT feladat.id FROM feladat WHERE kerdes = ?),
                        (SELECT megoldasok.id FROM megoldasok WHERE megoldas = ?)
                        )";
        $params = "";
        $bind_type = "";
        $question_solution = array();

        foreach($solutions as $sol){
            $params .= $sql_pattern.",";
            $bind_type .= "ss";
            $question_solution[]= $question;
            $question_solution[]= $sol;
        }
        $params = rtrim($params,",");

        $sql_feladat_megoldas = "INSERT INTO feladat_megoldas (feladat_id, megoldas_id) VALUES".$sql_pattern;

        $query = $conn->prepare($sql_feladat_megoldas);
        $query->bind_param($bind_type,...$question_solution);
        $query->execute();

        unset($params);
        unset($bind_type);

        $_SESSION['success'] = "Az adatok bekerültek az adatbázisba!";
        header("Location: admin.php?dashboard");
        exit;
    }catch (Exception $e){
        $_SESSION['error'] = $e->getMessage();
    }

}