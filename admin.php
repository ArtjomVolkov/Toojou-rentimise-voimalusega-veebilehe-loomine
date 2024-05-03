<?php
session_start();
global $yhendus;
require("abifunktsioonid.php");
include("connect.php");

function isAdmin(){
    return isset($_SESSION['onAdmin'])&&$_SESSION['onAdmin'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['muutmine'])) {
        $muudetud_nimi = $_POST['muudetud_nimi'];
        $muudetud_perekonnanimi = $_POST['muudetud_perekonnanimi'];
        $muudetud_email = $_POST['muudetud_email'];
        $muudetud_telefon = $_POST['muudetud_telefon'];
        $muudetud_dates = $_POST['muudetud_dates'];
        $muudetud_haridus = $_POST['muudetud_haridus'];
        $muudetud_category = $_POST['muudetud_category'];
        $muudetudid = $_POST['muudetudid'];
        muudaUsers($muudetud_nimi, $muudetud_perekonnanimi,$muudetud_email,$muudetud_telefon,$muudetud_dates,$muudetud_haridus,$muudetud_category, $muudetudid);
    }
    elseif (isset($_POST['kustutusid'])) {
        $kustutusid = $_POST['kustutusid'];
        kustutaUsers($kustutusid);
    }

    if (isset($_POST['muutmine_rabotodatel'])) {
        $muudetud_nimi_rabotodatel = $_POST['muudetud_nimi_rabotodatel'];
        $muudetud_email_rabotodatel = $_POST['muudetud_email_rabotodatel'];
        $muudetud_telefon_rabotodatel = $_POST['muudetud_telefon_rabotodatel'];
        $muudetud_rabotniki_rabotodatel = $_POST['muudetud_rabotniki_rabotodatel'];
        $muudetud_rabotniki2_rabotodatel = $_POST['muudetud_rabotniki2_rabotodatel'];
        $muudetud_address_rabotodatel = $_POST['muudetud_address_rabotodatel'];
        $muudetud_firmicode_rabotodatel = $_POST['muudetud_firmicode_rabotodatel'];
        $muudetud_info_rabotodatel = $_POST['muudetud_info_rabotodatel'];
        $muudetudid_rabotodatel = $_POST['muudetudid_rabotodatel'];
        muudaRabotodatel($muudetud_nimi_rabotodatel,$muudetud_email_rabotodatel, $muudetud_telefon_rabotodatel, $muudetud_rabotniki_rabotodatel,$muudetud_rabotniki2_rabotodatel, $muudetud_address_rabotodatel, $muudetud_firmicode_rabotodatel, $muudetud_info_rabotodatel, $muudetudid_rabotodatel);
    }
    elseif (isset($_POST['kustutusid_rabotodatel'])) {
        $kustutusid_rabotodatel = $_POST['kustutusid_rabotodatel'];
        kustutaRabotodatel($kustutusid_rabotodatel);
    }
}

// Обработка принятия и отмены принятия
if (isset($_POST["accept"])) {
    $user_id = $_POST["user_id"];
    Accept($user_id, 1); // Принять пользователя
}

if (isset($_POST["cancel"])) {
    $user_id = $_POST["user_id"];
    Accept($user_id, 0); // Отменить принятие пользователя
}


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="admin.css" rel="stylesheet"/>
    <title>Администратор LRQuality</title>
    <link rel="icon" href="images/logo_LR.ico" type="image/x-icon">
</head>
<header>
    <?php if (isAdmin()){ ?>
        <div class="seacrh_lbl">
            <!-- Форма поиска для работника -->
            <form method="GET">
                <select name="user_kriteerium">
                    <option value="nimi">Имя</option>
                    <option value="perekonnanimi">Фамилия</option>
                    <option value="email">Емайл</option>
                    <option value="telefon">Телефон</option>
                </select>
                <input type="text" name="user_sumbol" placeholder="Введите ключевое слово">
                <button type="submit">Поиск работника</button>
            </form>
        </div>
        <div class="seacrh_lbl">
            <!-- Форма поиска для работодателя -->
            <form method="GET">
                <select name="rabotodatel_kriteerium">
                    <option value="nimi2">Имя</option>
                    <option value="perekonnanimi2">Фамилия</option>
                    <option value="email2">Емайл</option>
                    <option value="telefon2">Телефон</option>
                    <option value="address">Адрес фирмы</option>
                    <option value="firmi_code">Код фирмы</option>
                </select>
                <input type="text" name="rabotodatel_sumbol" placeholder="Введите ключевое слово">
                <button type="submit">Поиск работодателя</button>
            </form>
        </div>
        <div class="button_back">
            <a href="info_ru.php" class="infos">Cотрудники</a>
            <form action="logout.php" method="post">
                <input type="submit" value="Выйти" class="back" name="logout">
            </form>
        </div>
    <?php }?>
</header>
<body>

