<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/style/style.css">
    <script src="public/script/script.js"></script>
    <title>Informatika feladat gyűjtemény</title>
</head>
<body>
    <?php require "header/header.php"?>
    <div class="body">
    <h1 id="cat-title">Kategóriák</h1>
    <div id="category">
        <?php
        include("conn.php");
        global $conn;

        $sql = "SELECT kategoria FROM kategoria ORDER BY kategoria DESC";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                echo '<div class="category-element">'.$row['kategoria'].'</div>';
            }
        }
            ?>
    </div>
    </div>
    <?php require "footer/footer.php"?>
</body>
</html>