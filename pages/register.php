<?php 
	session_start();

	if($_SESSION['user'])
	{
		header('Location: pages/forum.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Регистрация</title>
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/register.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
	<div class="container">
		<form action="../includes/signup.php" method="POST">
			<input type="text" name="surname" placeholder="Фамилия" required>
			<input type="text" name="name" placeholder="Имя" required>
			<input type="text" name="login" placeholder="Логин" required>
			<input type="password" name="password" placeholder="Пароль" required>
			<input type="email" name="email" placeholder="Email" required>
			<input type="submit" value="Регистрация">
		</form>
	</div>
</body>
</html>