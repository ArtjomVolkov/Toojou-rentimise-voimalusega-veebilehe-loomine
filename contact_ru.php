<?php
global $yhendus;
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nimi2 = $_POST["nimi2"];
    $email2 = $_POST["email2"];
    $telefon2 = $_POST["telefon2"];
    $rabotniki = $_POST["rabotniki"];
    $rabotniki2 = $_POST["rabotniki2"];
    $address = $_POST["address"];
    $firmi_code = $_POST["firmi_code"];
    $info2 = isset($_POST["info2"]) ? $_POST["info2"] : "";

    // Проверка наличия данных
    if (!empty($nimi2) && !empty($email2) && !empty($telefon2) && !empty($rabotniki) && !empty($rabotniki2) && !empty($address) && !empty($firmi_code)) {
        // Вставка новой записи в базу данных
        $insertSql = "INSERT INTO rabotodatel (nimi2, email2, telefon2, rabotniki, rabotniki2 , address, firmi_code, info2) VALUES ('$nimi2', '$email2', '$telefon2', '$rabotniki' , '$rabotniki2', '$address', '$firmi_code', '$info2')";
        if ($yhendus->query($insertSql) === TRUE) {
            header("Location: ru.php?success=1");
            exit;
        }
    } else {
        echo '<script language="javascript">';
        echo 'alert("Пожалуйста, заполните все поля")';
        echo '</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link href="contact.css" rel="stylesheet"/>
    <link rel="icon" href="images/logo_LR.ico" type="image/x-icon">
    <title>Свяжитесь с нами</title>
</head>
<header>
    <div class="lang">
        <a href="contact_ru.php" class="lang2"><img src="images/ru_flag.png" class="lang_img">RU</a>
        <a href="contact.php" class="lang2"><img src="images/et_flag.png" class="lang_img">ET</a>
        <a href="contact_en.php" class="lang2"><img src="images/en_flag.png" class="lang_img">EN</a>
    </div>
</header>
<body>
<div class="container">
    <h2 class="lbl1">Свяжитесь с нами</h2>
    <form id="contactForm" method="post" action="" class="form2">
        <label for="nimi2">Имя:</label>
        <input type="text" name="nimi2" placeholder="Введите ваше имя" required>

        <label for="email2">Емайл:</label>
        <input type="email" name="email2" placeholder="Введите вашу почту" required>

        <label for="telefon2">Номер телефона:</label>
        <input type="tel" name="telefon2" pattern="\+[0-9]+" placeholder="Введите номер телефона, начиная с '+'" required>

        <label for="rabotniki">Рабочие:</label>
        <select name="rabotniki" class="select_modal">
            <option>Бетонные работы</option>
            <option>Электрики</option>
            <option>Разнорабочий</option>
            <option>Арматурщики</option>
            <option>Плотники</option>
            <option>Сборщики</option>
            <option>Сварщики</option>
            <option>Экскаваторщики</option>
        </select>

        <label for="rabotniki2">Количество работников:</label>
        <input type="number" name="rabotniki2" placeholder="Введите нужное количество работников"  required>

        <label for="address">Адрес:</label>
        <input type="text" name="address" placeholder="Введите ваш адрес фирмы" required>

        <label for="firmi_code">Код фирмы:</label>
        <input type="text" name="firmi_code" placeholder="Введите ваш код фирмы" required>

        <label for="info2">Дополнительная информация:</label>
        <textarea name="info2" placeholder="Дополнительная информация"></textarea>

        <input type="submit" class="modal_sumbit" value="Отправить">

        <a href="ru.php" class="back1">Вернуться</a>
    </form>
</div>

</body>
</html>