<?php
if (isAdmin()){
// Поиск в таблице пользователей
    $sqlUsers = "SELECT * FROM users";
    if(isset($_GET['user_sumbol'], $_GET['user_kriteerium'])) {
        $user_sumbol = $_GET['user_sumbol'];
        $user_kriteerium = $_GET['user_kriteerium'];
        // Проверка на пустое поля
        if (!empty($user_sumbol)) {
            $sqlUsers .= " WHERE $user_kriteerium LIKE '%$user_sumbol%'";
        }
    }
    $resultUsers = $yhendus->query($sqlUsers);

    $now_date = date('Y-m-d');

    if ($resultUsers->num_rows > 0) {
        echo "<h1 class='title_table'>Работники</h1>";
        echo "<table class='table table-striped'>";
        echo "<thead><tr><th>Имя</th><th>Фамилия</th><th>Емайл</th><th>Телефон</th><th>Дата рождения</th><th>Возраст</th><th>Образование</th><th>Фотография</th><th>Специальность</th><th>Действия</th></tr></thead>";
        echo "<tbody>";

        while ($row = $resultUsers->fetch_assoc()) {
            // Преобразуем дату рождения из формата строки в объект DateTime
            $date_obj = new DateTime($row["dates"]);
            // Вычисляем разницу в годах между датой рождения и текущей датой
            $age = $date_obj->diff(new DateTime($now_date))->y;

            echo "<tr>";
            echo "<td>" . $row["nimi"] . "</td>";
            echo "<td>" . $row["perekonnanimi"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["telefon"] . "</td>";
            echo "<td>" . $row["dates"] . "</td>";
            echo "<td>" . $age . "</td>";
            echo "<td>" . $row["haridus"] . "</td>";
            echo '<td><img src="data:image/jpeg;base64,'.base64_encode($row['image_data']).'" width="150px" height="150px" /></td>';
            echo "<td>" . $row["category"] . "</td>";
            echo "<td class='action-buttons'>";

            // Открывается форма изменений куда можно записать изменения свои (новые данные)
            if (isset($_POST["muutmisid"]) && intval($_POST["muutmisid"]) == $row["id"]) {
                echo "<div class='edit-form'>";
                echo "<form method='post'>";
                echo "<h5>Имя</h5>";
                echo "<input type='text' name='muudetud_nimi' value='" . $row["nimi"] . "'/>";
                echo "<h5>Фамилия</h5>";
                echo "<input type='text' name='muudetud_perekonnanimi' value='" . $row["perekonnanimi"] . "'/>";
                echo "<h5>Почта</h5>";
                echo "<input type='text' name='muudetud_email' value='" . $row["email"] . "'/>";
                echo "<h5>Номер телефона</h5>";
                echo "<input type='text' name='muudetud_telefon' value='" . $row["telefon"] . "'/>";
                echo "<h5>Дата рождения</h5>";
                echo "<input type='date' name='muudetud_dates' value='" . $row["dates"] . "'/>";
                echo "<h5>Образование</h5>";
                echo "<select name='muudetud_haridus' class='select_haridus'>";
                echo "<option>Основное образование</option>";
                echo "<option>Профессиональное образование</option>";
                echo "<option>Дополнительное образование</option>";
                echo "</select>";
                echo "<h5>Специальность</h5>";
                echo "<select name='muudetud_category' id='category' class='select_category'>";
                echo "<option value='0'>Все категории</option>";
                echo "<option value='1'>Бетонные работы</option>";
                echo "<option value='2'>Электрики</option>";
                echo "<option value='3'>Разнорабочий</option>";
                echo "<option value='4'>Арматурщики</option>";
                echo "<option value='5'>Плотники</option>";
                echo "<option value='6'>Сборщик</option>";
                echo "<option value='7'>Сварщики</option>";
                echo "<option value='8'>Экскаваторщик</option>";
                echo "</select>";
                echo "<input type='hidden' name='muudetudid' value='" . $row["id"] . "'/>";
                echo "<input type='submit' name='muutmine' value='Сохранить изменения'/>";
                echo "</form>";
                echo "</div>";
            }

            if ($row["accept"] == 0) {
                // Форма принятия
                echo "<form method='post'>";
                echo "<input type='hidden' name='user_id' value='" . $row["id"] . "'>";
                echo "<button type='submit' name='accept' class='btn btn-success'>Принять</button>";
                echo "</form>";
            } else {
                // Форма отмены принятия
                echo "<form method='post'>";
                echo "<input type='hidden' name='user_id' value='" . $row["id"] . "'>";
                echo "<button type='submit' name='cancel' class='btn btn-danger'>Отменить</button>";
                echo "</form>";
            }


            //Форма редактирования
            echo "<form method='post'>";
            echo "<input type='hidden' name='muutmisid' value='" . $row["id"] . "'>";
            echo "<button type='submit' class='btn btn-warning'>Редактировать</button>";
            echo "</form>";

            // Удаление форма
            echo "<form method='post'>";
            echo "<input type='hidden' name='kustutusid' value='" . $row["id"] . "'>";
            echo "<button type='submit' class='btn btn-danger'>Удалить</button>";
            echo "</form>";

            echo "</td>";
            /*echo "<td>";

                // Черный список
                echo "<form method='post' style='margin-top: 15px;'>";
                echo "<input type='hidden' name='mustnimed' value='" . $row["id"] . "'>";
                echo "<button type='submit' name='mustnime2' class='btn btn-danger'>Черный список</button>";
                echo "</form>";
            echo "</td>";*/
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p>Нет данных о пользователях</p>";
    }

// Поиск в таблице работодателей
    $sqlRabotodatel = "SELECT * FROM rabotodatel";
    if(isset($_GET['rabotodatel_sumbol'], $_GET['rabotodatel_kriteerium'])) {
        $rabotodatel_sumbol = $_GET['rabotodatel_sumbol'];
        $rabotodatel_kriteerium = $_GET['rabotodatel_kriteerium'];
        // Проверка на пустое поля
        if (!empty($rabotodatel_sumbol)) {
            $sqlRabotodatel .= " WHERE $rabotodatel_kriteerium LIKE '%$rabotodatel_sumbol%'";
        }
    }
    $resultRabotodatel = $yhendus->query($sqlRabotodatel);

    if ($resultRabotodatel->num_rows > 0) {
        echo "<h1 class='title_table'>Работодатель</h1>";
        echo "<table class='table table-striped'>";
        echo "<thead><tr><th>Имя</th><th>Емайл</th><th>Телефон</th><th>Специальность работников</th><th>Нужное кол-во работников</th><th>Адрес фирмы</th><th>Код фирмы</th><th>Информация дополнительная</th><th>Действия</th></tr></thead>";
        echo "<tbody>";

        while ($row = $resultRabotodatel->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["nimi2"] . "</td>";
            echo "<td>" . $row["email2"] . "</td>";
            echo "<td>" . $row["telefon2"] . "</td>";
            echo "<td>" . $row["rabotniki"] . "</td>";
            echo "<td>" . $row["rabotniki2"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["firmi_code"] . "</td>";
            echo "<td class='info-cell'>" . $row["info2"] . "</td>";
            echo "<td class='action-buttons'>";

            if (isset($_POST["muutmisid_rabotodatel"]) && intval($_POST["muutmisid_rabotodatel"]) == $row["id"]) {
                echo "<div class='edit-form'>";
                echo "<form method='post'>";
                echo "<h5>Имя</h5>";
                echo "<input type='text' name='muudetud_nimi_rabotodatel' value='" . $row["nimi2"] . "'/>";
                echo "<h5>Почта</h5>";
                echo "<input type='text' name='muudetud_email_rabotodatel' value='" . $row["email2"] . "'/>";
                echo "<h5>Телефон</h5>";
                echo "<input type='text' name='muudetud_telefon_rabotodatel' value='" . $row["telefon2"] . "'/>";
                echo "<h5>Рабочие</h5>";
                echo "<input type='text' name='muudetud_rabotniki_rabotodatel' value='" . $row["rabotniki"] . "'/>";
                echo "<h5>Нужное кол-во работников</h5>";
                echo "<input type='text' name='muudetud_rabotniki2_rabotodatel' value='" . $row["rabotniki2"] . "'/>";
                echo "<h5>Адресс</h5>";
                echo "<input type='text' name='muudetud_address_rabotodatel' value='" . $row["address"] . "'/>";
                echo "<h5>Код фирмы</h5>";
                echo "<input type='text' name='muudetud_firmicode_rabotodatel' value='" . $row["firmi_code"] . "'/>";
                echo "<h5>Доп информация</h5>";
                echo "<input type='text' name='muudetud_info_rabotodatel' value='" . $row["info2"] . "'/>";
                echo "<input type='hidden' name='muudetudid_rabotodatel' value='" . $row["id"] . "'/>";
                echo "<input type='submit' name='muutmine_rabotodatel' value='Сохранить изменения'/>";
                echo "</form>";
                echo "</div>";
            }

            echo "<form method='post'>";
            echo "<input type='hidden' name='muutmisid_rabotodatel' value='" . $row["id"] . "'>";
            echo "<button type='submit' class='btn btn-warning'>Редактировать</button>";
            echo "</form>";

            echo "<form method='post'>";
            echo "<input type='hidden' name='kustutusid_rabotodatel' value='" . $row["id"] . "'>";
            echo "<button type='submit' class='btn btn-danger'>Удалить</button>";
            echo "</form>";
            /* Черный список
            echo "<td>";
            echo "<form method='post' style='margin-top: 15px;'>";
            echo "<input type='hidden' name='mustnimed' value='" . $row["id"] . "'>";
            echo "<button type='submit' name='mustnime2' class='btn btn-danger'>Черный список</button>";
            echo "</form>";
            echo "</td>";*/
            echo "</td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p>Нет данных о работодателях</p>";
    }
}
else{
    echo '<script language="javascript">';
    echo 'alert("Error! Sa ei ole administraatorina sisse logitud")';
    echo '</script>';
    echo '<div class="info_page404">';
    echo '<label>Administraatori sisselogimise leht - <a href="login.php">Klõpsake</a></label>';
    echo '<label>Страница авторизации в администратора - <a href="login.php">Кликните</a></label>';
    echo '<label>Admin login page - <a href="login.php">Click</a></label>';
    echo '</div>';
}
// Закрытие соединения с базой данных
$yhendus->close();
?>

</body>
</html>
