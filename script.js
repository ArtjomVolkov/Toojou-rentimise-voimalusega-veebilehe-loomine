function changeLanguage(language) {
    if (language === "ru") {
        window.location.href = "ru.php";
    } else if (language === "et") {
        window.location.href = "et.php";
    } else if (language === "en") {
        window.location.href = "en.php";
    }
}

/*function changeLanguage(language) {
    if (language === "ru") {
        window.location.href = "ru_leht.php";
    } else if (language === "et") {
        window.location.href = "et_leht.php";
    } else if (language === "en"){
        window.location.href = "en_leht.php";
    }
}*/

function varskLeht() {
    window.location.reload();
}


document.addEventListener("DOMContentLoaded", function() {
    var contactForm = document.getElementById("contactForm1");
    // Находим все кнопки с классом "open-modal"
    var modalButtons = document.querySelectorAll(".open-modal");

    // Добавляем обработчик события для каждой кнопки
    modalButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            // Находим модальное окно по его id
            var modal = document.getElementById("contactForm1");
            var ContBtn3 = document.getElementById("contactBtn3");
            var ContBtn4 = document.getElementById("contactBtn4");
            // Отображаем модальное окно
            modal.style.display = "block";

            ContBtn3.style.display = "none";
            ContBtn4.style.display = "none";

            // Находим элемент для закрытия модального окна
            var closeButton = modal.querySelector(".close");

            // Добавляем обработчик события для закрытия модального окна
            closeButton.addEventListener("click", function() {
                // Скрываем модальное окно при нажатии на кнопку закрытия
                modal.style.display = "none";
                ContBtn3.style.display = "block";
                ContBtn4.style.display = "block";
            });

            // Добавляем обработчик события для закрытия модального окна при клике вне его
            window.addEventListener("click", function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    ContBtn3.style.display = "block";
                    ContBtn4.style.display = "block";
                }
            });
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var contactForm = document.getElementById("contactForm2");
    // Находим все кнопки с классом "open-modal"
    var modalButtons = document.querySelectorAll(".open-modal2");

    // Добавляем обработчик события для каждой кнопки
    modalButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            // Находим модальное окно по его id
            var modal = document.getElementById("contactForm2");
            var ContBtn3 = document.getElementById("contactBtn3");
            var ContBtn4 = document.getElementById("contactBtn4");
            // Отображаем модальное окно
            modal.style.display = "block";
            ContBtn3.style.display = "none";
            ContBtn4.style.display = "none";

            // Находим элемент для закрытия модального окна
            var closeButton = modal.querySelector(".close");

            // Добавляем обработчик события для закрытия модального окна
            closeButton.addEventListener("click", function() {
                // Скрываем модальное окно при нажатии на кнопку закрытия
                modal.style.display = "none";
                ContBtn3.style.display = "block";
                ContBtn4.style.display = "block";
            });

            // Добавляем обработчик события для закрытия модального окна при клике вне его
            window.addEventListener("click", function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    ContBtn3.style.display = "block";
                    ContBtn4.style.display = "block";
                }
            });
        });
    });
});

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




