<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/logo_LR.ico" type="image/x-icon">
    <title>Выбор профессии</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        header {
            text-align: center;
            padding: 20px;
        }

        header h1 {
            margin: 10px 0;
            font-size: 28px;
        }

        .lang {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .lang button {
            margin: 0 10px;
            padding: 5px 10px;
            font-size: 28px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #007BFF;
        }

        .lang button:hover {
            background-color: #0056b3;
        }

        .lang .lang_img {
            margin-right: 5px;
            width: 50px;
            height: auto;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
        }

        .profession {
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 20px;
            flex-basis: calc(50% - 20px);
            max-width: 400px;
            text-align: center;
            background-color: #fff;
            transition: transform 0.3s ease-in-out;
            position: relative;
        }

        .profession:hover {
            transform: translateY(-10px);
        }

        .profession img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            cursor: pointer;
        }

        .profession a {
            display: none;
            text-align: center;
            padding: 10px;
            font-size: 22px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .profession a:hover {
            background-color: #0056b3;
        }

        .profession a[lang="en"] {
            display: block;
        }
        @media only screen and (max-width: 1008px) {
            .container {
                padding: 10px;
            }

            .profession {
                flex-basis: 100%;
                max-width: 100%;
                margin-bottom: 10px;
            }

            .profession img {
                width: 90%;
                height: 200px;
                object-fit: cover;
                cursor: pointer;
            }
        }
    </style>
</head>
<body>
<div class="lang">
    <button onclick="changeLang('ru')"><img src="images/ru_flag.png" class="lang_img">RU</button>
    <button onclick="changeLang('et')"><img src="images/et_flag.png" class="lang_img">ET</button>
    <button onclick="changeLang('en')"><img src="images/en_flag.png" class="lang_img">EN</button>
</div>
<div class="container">
    <div class="profession">
        <a href="info_ru.php?category=1" lang="ru">
            <img src="images/concrete.jpg" alt="Бетонные работы">
            Бетонные работы
        </a>
        <a href="info.php?category=1" lang="et">
            <img src="images/concrete.jpg" alt="Бетонные работы">
            Betoonitööd
        </a>
        <a href="info_en.php?category=1" lang="en">
            <img src="images/concrete.jpg" alt="Бетонные работы">
            Concrete works
        </a>
    </div>
    <div class="profession">
        <a href="info_ru.php?category=2" lang="ru">
            <img src="images/electrician.jpg" alt="Электрики">
            Электрики
        </a>
        <a href="info.php?category=2" lang="et">
            <img src="images/electrician.jpg" alt="Электрики">
            Elektrikud
        </a>
        <a href="info_en.php?category=2" lang="en">
            <img src="images/electrician.jpg" alt="Электрики">
            Electricians
        </a>
    </div>
    <div class="profession">
        <a href="info_ru.php?category=3" lang="ru">
            <img src="images/laborer.jpeg" alt="Разнорабочий">
            Разнорабочий
        </a>
        <a href="info.php?category=3" lang="et">
            <img src="images/laborer.jpeg" alt="Разнорабочий">
            Üldtöölised
        </a>
        <a href="info_en.php?category=3" lang="en">
            <img src="images/laborer.jpeg" alt="Разнорабочий">
            Laborers
        </a>
    </div>
    <div class="profession">
        <a href="info_ru.php?category=4" lang="ru">
            <img src="images/reinforcement.jpg" alt="Арматурщики">
            Арматурщики
        </a>
        <a href="info.php?category=4" lang="et">
            <img src="images/reinforcement.jpg" alt="Арматурщики">
            Armatuurijad
        </a>
        <a href="info_en.php?category=4" lang="en">
            <img src="images/reinforcement.jpg" alt="Арматурщики">
            Reinforcement workers
        </a>
    </div>
    <div class="profession">
        <a href="info_ru.php?category=5" lang="ru">
            <img src="images/carpenter.jpg" alt="Плотники">
            Плотники
        </a>
        <a href="info.php?category=5" lang="et">
            <img src="images/carpenter.jpg" alt="Плотники">
            Puusepad
        </a>
        <a href="info_en.php?category=5" lang="en">
            <img src="images/carpenter.jpg" alt="Плотники">
            Carpenters
        </a>
    </div>
    <div class="profession">
        <a href="info_ru.php?category=6" lang="ru">
            <img src="images/assembler.jpg" alt="Сборщики">
            Сборщики
        </a>
        <a href="info.php?category=6" lang="et">
            <img src="images/assembler.jpg" alt="Сборщики">
            Monteerijad
        </a>
        <a href="info_en.php?category=6" lang="en">
            <img src="images/assembler.jpg" alt="Сборщики">
            Assemblers
        </a>
    </div>
    <div class="profession">
        <a href="info_ru.php?category=7" lang="ru">
            <img src="images/welder.jpeg" alt="Сварщики">
            Сварщики
        </a>
        <a href="info.php?category=7" lang="et">
            <img src="images/welder.jpeg" alt="Сварщики">
            Keevitajad
        </a>
        <a href="info_en.php?category=7" lang="en">
            <img src="images/welder.jpeg" alt="Сварщики">
            Welders
        </a>
    </div>
    <div class="profession">
        <a href="info_ru.php?category=8" lang="ru">
            <img src="images/excavator.jpg" alt="экскаваторщик">
            Экскаваторщик
        </a>
        <a href="info.php?category=8" lang="et">
            <img src="images/excavator.jpg" alt="экскаваторщик">
            Ekskavaatori operaator
        </a>
        <a href="info_en.php?category=8" lang="en">
            <img src="images/excavator.jpg" alt="экскаваторщик">
            Excavator operator
        </a>
    </div>
</div>

<script>
    function changeLang(lang) {
        var elements = document.querySelectorAll('.profession a');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = (elements[i].lang === lang) ? 'block' : 'none';
        }
    }
</script>
</body>
</html>
