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
            header("Location: et.php?success=1");
            exit;
        }
    } else {
        echo '<script language="javascript">';
        echo 'alert("Palun täitke kõik väljad")';
        echo '</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link href="contact.css" rel="stylesheet"/>
    <link rel="icon" href="images/logo_LR.ico" type="image/x-icon">
    <title>Võtke meiega ühendust</title>
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
    <h2 class="lbl1">Võtke meiega ühendust</h2>
    <form id="contactForm" method="post" action="" class="form2">
        <label for="nimi2">Nimi:</label>
        <input type="text" name="nimi2" placeholder="Sisestage oma nimi" required>

        <label for="email2">E-post:</label>
        <input type="email" name="email2" placeholder="Sisestage oma e-posti aadress" required>

        <label for="telefon2">Telefoninumber:</label>
        <input type="tel" name="telefon2" pattern="\+[0-9]+" placeholder="Sisestage telefoninumber, mis algab tähega '+'." required>

        <label for="rabotniki">Töötajad:</label>
        <select name="rabotniki" class="select_modal">
            <option>Betoonitööd</option>
            <option>Elektrikud</option>
            <option>Tööline</option>
            <option>Tugevdajad</option>
            <option>Puusepad</option>
            <option>Assemblerid</option>
            <option>Keevitajad</option>
            <option>Ekskavaatori operaator</option>
        </select>

        <label for="rabotniki2">Töötajate arv:</label>
        <input type="number" name="rabotniki2" placeholder="Sisestage nõutav töötajate arv"  required>

        <label for="address">Aadress:</label>
        <input type="text" name="address" placeholder="Sisestage oma ettevõtte aadress" required>

        <label for="firmi_code">Ettevõtte kood:</label>
        <input type="text" name="firmi_code" placeholder="Sisestage oma ettevõtte kood" required>

        <label for="info2">Lisainfo:</label>
        <textarea name="info2" placeholder="Lisainfo"></textarea>

        <input type="submit" class="modal_sumbit" value="Saada">

        <a href="et.php" class="back1">Tagasi</a>
    </form>
</div>

</body>
</html>