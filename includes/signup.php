<?php 
	require 'connection.php';

	$surname = $_POST['surname'];
	$name = $_POST['name'];
	$login = $_POST['login'];
	$password = $_POST['password'];
	$email = $_POST['email'];

	$sql = "INSERT INTO `users` (surname, name, login, password, email) VALUES ('$surname', '$name', '$login', '$password', '$email')";
	$result = mysqli_query($connect, $sql);
	
	if($result)
    {
        header('Location: ../index.php');
    }
?>