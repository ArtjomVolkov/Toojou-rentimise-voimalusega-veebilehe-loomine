<?php
session_start();
global $yhendus;
include("connect.php");
require("abifunktsioonid.php");

function isAdmin(){
    return isset($_SESSION['onAdmin'])&&$_SESSION['onAdmin'];
}

$category = $_GET['category'] ?? ''; // Получаем выбранную категорию из параметров GET или пустую строку, если категория не выбрана

// Подготавливаем запрос на получение данных принятых пользователей с учетом выбранной категории
if (!empty($category)) {
    $kask = $yhendus->prepare("SELECT id, nimi, perekonnanimi FROM users WHERE accept = 1 AND category = ?");
    $kask->bind_param("s", $category);
} else {
    $kask = $yhendus->prepare("SELECT id, nimi, perekonnanimi FROM users WHERE accept = 1");
}

$kask->execute();
$kask->bind_result($user_id, $nimi, $perenimi);

$totalUsers = 0; // Счетчик общего числа рабочих
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="info.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        document.addEventListener("DOMContentLoaded", function() {
            var sliderbarButton = document.querySelector(".menu");
            var sidebar = document.querySelector(".sidebar");
            var menuIcon = document.querySelector(".menu-icon");

            sliderbarButton.addEventListener("click", function() {
                sidebar.classList.toggle("sidebar-open");
                if (sidebar.classList.contains("sidebar-open")) {
                    menuIcon.src = "images/close_menu.png";
                } else {
                    menuIcon.src = "images/menu.png";
                }
            });
        });
    </script>
    <title>Information about employees</title>
    <link rel="icon" href="images/logo_LR.ico" type="image/x-icon">
</head>
<body>
<div class="container">
    <div class="lang_info">
        <img src="images/ru_flag.png" width="20" height="15"> <a href="info_ru.php">RU</a>
        <img src="images/en_flag.png" width="20" height="15"> <a href="info_en.php">EN</a>
        <img src="images/et_flag.png" width="20" height="15"> <a href="info.php">EE</a>
        <a href="login.php" class="admin_btn">Log in</a>
        <a href="et.php" class="tagasi_btn">Back to</a>
    </div>
    <button class="menu">
        <img src="images/menu.png" class="menu-icon">
    </button>
    <div class="sidebar">
        <a href="login.php">Log in</a>
        <a href="en.php">Back to</a>
        <label class="sidebar_lbl">Language selection</label>
        <a href="info_ru.php" class="lang2"><img src="images/ru_flag.png" class="sidebar_lang">RU</a>
        <a href="info.php" class="lang2"><img src="images/et_flag.png" class="sidebar_lang">EE</a>
        <a href="info_en.php" class="lang2"><img src="images/en_flag.png" class="sidebar_lang">EN</a>
    </div>
    <h1 class="header_txt">Information about employees</h1>
    <form method="get" action="" class="form1">
        <label for="category" class="lbl_form">Select a category:</label>
        <select name="category" id="category" class="form_select">
            <option value="0">All categories</option>
            <option value="1">Concrete works</option>
            <option value="2">Electricians</option>
            <option value="3">Contact</option>
            <option value="4">Boosters</option>
            <option value="5">Carpets</option>
            <option value="6">Assembler</option>
            <option value="7">Welders</option>
            <option value="8">Excavator operator</option>
        </select>
        <input type="submit" value="Search" class="form_sumbit">
    </form>
    <!--<?php
    while ($kask->fetch()) {
        $totalUsers++;
        ?>
        <div class="employee-card">
            <h2>Имя: <?php echo $nimi; ?></h2>
            <h2>Фамилия: <?php echo $perenimi; ?></h2>
        </div>
    <?php }
    $kask->close();
    ?>-->
    <h3 class="lbl_info">
        <?php
        if ($totalUsers <= 0) {
            echo "There are no available workers";
        } else {
            echo "Total number of available workers: " . $totalUsers;
        }
        ?>
    </h3>
    <button class="btn_contact" onclick="window.location.href='contact_en.php'">Write a letter</button>
</div>
</body>
<footer>
    <div class="footer-content">
        <div class="contact-info">
            <div>
                <img src="images/location.png" class="img_footer" alt="Эстония,Таллинн" width="20" height="20">
                <label>Estonia, Tallinn</label>
            </div>
            <div>
                <img src="images/email.png" class="img_footer" width="20" height="20">
                <label>info@LRQuality.ee</label>
            </div>
            <div>
                <img src="images/phone.png" class="img_footer" width="20" height="20">
                <label>+372 55555555</label>
            </div>
        </div>
    </div>
    <div class="copyright">&copy; 2024 LRQuality. All Rights Reserved.</div>
</footer>
</html>

<?php
// Закрываем соединение с базой данных
$yhendus->close();
?>
