<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if(!isset($_SESSION['authorized'])){
        header('Location: admin.php');
    }

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
    <title>Admin felület</title>
</head>
<body>
<?php require "header/header.php"?>
<div class="body">
    <div id="admin-flexbox">
        <h1>Admin felület</h1>
        <div id="admin-logout">
            <form method="POST" action="logout.php">
                <input type="submit" name="submit" value="Kijelentkezés" id="admin-submit-logout">
            </form>
        </div>
    </div>
    <div id="admin-dashboard">

    </div>

</div>
<?php require "footer/footer.php"?>
</body>
</html>
