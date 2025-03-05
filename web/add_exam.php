<?php
session_start();

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    die("Hiba: rossz kérési protokol!");
}

$cat = $_POST['category'];
$question = $_POST['exam-question'];
$answers = array();
$solutions = array();

// válaszok hozzáadása tömbhöz
for($ans = 1; $ans<=10; $ans++){
    if(isset($_POST['ans-'.$ans])){
        $answers[] = $_POST['ans-' . $ans];
    }
}

// megoldások hozzáadása tömbhöz
for($sol = 1; $sol<=10; $ans++){
    if(isset($_POST['isSol-'.$ans])){
        $solutions[] = $_POST['isSol-'.$ans];
    }
}
if($cat || $question || sizeof($answers) < 2 || sizeof($solutions) < 1){
    $_SESSION['error'] = "Nem lehet egy mező sem üres!!";
    header("Location: admin.php?dashboard");
    exit;
}