<?php
global $yhendus;
include("connect.php");

// Запрос к базе данных для получения списка услуг
$sql = "SELECT * FROM users";
$result = $yhendus->query($sql);

// Проверяем, было ли отправлено сообщение об успешной отправке
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<script language="javascript">';
    echo 'alert("Teie taotlus on saadetud!")';
    echo '</script>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the first form is submitted
    if (isset($_POST["nimi"]) && isset($_POST["perekonnanimi"]) && isset($_POST["email"]) && isset($_POST["telefon"]) && isset($_POST["dates"]) && isset($_POST["haridus"])) {
        $nimi_user = $_POST["nimi"];
        $perenimi_user = $_POST["perekonnanimi"];
        $email_user = $_POST["email"];
        $telefon_user = $_POST["telefon"];
        $dates_user = $_POST["dates"];
        $haridus_user = $_POST["haridus"];

        // Проверка наличия данных
        if (!empty($nimi_user) && !empty($perenimi_user) && !empty($email_user) && !empty($telefon_user) && !empty($dates_user) && !empty($haridus_user)) {
            if (isset($_FILES["image_data"]) && $_FILES["image_data"]["error"] == 0) {
                // Обработка изображения
                $image_data = addslashes(file_get_contents($_FILES["image_data"]["tmp_name"]));
                // Insert new record into the database
                $insertSql = "INSERT INTO users (nimi, perekonnanimi, email, telefon, dates, haridus, image_data) VALUES ('$nimi_user', '$perenimi_user', '$email_user', '$telefon_user','$dates_user','$haridus_user','$image_data')";
                if ($yhendus->query($insertSql) === TRUE) {
                    echo '<script language="javascript">';
                    echo 'alert("Teie taotlus on saadetud!")';
                    echo '</script>';
                }

            } else {
                // Insert new record into the database
                $insertSql = "INSERT INTO users (nimi, perekonnanimi, email, telefon, dates, haridus) VALUES ('$nimi_user', '$perenimi_user', '$email_user', '$telefon_user','$dates_user','$haridus_user')";
                if ($yhendus->query($insertSql) === TRUE) {
                    echo '<script language="javascript">';
                    echo 'alert("Teie taotlus on saadetud!")';
                    echo '</script>';
                }
            }}else {
            echo '<script language="javascript">';
            echo 'alert("Palun täitke kõik väljad")';
            echo '</script>';
        }
    }

    // Check if the second form is submitted
    if (isset($_POST["nimi2"]) && isset($_POST["perekonnanimi2"]) && isset($_POST["email2"]) && isset($_POST["telefon2"])) {
        $nimi2 = $_POST["nimi2"];
        $perenimi2 = $_POST["perekonnanimi2"];
        $email2 = $_POST["email2"];
        $telefon2 = $_POST["telefon2"];
        $rabotniki = $_POST["rabotniki"];
        $address = $_POST["address"];
        $firmi_code = $_POST["firmi_code"];
        $info2 = isset($_POST["info2"]) ? $_POST["info2"] : "";

        // Check for data presence
        if (!empty($nimi2) && !empty($perenimi2) && !empty($email2) && !empty($telefon2) && !empty($rabotniki) && !empty($address) && !empty($firmi_code) && !empty($info2)) {
            // Insert new record into the database
            $insertSql = "INSERT INTO rabotodatel (nimi2, perekonnanimi2, email2, telefon2, rabotniki, address, firmi_code, info2) VALUES ('$nimi2', '$perenimi2', '$email2', '$telefon2', '$rabotniki', '$address', '$firmi_code', '$info2')";
            if ($yhendus->query($insertSql) === TRUE) {
                echo '<script language="javascript">';
                echo 'alert("Teie taotlus on saadetud!")';
                echo '</script>';
            }
        } else {
            echo '<script language="javascript">';
            echo 'alert("Palun täitke kõik väljad")';
            echo '</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link href="leht_css.css" rel="stylesheet"/>
    <script src="script.js"></script>
    <title>Tööjõu rentimine LRQuality</title>
    <link rel="icon" href="images/logo_LR.ico" type="image/x-icon">
</head>
<header>
    <img class="logo" src="images/logo_LR.png" width="80" onclick="varskLeht()">
    <h1 class="header_text">Tööjõu rentimine</h1>
    <div class="lang">
        <a href="info.php" class="tootajad">Töötajate nimekiri</a>
        <select id="language-select" onchange="changeLanguage(this.value)">
            <option value="et">
                <img src="images/et_flag.png" width="20" height="15"> EE
            </option>
            <option value="ru">
                <img src="images/ru_flag.png" width="20" height="15"> RU
            </option>
            <option value="en">
                <img src="images/en_flag.png" width="20" height="15"> EN
            </option>
        </select>
        <a href="login.php" class="login2">Sisselogimine</a>
    </div>
    <button class="menu">
        <img src="images/menu.png" class="menu-icon">
    </button>
</header>
<body>
<div class="sidebar">
    <a href="login.php" class="login">Sisselogimine</a>
    <a href="info.php" class="login">Töötajate nimekiri</a>
    <label class="sidebar_lbl">Keele valik</label>
    <a href="et.php" class="lang2"><img src="images/et_flag.png" class="sidebar_lang">EE</a>
    <a href="en.php" class="lang2"><img src="images/en_flag.png" class="sidebar_lang">EN</a>
    <a href="ru.php" class="lang2"><img src="images/ru_flag.png" class="sidebar_lang">RU</a>
</div>
<div class="info">
    <div class="info_text">
        <h1>Suurendage oma ettevõtte tõhusust meie tööjõu renditeenusega.</h1>
        <p>Kui te vajate ajutisi töötajaid, et kiirendada otsingut, tulla toime tippkoormuse või pikaajaliste projektidega, pakume paindlikku lahendust teie personalivajadustele.</p>
        <p>Meie personaliosakond pakub teile paindlikkust, mida vajate oma ettevõtte tõhusaks arendamiseks. Me aitame teil paindlikult toime tulla personaliprobleemidega, saavutada kulude kokkuhoidu ja ületada kohalikku personalipuudust. Meie tööjõu renditeenus on teie edu ja heaolu võti.</p>
    </div>
    <img class="image" src="images/person.jpg" alt="Personal">
</div>
<div class="contact">
    <div>
        <button class="open-modal" onclick="window.location.href='ametid.php'">Töötajate leidmine<img src="images/rabotnik.png" width="30" height="30"></button>
    </div>
    <!--<div>
        <button id="contactBtn1" class="open-modal">Töötajate leidmine<img src="images/rabotnik.png"></button>
    </div>-->
    <div>
        <button id="contactBtn2" class="open-modal2">Töö leidmine<img src="images/rabota.png"></button>
    </div>
</div>

<!--<div id="contactForm1" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form method="post" class="add" action="">
            <label for="nimi2">Nimi:</label>
            <input type="text" name="nimi2" placeholder="Sisestage oma nimi" required>

            <label for="perekonnanimi2">Perekonnanimi:</label>
            <input type="text" name="perekonnanimi2" placeholder="Sisestage oma perekonnanimi"  required>

            <label for="email2">Email:</label>
            <input type="email" name="email2" placeholder="Sisestage oma e-posti aadress" required>

            <label for="telefon2">Telefoninumber:</label>
            <input type="tel" name="telefon2" pattern="\+[0-9]+" placeholder="Sisestage telefoninumber, mis algab tähega '+'." required>

            <label for="rabotniki">Töötajad:</label>
            <select name="rabotniki" class="select_modal">
                <option>Betoonitööd</option>
                <option>Elektrikud</option>
                <option>Käsitööline</option>
                <option>Tugevdajad</option>
                <option>Puusepad</option>
                <option>Assemblerid</option>
                <option>Keevitajad</option>
                <option>Muud</option>
            </select>

            <label for="address">Aadress:</label>
            <input type="text" name="address" placeholder="Sisestage oma ettevõtte aadress" required>

            <label for="firmi_code">Ettevõtte kood:</label>
            <input type="text" name="firmi_code" placeholder="Sisestage oma ettevõtte kood" required>

            <label for="info2">Täiendav teave:</label>
            <input type="text" name="info2" placeholder="Rohkem infot" required>

            <input type="submit" value="Saada">
        </form>
    </div>
</div>-->

<div id="contactForm2" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form method="post" class="add" action="" enctype="multipart/form-data">
            <label for="nimi">Nimi:</label>
            <input type="text" name="nimi" placeholder="Sisestage oma nimi" required>

            <label for="perekonnanimi">Perekonnanimi:</label>
            <input type="text" name="perekonnanimi" placeholder="Sisestage oma perekonnanimi"  required>

            <label for="email">E-post:</label>
            <input type="email" name="email" placeholder="Sisestage oma e-posti aadress" required>

            <label for="telefon">Telefoninumber:</label>
            <input type="tel" name="telefon" pattern="\+[0-9]+" placeholder="Sisestage telefoninumber, mis algab tähega "+"." required>

            <label for="dates">Sünniaeg:</label>
            <input type="date" name="dates" required>

            <label for="haridus">Haridus:</label>
            <select name="haridus" class="select_modal">
                <option>Põhiharidus</option>
                <option>Kutseharidus</option>
                <option>Täiendav haridus</option>
            </select>

            <label for="image_data">Laadige oma foto üles:</label>
            <input type="file" class="modal_imagedata" name="image_data" accept="image/*">

            <input type="submit" class="modal_sumbit" value="Saada">
        </form>
    </div>
</div>

<div class="steps">
    <div class="step">
        <h2>Kandidaatide profiilide koostamine</h2>
        <p>Koos määrame kindlaks töötajate profiilid, oskuste ja kogemuste tasemed ning ametikoha palgavahemikud.</p>
    </div>
    <div class="step">
        <h2>Kandidaatide valik</h2>
        <p>Otsime sobivaid kandidaate oma võrgustikest ja kasutame oma digitaalseid vahendeid. Me intervjueerime kandidaate ja jälgime kandidaatide pädevust ja huvi töö vastu.</p>
    </div>
    <div class="step">
        <h2>Intervjuu</h2>
        <p>Me esitame teile nimekirja parimatest kandidaatidest, kellega saate vestelda, või kui soovite, siis korraldame kogu intervjuu protsessi teie eest.</p>
    </div>
    <div class="step">
        <h2>Töötaja tööle asumine</h2>
        <p>Kui oleme leidnud sobivad kandidaadid, allkirjastame töölepingud ja te saate alustada tööd oma uue meeskonnaliikmega..</p>
    </div>
</div>
<div class="info2">
    <div class="info_text2">
        <h2>Kulutõhus<img src="images/galka.png" class="info_img2"></h2>
        <p>Pakume kuluefektiivset lahendust, mis võimaldab teil kulusid optimeerida, makstes teenuste eest ainult siis, kui neid tegelikult kasutatakse. See vabastab teie eelarve ebavajalikest kuludest ja võimaldab teil suunata oma ressursid muudele strateegiliselt olulistele ülesannetele.</p>
        <h2>Paindlik ja skaleeritav<img src="images/galka.png" class="info_img2"></h2>
        <p>Meie teenused on kohandatud vastavalt teie vajadustele ja neid saab hõlpsasti kohandada vastavalt nõudluse muutustele. Pikaajalisi lepinguid ei ole vaja sõlmida - saate paindlikult reageerida kiiresti turumuutustele ja kohaneda kiiresti uute nõuetega.</p>
        <h2>Oskused täpselt siis, kui te neid vajate<img src="images/galka.png" class="info_img2"></h2>
        <p>Meie kaudu on teil juurdepääs kõrge kvalifikatsiooniga spetsialistidele ja ekspertidele, kes suudavad lahendada teie probleeme, isegi kui selliseid spetsialiste on teie piirkonnas raske leida. Me tagame, et teil on juurdepääs vajalikele oskustele ja teadmistele siis, kui te neid kõige rohkem vajate.</p>
        <h2>Turvaline<img src="images/galka.png" class="info_img2"></h2>
        <p>Me järgime rangelt kõiki kohalikke ja rahvusvahelisi õigusakte, tagades kõigi meie tegevuste ohutuse ja seaduslikkuse. Teie ja meie töötajate huvid on kaitstud kõigis koostöö etappides, mis tagab teile meelerahu ja usalduse meie töö suhtes.</p>
    </div>
    <img class="image2" src="images/person3.jpg" alt="Personal">
</div>
<div class="cooperation">
    <img class="image3" src="images/person2.jpg" alt="Personal">
    <div class="info_text2">
        <h2>Koostöö ettevõttega</h2>
        <p>Aastate jooksul oleme teinud koostööd selliste ettevõtetega nagu <strong><a href="https://www.leonhard-weiss.ee/">Leonhard Weiss</a></strong>, pakkudes neile kõrgelt kvalifitseeritud töötajaid õigel ajal. Meie maine põhineb klientide usaldusel meie võimete ja tõhusa värbamisprotsessi vastu.</p>
    </div>
</div>
<div class="contact">
    <div>
        <button id="contactBtn3" class="open-modal" onclick="window.location.href='ametid.php'">Töötajate leidmine<img src="images/rabotnik.png" width="30" height="30"></button>
    </div>
    <div>
        <button id="contactBtn4" class="open-modal2">Töö leidmine<img src="images/rabota.png"></button>
    </div>
</div>

</body>
<footer>
    <div class="footer-content">
        <div class="contact-info">
            <div>
                <img src="images/location.png" alt="Эстония,Таллинн" width="20" height="20">
                <label>Estonia, Tallinn</label>
            </div>
            <div>
                <img src="images/email.png" width="20" height="20">
                <label>Roman@LRQuality.ee</label>
            </div>
            <div>
                <img src="images/phone.png" width="20" height="20">
                <label>+372 55555555</label>
            </div>
        </div>
    </div>
    <div class="copyright">&copy; 2024 LRQuality. All Rights Reserved.</div>
</footer>

</html>

<?php
// Закрытие соединения с базой данных
$yhendus->close();
?>
