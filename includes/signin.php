<?php 
	session_start();
	require_once 'connection.php';

	$email = $_POST['email'];
	$password = $_POST['password'];
	$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");

	if(mysqli_num_rows($check_user) > 0)
	{
		$user = mysqli_fetch_assoc($check_user);

		$_SESSION['user'] = [
			"id" => $user['id'],
			"surname" => $user['surname'],
			"name" => $user['name'],
			"role" => $user['role']
		];

		header('Location: ../pages/forum.php');
	} 
	else
	{
		$_SESSION['message'] = 'Неверный логин или пароль';
		header('Location: ../index.php');
	}
?>