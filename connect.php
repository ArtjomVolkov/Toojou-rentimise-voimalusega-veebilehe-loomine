<?php
$host = "localhost"; // Обычно "localhost"
$username = "";
$password = "";
$database = "d113378_lrqualitydb";

// Подключение к базе данных
$yhendus = new mysqli($host, $username, $password, $database);

// Проверка соединения
if ($yhendus->connect_error) {
    die("Ошибка подключения к базе данных: " . $yhendus->connect_error);
}
?>
