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
    <div id="exam-feladat">
        <div id="exam-kerdes">

        </div>
        <div id="exam-szamlalo">

        </div>
        <div id="exam-valaszok">
            <form id="exam-form" action="check_ans.php" method="post">
                <div class="exam-valasz-egy">
                    <div class="exam-ans"><input type="radio" name="ans">x</div>
                    <div class="exam-ans"><input type="radio" name="ans">x</div>
                    <div class="exam-ans"><input type="radio" name="ans">x</div>
                </div>
                <div class="exam-valasz-tobb">
                    <div class="exam-ans"><input type="checkbox" name="ans">x</div>
                    <div class="exam-ans"><input type="checkbox" name="ans">x</div>
                    <div class="exam-ans"><input type="checkbox" name="ans">x</div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require "footer/footer.php"?>

</body>
</html>