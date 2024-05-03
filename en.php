<?php
global $yhendus;
include("connect.php");

// Запрос к базе данных для получения списка услуг
$sql = "SELECT * FROM users";
$result = $yhendus->query($sql);

// Проверяем, было ли отправлено сообщение об успешной отправке
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<script language="javascript">';
    echo 'alert("Your application has been sent!")';
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
                    echo 'alert("Your application has been sent!")';
                    echo '</script>';
                }

            } else {
                // Insert new record into the database
                $insertSql = "INSERT INTO users (nimi, perekonnanimi, email, telefon, dates, haridus) VALUES ('$nimi_user', '$perenimi_user', '$email_user', '$telefon_user','$dates_user','$haridus_user')";
                if ($yhendus->query($insertSql) === TRUE) {
                    echo '<script language="javascript">';
                    echo 'alert("Your application has been sent!")';
                    echo '</script>';
                }
            }}else {
            echo '<script language="javascript">';
            echo 'alert("Please fill in all fields")';
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
                echo 'alert("Your application has been sent!")';
                echo '</script>';
            }
        } else {
            echo '<script language="javascript">';
            echo 'alert("Please fill in all fields")';
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
    <title>Labor rent LRQuality</title>
    <link rel="icon" href="images/logo_LR.ico" type="image/x-icon">
</head>
<header>
    <img class="logo" src="images/logo_LR.png" width="80" onclick="varskLeht()">
    <h1 class="header_text">Labor rent</h1>
    <div class="lang">
        <a href="info_en.php" class="tootajad">List of employees</a>
        <select id="language-select" onchange="changeLanguage(this.value)">
            <option value="en">
                <img src="images/en_flag.png" width="20" height="15"> EN
            </option>
            <option value="ru">
                <img src="images/ru_flag.png" width="20" height="15"> RU
            </option>
            <option value="et">
                <img src="images/et_flag.png" width="20" height="15"> EE
            </option>
        </select>
        <a href="login.php" class="login2">Entry</a>
    </div>
    <button class="menu">
        <img src="images/menu.png" class="menu-icon">
    </button>
</header>
<body>
<div class="sidebar">
    <a href="login.php" class="login">Entry</a>
    <a href="info_en.php" class="login">List of employees</a>
    <label class="sidebar_lbl">Language selection</label>
    <a href="en.php" class="lang2"><img src="images/en_flag.png" class="sidebar_lang">EN</a>
    <a href="et.php" class="lang2"><img src="images/et_flag.png" class="sidebar_lang">EE</a>
    <a href="ru.php" class="lang2"><img src="images/ru_flag.png" class="sidebar_lang">RU</a>
</div>
<div class="info">
    <div class="info_text">
        <h1>Increase the efficiency of your business with our labor rental service.</h1>
        <p>Whether you need temporary staff to expedite your search, handle peak workloads or long-term projects, we provide a flexible solution to your staffing needs.</p>
        <p>Our workforce gives you the flexibility you need to grow your business effectively. We can help you flexibly address staffing challenges, realize cost savings and overcome local staffing shortages. Our labor leasing service is the key to your success and prosperity.</p>
    </div>
    <img class="image" src="images/person.jpg" alt="Персонал">
</div>
<div class="contact">
    <div>
        <button class="open-modal" onclick="window.location.href='ametid.php'">Finding employees<img src="images/rabotnik.png" width="30" height="30"></button>
    </div>
    <!--<div>
        <button id="contactBtn1" class="open-modal">Find employees<img src="images/rabotnik.png"></button>
    </div>-->
    <div>
        <button id="contactBtn2" class="open-modal2">Get a job<img src="images/rabota.png"></button>
    </div>
</div>

<!--<div id="contactForm1" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form method="post" class="add" action="">
            <label for="nimi2">Name:</label>
            <input type="text" name="nimi2" placeholder="Enter your name" required>

            <label for="perekonnanimi2">Surname:</label>
            <input type="text" name="perekonnanimi2" placeholder="Enter your last name"  required>

            <label for="email2">Email:</label>
            <input type="email" name="email2" placeholder="Enter your e-mail" required>

            <label for="telefon2">Phone number:</label>
            <input type="tel" name="telefon2" pattern="\+[0-9]+" placeholder="Enter the phone number starting with '+'" required>

            <label for="rabotniki">Employees:</label>
            <select name="rabotniki" class="select_modal">
                <option>Concrete work</option>
                <option>Electricians</option>
                <option>Handyman</option>
                <option>Reinforcers</option>
                <option>Carpenters</option>
                <option>Assemblers</option>
                <option>Welders</option>
                <option>Other</option>
            </select>

            <label for="address">Address:</label>
            <input type="text" name="address" placeholder="Enter your company address" required>

            <label for="firmi_code">Company code:</label>
            <input type="text" name="firmi_code" placeholder="Enter your company code" required>

            <label for="info2">More info:</label>
            <input type="text" name="info2" placeholder="More info" required>

            <input type="submit" value="Send">
        </form>
    </div>
</div>-->

<div id="contactForm2" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form method="post" class="add" action="" enctype="multipart/form-data">
            <label for="nimi">Name:</label>
            <input type="text" name="nimi" placeholder="Enter your name" required>

            <label for="perekonnanimi">Surname:</label>
            <input type="text" name="perekonnanimi" placeholder="Enter your last name"  required>

            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Enter your e-mail" required>

            <label for="telefon">Phone number:</label>
            <input type="tel" name="telefon" pattern="\+[0-9]+" placeholder="Enter the phone number starting with '+'" required>

            <label for="dates">Date of birth:</label>
            <input type="date" name="dates" required>

            <label for="haridus">Education:</label>
            <select name="haridus" class="select_modal">
                <option>Basic education</option>
                <option>Vocational education</option>
                <option>Additional education</option>
            </select>

            <label for="image_data">Upload your photo:</label>
            <input type="file" class="modal_imagedata" name="image_data" accept="image/*">

            <input type="submit" class="modal_sumbit" value="Send">
        </form>
    </div>
</div>

<div class="steps">
    <div class="step">
        <h2>Candidate profiling</h2>
        <p>Together we identify employee profiles, skill and experience levels, and salary ranges for the position.</p>
    </div>
    <div class="step">
        <h2>Candidate selection</h2>
        <p>We search for suitable candidates in our networks and utilize our digital tools. We interview candidates and ensure that we monitor candidates' level of competence and interest in the job.</p>
    </div>
    <div class="step">
        <h2>Interview</h2>
        <p>We will provide you with a list of the best candidates to interview or, if you prefer, organize the entire interview process for you.</p>
    </div>
    <div class="step">
        <h2>Employee's start date</h2>
        <p>Once we find the right candidates, we sign employment contracts and you can start working with your new team member.</p>
    </div>
</div>
<div class="info2">
    <div class="info_text2">
        <h2>Cost-effective<img src="images/galka.png" class="info_img2"></h2>
        <p>We offer a cost-effective solution that allows you to optimize costs by paying for services only when they are actually used. This frees your budget from unnecessary costs and allows you to focus your resources on other strategically important tasks.</p>
        <h2>Flexible and scalable<img src="images/galka.png" class="info_img2"></h2>
        <p>Our services are customized to your needs and can be easily scaled to meet changes in demand. No need for long-term contracts - you get the flexibility to respond quickly to market changes and adapt quickly to new requirements.</p>
        <h2>Skills exactly when you need them<img src="images/galka.png" class="info_img2"></h2>
        <p>With us, you have access to highly qualified specialists and experts who can solve your challenges, even if such specialists are hard to find in your region. We make sure you have access to the skills and knowledge you need, when you need them most.</p>
        <h2>Safe<img src="images/galka.png" class="info_img2"></h2>
        <p>We strictly comply with all requirements of local and international legislation, ensuring the safety and legality of all our operations. Your interests and the interests of our employees are protected at all stages of cooperation, which provides you with peace of mind and confidence in our work.</p>
    </div>
    <img class="image2" src="images/person3.jpg" alt="Персонал">
</div>
<div class="cooperation">
    <img class="image3" src="images/person2.jpg" alt="Персонал">
    <div class="info_text2">
        <h2>Cooperation with the company</h2>
        <p>Over the years, we have partnered with companies such as <strong><a href="https://www.leonhard-weiss.ee/">Leonhard Weiss</a></strong>, providing them with highly qualified staff at the right time. Our reputation is based on our clients' trust in our abilities and efficient recruitment process.</p>
    </div>
</div>
<div class="contact">
    <div>
        <button id="contactBtn3" class="open-modal" onclick="window.location.href='ametid.php'">Finding employees<img src="images/rabotnik.png" width="30" height="30"></button>
    </div>
    <div>
        <button id="contactBtn4" class="open-modal2">Get a job<img src="images/rabota.png"></button>
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
