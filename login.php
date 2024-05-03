<?php
session_start();
global $yhendus;
include("connect.php");

//Проверка, на заполненые поля
if (!empty($_POST['sisselogimine']) && !empty($_POST['parool'])) {
    global $yhendus;

    $sisselogimine = $_POST["sisselogimine"];
    $parool = $_POST["parool"];

    $sool = 'taiestisuvalinetekst';
    $kryp = crypt($parool, $sool);

    $kask = $yhendus->prepare("SELECT sisselogimine, onAdmin FROM admins WHERE sisselogimine=? AND parool=?");
    $kask->bind_param("ss", $sisselogimine, $kryp);
    $kask->bind_result($sisselogimine, $onAdmin);
    $kask->execute();

    if ($kask->fetch()) {
        $_SESSION['onAdmin'] = $onAdmin;
        if ($onAdmin == 1) {
            header("Location: admin.php");
            exit;
        } else {
            echo '<script language="javascript">';
            echo 'alert("Неверное имя пользователя или пароль")';
            echo '</script>';
        }
    } else {
        echo '<script language="javascript">';
        echo 'alert("Неверное имя пользователя или пароль")';
        echo '</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link href="login_form.css" rel="stylesheet"/>
    <script src="script.js"></script>
    <title>Authorization LRQuality</title>
    <link rel="icon" href="images/logo_LR.ico" type="image/x-icon">
</head>
<body>
    <div class="info_login">
        <form id="loginForm" class="login-form" method="post" action="">
            <h2>Authorization</h2>
            <div class="input-group">
                <label for="sisselogimine">Login:</label>
                <input type="text" id="sisselogimine" name="sisselogimine" required>
            </div>
            <div class="input-group">
                <label for="parool">Password:</label>
                <input type="password" id="parool" name="parool" required>
            </div>
            <div class="input-group">
                <button type="submit">Sumbit</button>
            </div>
            <a href="ru.php" class="button_back">Back</a>
        </form>
    </div>
<body>



<?php
// Закрытие соединения с базой данных
$yhendus->close();
?>

