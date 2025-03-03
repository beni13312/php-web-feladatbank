<?php
session_start();

if(isset($_GET["cat"])){
    $category = $_GET["cat"];
}else{
    header('location: index.php');
    exit;
}
if(!isset($_SESSION['category']) || $_SESSION['category'] !== $category){ // ha más kat_id akkor töröljük a session-t, mivel a feladat.id külömböző
    unset($_SESSION['feladat']);
    unset($_SESSION['feladat_index']);

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
        if(!isset($_SESSION['feladat']) ){ // ha nincsen feladat session akkor létrehozunk egyet, a kezdőérékte a táblából a legkisebb id
            $sql_id = "SELECT feladat.id
                            FROM feladat WHERE feladat.kat_id=? 
                            ORDER BY feladat.id ASC LIMIT 1";
            $query = $conn->prepare($sql_id);
            $query->bind_param("i", $category);
            $query->execute();
            $row = $query->get_result()->fetch_assoc();
            $_SESSION['feladat'] = $row['id']; // feladat id
            $_SESSION['feladat_index'] = 1; // feladat száma
        }?>
        <div id="exam-kerdes">
        <?php
            $sql_kerdes = "SELECT feladat.kerdes
                            FROM feladat WHERE feladat.id = ? AND feladat.kat_id=?";
            $query = $conn->prepare($sql_kerdes);
            $query->bind_param("ii", $_SESSION['feladat'],$category);
            $query->execute();
            $row= $query->get_result()->fetch_assoc();

            echo $row['kerdes']; // kérdés kiíratása
            ?>
        </div>
        <div id="exam-szamlalo">
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
        <div id="exam-answers">
            <?php
            $sql_ans = "select megoldasok.megoldas
                        from feladat, megoldasok, feladat_megoldas
                        where feladat.kat_id=? and
                        feladat.id = ? and 
                        feladat.id = feladat_megoldas.feladat_id and
                        feladat_megoldas.megoldas_id = megoldas.id";
            $query = $conn->prepare($sql_ans);
            $query->bind_param("ii", $category,$_SESSION['feladat']);
            $query->execute();
            $result= $query->get_result();
            
            $multiple_sol = false;
            while($row= $result->fetch_assoc()){

            }

            ?>

            <form id="exam-form" action="check_ans.php" method="POST">
                <div class="exam-ans-one">
                    <div class="exam-ans" id="x1"><input type="radio" name="ans">x</div>
                    <div class="exam-ans" id="x2"><input type="radio" name="ans">x</div>
                    <div class="exam-ans" id="x3"><input type="radio" name="ans">x</div>
                </div>
                <div class="exam-ans-more">
                    <div id="exam-ans-title">Több megoldás</div>
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