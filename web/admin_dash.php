<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['authorized'])){
    header('Location: admin.php');
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
    <title>Admin felület</title>
</head>
<body>
<?php require "header/header.php"?>
<?php include "conn.php"; global $conn; ?>
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
        <div id="admindash-exams" style="display: none;">
            <div class="admindash-exam">
                <div class="admindash-exam-question"></div>
                <div class="admindash-exam-ans"></div>
                <div class="admindash-exam-sol"></div>
            </div>
        </div>
        <div id="admindash-add">
            <form action="add_exam.php" method="post" id="admindash-form">
                <div class="admindash-cat-container">
                    <?php $sql_cat= "SELECT kategoria.id, kategoria.kategoria FROM kategoria order by kategoria.id ASC";
                    $query = mysqli_query($conn,$sql_cat);

                    echo '<select name="category" id="admindash-cat">';
                    echo '<option>Kategória</option>';
                    if(mysqli_num_rows($query) > 0){
                        while($row = mysqli_fetch_assoc($query)){
                            echo '<option value="'.$row['id'].'">'.$row['kategoria'].'</option>';
                        }
                    }
                    echo '</select>';
                    ?>
                </div>
                <div class="admindash-question">
                    <input type="text" name="exam-question" id="admindash-question" placeholder="Kérdés">
                </div>

                <div id="admindash-anss">
                    <div id="admindash-ans-n">
                        <div class="admindash-ans">
                            <input type="text" id="ans-1" name="ans-1" placeholder="Válasz1">
                            <input type="checkbox" class="admindash-ans-sol" name="isSol-1" id="isSol-1">
                            <label for="isSol-1">Megoldás</label>
                        </div>
                        <div class="admindash-ans">
                            <input type="text" id="ans-2" name="ans-2" placeholder="Válasz2">
                            <input type="checkbox" class="admindash-ans-sol" name="isSol-2" id="isSol-2">
                            <label for="isSol-2">Megoldás</label>
                        </div>
                    </div>
                    <div id="admindash-ans-addrm">
                        <input type="button" id="admindash-ans-add" name="ans-add" value="Hozzáadás">
                        <input type="button" id="admindash-ans-rm" name="ans-rm" value="Törlés">
                    </div>
                </div>
                <input type="submit" name="exam-submit" id="admindash-submit" placeholder="Hozzáadás">
                <div class="error-message">
                    <?php
                    if(isset($_SESSION['error'])){
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                    ?>
                </div>
                <div class="success-message">
                    <?php
                    if(isset($_SESSION['success'])){
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    }
                    ?>
                </div>
            </form>
        </div>

        </div>
    </div>

</div>
<?php require "footer/footer.php"?>
</body>
</html>
