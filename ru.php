<?php
global $yhendus;
include("connect.php");

// Запрос к базе данных для получения списка услуг
$sql = "SELECT * FROM users";
$result = $yhendus->query($sql);

// Проверяем, было ли отправлено сообщение об успешной отправке
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<script language="javascript">';
    echo 'alert("Ваша заявка отправлена!")';
    echo '</script>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверка, отправлена ли первая форма
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
                // Внесение данных в базу данных
                $insertSql = "INSERT INTO users (nimi, perekonnanimi, email, telefon, dates, haridus, image_data) VALUES ('$nimi_user', '$perenimi_user', '$email_user', '$telefon_user','$dates_user','$haridus_user','$image_data')";
                if ($yhendus->query($insertSql) === TRUE) {
                    echo '<script language="javascript">';
                    echo 'alert("Ваша заявка отправлена!")';
                    echo '</script>';
                }

            } else {
                // Внесение данных в базу данных
                $insertSql = "INSERT INTO users (nimi, perekonnanimi, email, telefon, dates, haridus) VALUES ('$nimi_user', '$perenimi_user', '$email_user', '$telefon_user','$dates_user','$haridus_user')";
                if ($yhendus->query($insertSql) === TRUE) {
                    echo '<script language="javascript">';
                    echo 'alert("Ваша заявка отправлена!")';
                    echo '</script>';
                }
        }}else {
            echo '<script language="javascript">';
            echo 'alert("Пожалуйста, заполните все поля")';
            echo '</script>';
        }
    }

    // На данный момент 2 анкета не используется
    if (isset($_POST["nimi2"]) && isset($_POST["perekonnanimi2"]) && isset($_POST["email2"]) && isset($_POST["telefon2"])) {
        $nimi2 = $_POST["nimi2"];
        $perenimi2 = $_POST["perekonnanimi2"];
        $email2 = $_POST["email2"];
        $telefon2 = $_POST["telefon2"];
        $rabotniki = $_POST["rabotniki"];
        $address = $_POST["address"];
        $firmi_code = $_POST["firmi_code"];
        $info2 = isset($_POST["info2"]) ? $_POST["info2"] : "";

        // Проверка на данные
        if (!empty($nimi2) && !empty($perenimi2) && !empty($email2) && !empty($telefon2) && !empty($rabotniki) && !empty($address) && !empty($firmi_code) && !empty($info2)) {
            // Внесение данных в базу данных
            $insertSql = "INSERT INTO rabotodatel (nimi2, perekonnanimi2, email2, telefon2, rabotniki, address, firmi_code, info2) VALUES ('$nimi2', '$perenimi2', '$email2', '$telefon2', '$rabotniki', '$address', '$firmi_code', '$info2')";
            if ($yhendus->query($insertSql) === TRUE) {
                echo '<script language="javascript">';
                echo 'alert("Ваша заявка отправлена!")';
                echo '</script>';
            }
        } else {
            echo '<script language="javascript">';
            echo 'alert("Пожалуйста, заполните все поля")';
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
    <title>Аренда рабочей силы LRQuality</title>
    <link rel="icon" href="images/logo_LR.ico" type="image/x-icon">
</head>
<header>
    <img class="logo" src="images/logo_LR.png" width="80" onclick="varskLeht()">
    <h1 class="header_text">Аренда рабочей силы</h1>
    <div class="lang">
        <a href="info_ru.php" class="tootajad">Список сотрудников</a>
        <select id="language-select" onchange="changeLanguage(this.value)">
            <option value="ru">
                <img src="images/ru_flag.png" width="1" height="1"> RU
            </option>
            <option value="en">
                <img src="images/en_flag.png" width="20" height="15"> EN
            </option>
            <option value="et">
                <img src="images/et_flag.png" width="20" height="15"> EE
            </option>
        </select>
        <a href="login.php" class="login2">Вход</a>
    </div>
    <button class="menu">
        <img src="images/menu.png" class="menu-icon">
    </button>
</header>
<body>
<div class="sidebar">
    <a href="login.php" class="login">Вход</a>
    <a href="info_ru.php" class="login">Список сотрудников</a>
    <label class="sidebar_lbl">Выбор языка</label>
    <a href="ru.php" class="lang2"><img src="images/ru_flag.png" class="sidebar_lang">RU</a>
    <a href="et.php" class="lang2"><img src="images/et_flag.png" class="sidebar_lang">EE</a>
    <a href="en.php" class="lang2"><img src="images/en_flag.png" class="sidebar_lang">EN</a>
</div>
<div class="info">
    <div class="info_text">
        <h1>Увеличьте эффективность вашего бизнеса с помощью нашей услуги аренды рабочей силы.</h1>
        <p>Независимо от того, требуется ли вам временный персонал для ускорения поиска, справления с пиковой загрузкой или реализации долгосрочных проектов, мы предоставляем гибкое решение для ваших потребностей в персонале.</p>
        <p>Наши кадры обеспечивают вам гибкость, которая необходима для эффективного развития вашего бизнеса. Мы поможем вам гибко решать кадровые проблемы, добиваться экономии средств и преодолевать нехватку местных кадровных ресурсов. Наша служба аренды рабочей силы — это ключ к вашему успеху и процветанию.</p>
    </div>
    <img class="image" src="images/person.jpg" alt="Персонал">
</div>
<div class="contact">
    <!--<div>
        <button id="contactBtn1" class="open-modal">Найти сотрудников<img src="images/rabotnik.png"></button>
    </div>-->
    <div>
        <button class="open-modal" onclick="window.location.href='ametid.php'">Найти сотрудников<img src="images/rabotnik.png" width="30" height="30"></button>
    </div>
    <div>
        <button id="contactBtn2" class="open-modal2">Найти работу<img src="images/rabota.png"></button>
    </div>
</div>

<!--<div id="contactForm1" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form method="post" class="add" action="">
            <label for="nimi2">Имя:</label>
            <input type="text" name="nimi2" placeholder="Введите ваше имя" required>

            <label for="perekonnanimi2">Фамилия:</label>
            <input type="text" name="perekonnanimi2" placeholder="Введите вашу фамилию"  required>

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
                <option>Другое</option>
            </select>
             <input type="text" name="rabotniki" placeholder="Введите какие работники нужны" required>

            <label for="address">Адрес:</label>
            <input type="text" name="address" placeholder="Введите ваш адрес фирмы" required>

            <label for="firmi_code">Код фирмы:</label>
            <input type="text" name="firmi_code" placeholder="Введите ваш код фирмы" required>

            <label for="info2">Дополнительная информация:</label>
            <input type="text" name="info2" placeholder="Дополнительная информация" required>

            <input type="submit" class="modal_sumbit" value="Отправить">
        </form>
    </div>
</div>-->

<div id="contactForm2" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form method="post" class="add" action="" enctype="multipart/form-data">
            <label for="nimi">Имя:</label>
            <input type="text" name="nimi" placeholder="Введите ваше имя" required>

            <label for="perekonnanimi">Фамилия:</label>
            <input type="text" name="perekonnanimi" placeholder="Введите вашу фамилию"  required>

            <label for="email">Емайл:</label>
            <input type="email" name="email" placeholder="Введите вашу почту" required>

            <label for="telefon">Номер телефона:</label>
            <input type="tel" name="telefon" pattern="\+[0-9]+" placeholder="Введите номер телефона, начиная с '+'" required>

            <label for="dates">Дата рождения:</label>
            <input type="date" name="dates" required>

            <label for="haridus">Образование:</label>
            <select name="haridus" class="select_modal">
                <option>Основное образование</option>
                <option>Профессиональное образование</option>
                <option>Дополнительное образование</option>
            </select>

            <label for="image_data">Загрузите вашу фотографию:</label>
            <input type="file" class="modal_imagedata" name="image_data" accept="image/*">

            <input type="submit" class="modal_sumbit" value="Отправить">
        </form>
    </div>
</div>

<div class="steps">
    <div class="step">
        <h2>Профилирование кандидатов</h2>
        <p>Вместе мы определяем профили сотрудников, уровни навыков и опыта, а также диапазоны заработной платы для данной должности.</p>
    </div>
    <div class="step">
        <h2>Отбор кандидатов</h2>
        <p>Мы ищем подходящих кандидатов в наших сетях и используем наши цифровые инструменты. Мы проводим собеседование с кандидатами, обеспечиваем контроль уровня компетентности и заинтересованности кандидатов в работе.</p>
    </div>
    <div class="step">
        <h2>Интервью</h2>
        <p>Мы предоставим вам список лучших кандидатов на собеседование или, по вашему желанию, организуем для вас весь процесс собеседования.</p>
    </div>
    <div class="step">
        <h2>Начало работы сотрудника</h2>
        <p>После поиска подходящих кандидатов мы подписываем трудовые договоры и вы можете приступить к работе со своим новым членом команды.</p>
    </div>
</div>
<div class="info2">
    <div class="info_text2">
        <h2>Экономически эффективным<img src="images/galka.png" class="info_img2"></h2>
        <p>Мы предлагаем экономичное решение, которое позволяет оптимизировать расходы, оплачивая услуги только в момент их фактического использования. Это освобождает ваш бюджет от лишних затрат и позволяет сосредоточить ресурсы на других стратегически важных задачах.</p>
        <h2>Гибкий и масштабируемый<img src="images/galka.png" class="info_img2"></h2>
        <p>Наши услуги адаптируются к вашим потребностям и могут быть легко масштабированы в соответствии с изменениями спроса. Нет необходимости заключать долгосрочные контракты – вы получаете гибкость, чтобы оперативно реагировать на рыночные изменения и быстро адаптироваться к новым требованиям.</p>
        <h2>Навыки именно тогда, когда они вам нужны<img src="images/galka.png" class="info_img2"></h2>
        <p>С нами вы можете получить доступ к высококвалифицированным специалистам и экспертам, которые могут решить ваши задачи, даже если подобных специалистов трудно найти в вашем регионе. Мы обеспечиваем доступ к необходимым навыкам и знаниям именно в тот момент, когда они вам наиболее критично нужны.</p>
        <h2>Безопасно<img src="images/galka.png" class="info_img2"></h2>
        <p>Мы строго соблюдаем все требования местного и международного законодательства, обеспечивая безопасность и легальность всех наших операций. Ваши интересы и интересы наших сотрудников защищены на всех этапах сотрудничества, что обеспечивает вам мир и уверенность в нашей работе.</p>
    </div>
    <img class="image2" src="images/person3.jpg" alt="Персонал">
</div>
<div class="cooperation">
    <img class="image3" src="images/person2.jpg" alt="Персонал">
    <div class="info_text2">
        <h2>Сотрудничество с компанией</h2>
        <p>В течение многих лет мы сотрудничаем с компанией, таким как <strong><a href="https://www.leonhard-weiss.ee/">Leonhard Weiss</a></strong>, предоставляя им высококвалифицированный персонал в нужный момент. Наша репутация основана на доверии клиентов к нашим способностям и эффективному процессу подбора персонала.</p>
    </div>
</div>
<div class="contact">
    <div>
        <button id="contactBtn3" class="open-modal" onclick="window.location.href='ametid.php'">Найти сотрудников<img src="images/rabotnik.png" width="30" height="30"></button>
    </div>
    <div>
        <button id="contactBtn4" class="open-modal2">Найти работу<img src="images/rabota.png"></button>
    </div>
</div>

</body>
<footer>
    <div class="footer-content">
        <div class="contact-info">
            <div>
                <img src="images/location.png" class="img_footer" alt="Эстония,Таллинн" width="20" height="20">
                <label>Эстония, Таллинн</label>
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
// Закрытие соединения с базой данных
$yhendus->close();
?>
