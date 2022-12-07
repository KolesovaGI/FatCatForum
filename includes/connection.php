<?php 
	$host = 'localhost';
	$database = 'fatcatforum';	// Название БД
	$user = 'root';				// Имя пользователя
	$password = '';				// Пароль

	$connect = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($connect)); // Соединение с БД
?>