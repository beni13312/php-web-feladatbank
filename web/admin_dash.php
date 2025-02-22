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
    <h1>Admin felület</h1>
    <div>
        <form method="POST" action="logout.php">
            <input type="submit" name="submit" value="Kijelentkezés" id="admin-logout">
        </form>
    </div>

</div>
<?php require "footer/footer.php"?>
</body>
</html>