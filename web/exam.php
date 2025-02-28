<?php
if(isset($_GET["cat"])){
    $category = $_GET["cat"];
}else{
    header('location: index.php');
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
        <div id="exam-kerdes">
            <?php
            $sql = "SELECT kerdes FROM feladat where kat_id = ?";
            $result = $conn->prepare($sql);
            $result->bind_param("i", $category);
            $result->execute();
            $row = $result->get_result()->fetch_assoc();
            echo $row['kerdes'];
            ?>
        </div>
        <div id="exam-szamlalo">

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