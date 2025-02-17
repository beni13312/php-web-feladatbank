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
    <link rel="stylesheet" href="../public/style/style.css">
    <script src="../public/script/script.js"></script>
    <title>Feladatbank</title>
</head>
<body>
<?php require "header/header.php"?>
    <div class="body">
        <form method="POST" action="auth.php">
            <input type="text" name="uname" id="admin-uname" placeholder="Felhasználó név">
            <input type="password" name="password" id="admin-password" placeholder="Jelszó">
            <input type="submit" name="submit" id="admin-submit" value="Bejelentkezés">
        </form>
        <div id="admin-message">
            <?php
            if(isset($_SESSION['error'])){
                echo $_SESSION['error'];
            }
            ?>
        </div>
    </div>
<?php require "footer/footer.php"?>

</body>
</html>