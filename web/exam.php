<?php
session_start();

if(isset($_GET["cat"])){
    $category = $_GET["cat"];
}else{
    header('location: index.php');
    exit;
}
if(!isset($_SESSION['category']) || $_SESSION['category'] !== $category){
    unset($_SESSION['feladat']);
    $_SESSION['category'] = $category;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/style/style.css">
    <script src="public/script/script.js"></script>
    <title>Feladatbank</title>
</head>
<body>
<?php require "header/header.php"?>
<?php include "conn.php"; global $conn; ?>
<div class="body">
    <div id="exam-feladat">
        <?php
        if(!isset($_SESSION['feladat']) ){
            $sql_id = "SELECT feladat.id
                            FROM feladat WHERE feladat.kat_id=? 
                            ORDER BY feladat.id ASC LIMIT 1";
            $query = $conn->prepare($sql_id);
            $query->bind_param("i", $category);
            $query->execute();
            $row = $query->get_result()->fetch_assoc();
            $_SESSION['feladat'] = $row['id'];
            $_SESSION['feladat_index'] = 1;
        }?>
        <div id="exam-kerdes">
        <?php
            $sql_kerdes = "SELECT feladat.kerdes
                            FROM feladat WHERE feladat.id = ? AND feladat.kat_id=?";
            $query = $conn->prepare($sql_kerdes);
            $query->bind_param("ii", $_SESSION['feladat'],$category);
            $query->execute();
            $row= $query->get_result()->fetch_assoc();

            echo $row['kerdes'];
            ?>
        </div>
        <div id="exam-szamlalo">
             <?php

             ?>
        </div>
        <div id="exam-answers">
            <form id="exam-form" action="check_ans.php" method="post">
                <div class="exam-ans-one">
                    <div class="exam-ans" id="x1"><input type="radio" name="ans">x</div>
                    <div class="exam-ans" id="x2"><input type="radio" name="ans">x</div>
                    <div class="exam-ans" id="x3"><input type="radio" name="ans">x</div>
                </div>
                <div class="exam-ans-more">
                    <div class="exam-ans" id="x1"><input type="checkbox" name="ans">x</div>
                    <div class="exam-ans" id="x2"><input type="checkbox" name="ans">x</div>
                    <div class="exam-ans" id="x3"><input type="checkbox" name="ans">x</div>
                </div>
                <input id="exam-check" type="submit" name="exam-submit" value="Ellenörzés">
            </form>
        </div>
    </div>
</div>

<?php require "footer/footer.php"?>

</body>
</html>