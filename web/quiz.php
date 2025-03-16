<?php
session_start();

if(isset($_GET["cat"]) && ctype_digit($_GET["cat"])){ // ha integer, egész szám
    $_SESSION['category'] = $_GET["cat"];
}else{
    header('location: index.php');
    exit;
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
<div class="body">
    <iframe src="quiz_inner.php" width="100%" height="500px" style="border: none" id="quiz-feladat"></iframe> <!-- külön HTML betöltése,
                                                                                                             hogy ne az egész weboldal frissűljön újra -->
</div>

<?php require "footer/footer.php"?>

</body>
</html>