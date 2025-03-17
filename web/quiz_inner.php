<?php
session_start();


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
<?php
include "conn.php";
global $conn;

$category = $_SESSION['category'];

?>
<div id="quiz-feladat">
<div id="quiz-kerdes">
    <?php
    if(!isset($_SESSION['feladat'])) {$_SESSION['feladat'] = null;} // ha nincsen feladat session akkor létrehozunk

    $sql_kerdes = "SELECT feladat.kerdes
                            FROM feladat WHERE feladat.id = ? AND feladat.kat_id=?";
    $query = $conn->prepare($sql_kerdes);
    $query->bind_param("ii", $_SESSION['feladat'],$category);
    $query->execute();
    $result =  $query->get_result();

    if(mysqli_num_rows($result) === 0){ // ha nem létezik az id az adatbázisban
        $sql_id = "SELECT feladat.id
                            FROM feladat WHERE feladat.kat_id=? 
                            ORDER BY feladat.id ASC LIMIT 1"; // a legalacsonyabb feladat id kezdésnek
        $query = $conn->prepare($sql_id);
        $query->bind_param("i", $category);
        $query->execute();
        $result = $query->get_result();

        if(mysqli_num_rows($result) === 0){
            echo 'Nem található feladat ebben a kategóriában :('; // ha nincsen egyáltalán a feladat az adott kategóriában
            exit;
        }
        $row = $result->fetch_assoc();
        $_SESSION['feladat'] = $row['id']; // feladat id
        $_SESSION['feladat_index'] = 1; // feladat száma

        // ujra lefutatjuk az SQL parancsot
        $query = $conn->prepare($sql_kerdes);
        $query->bind_param("ii", $_SESSION['feladat'],$category);
        $query->execute();
        $result = $query->get_result();

        $row = $result->fetch_assoc();
        echo $row['kerdes']; // kérdés kiíratása


    }else {
        $row = $result->fetch_assoc();
        echo $row['kerdes']; // kérdés kiíratása
    }
    ?>
</div>


<div id="quiz-szamlalo">
    <?php
    $sql_szam = "SELECT COUNT(feladat.id) AS 'szam'
                            FROM feladat WHERE feladat.kat_id=?";
    $query = $conn->prepare($sql_szam);
    $query->bind_param("i", $category);
    $query->execute();
    $row= $query->get_result()->fetch_assoc();

    echo $_SESSION['feladat_index']."/".$row['szam']; // feladatszámláló pl.: 1/3
    ?>
</div>


<div id="quiz-answers">
    <?php
    $sql_ans = "SELECT megoldasok.id
                        FROM feladat, megoldasok, feladat_megoldas
                        WHERE feladat.kat_id=? AND
                        feladat.id = ? AND 
                        feladat.id = feladat_megoldas.feladat_id AND
                        feladat_megoldas.megoldas_id = megoldasok.id";

    $query = $conn->prepare($sql_ans);
    $query->bind_param("ii", $category,$_SESSION['feladat']);
    $query->execute();
    $result = $query->get_result();
    $multiple_sol = $result->num_rows > 1; // ha több mint egy megoldas van

    $sql_ans2 = "SELECT valaszok.id, valaszok.valasz
                         FROM feladat, valaszok, feladat_valasz
                         WHERE feladat.kat_id = ? AND
                               feladat.id = ? AND
                               feladat_valasz.feladat_id = feladat.id AND
                               feladat_valasz.valasz_id = valaszok.id"; // válaszok

    $query = $conn->prepare($sql_ans2);
    $query->bind_param("ii", $category,$_SESSION['feladat']);
    $query->execute();
    $result = $query->get_result();

    ?>


    <form class="quiz-form" action="check_ans.php" method="POST">
        <?php
        if($multiple_sol){ // ha több a megoldás
            echo '<div class="quiz-ans-more">';
            echo '<div id="quiz-ans-title">Több megoldás</div>';
            while($row = $result->fetch_assoc()){
                echo '<div class="quiz-ans"><div class="quiz-ans-ch"><input type="checkbox" name="ans-' .$row['id'].'" value="'.$row['id'].'"></div><div class="quiz-ans-text">'.htmlspecialchars($row['valasz'], ENT_QUOTES,'UTF-8').'</div></div>';
            }
            echo '</div>';
        }else{ // ha egy megoldás van
            echo '<div class="quiz-ans-one">';
            while($row = $result->fetch_assoc()){
                echo '<div class="quiz-ans"><div class="quiz-ans-ch"><input type="radio" name="ans" value="'.$row['id'].'"></div><div class="quiz-ans-text">'.htmlspecialchars($row['valasz'], ENT_QUOTES,'UTF-8').'</div></div>';
            }
            echo '</div>';
        }
        ?>
        <input id="quiz-check" type="submit" name="quiz-submit" value="Ellenőrzés">
    </form>
    <form class="quiz-form" action="next_previous.php" method="POST">
        <?php
        if($_SESSION['feladat_index'] > 1){ // ha nagyobb a feladat index 1-nél vagyis nem az első feladat
            echo '<input id="quiz-before" type="submit" name="quiz-before" value="Elöző">';
        }
        ?>
        <input id="quiz-check" type="submit" name="quiz-advance" value="Tovább">
    </form>
</div>
</div>
</body>
</html>