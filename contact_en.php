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
            header("Location: en.php?success=1");
            exit;
        }
    } else {
        echo '<script language="javascript">';
        echo 'alert("Please fill in all fields")';
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
    <title>Contact us</title>
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
    <h2 class="lbl1">Contact us</h2>
    <form id="contactForm" method="post" action="" class="form2">
        <label for="nimi2">Name:</label>
        <input type="text" name="nimi2" placeholder="Enter your name" required>

        <label for="email2">Email:</label>
        <input type="email" name="email2" placeholder="Enter your e-mail" required>

        <label for="telefon2">Phone number:</label>
        <input type="tel" name="telefon2" pattern="\+[0-9]+" placeholder="Enter the phone number starting with '+'" required>

        <label for="rabotniki">Workers:</label>
        <select name="rabotniki" class="select_modal">
            <option>Concrete work</option>
            <option>Electricians</option>
            <option>Handyman</option>
            <option>Reinforgers</option>
            <option>Carpenters</option>
            <option>Assemblers</option>
            <option>Welders</option>
            <option>Excavator operator</option>
        </select>

        <label for="rabotniki2">Number of employees:</label>
        <input type="number" name="rabotniki2" placeholder="Enter the desired number of employees"  required>

        <label for="address">Address:</label>
        <input type="text" name="address" placeholder="Enter your company address" required>

        <label for="firmi_code">Company code:</label>
        <input type="text" name="firmi_code" placeholder="Enter your company code" required>

        <label for="info2">More info:</label>
        <textarea name="info2" placeholder="More info"></textarea>

        <input type="submit" class="modal_sumbit" value="Send">

        <a href="en.php" class="back1">Return</a>
    </form>
</div>

</body>
</html>