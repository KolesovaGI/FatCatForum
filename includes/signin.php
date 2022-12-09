<?php 
	session_start();
	require_once 'connection.php';

	$email = $_POST['email'];
	$password = $_POST['password'];

	
    $stmt = $connect->prepare("SELECT * FROM `users` WHERE `email` = ? AND `password` = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $stmt->bind_result($check_user);

    $stmt->fetch();
	
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