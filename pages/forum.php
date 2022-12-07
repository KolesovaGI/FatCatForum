<?php 
	session_start();
	if(!$_SESSION['user'])
	{
		header('Location: ../index.php');
	}
	require_once '../includes/connection.php';

	$query = "SELECT * FROM `themes` WHERE is_approved = 1 ORDER BY date DESC";
	$result = mysqli_query($connect, $query) or die("Ошибка " . mysqli_error($connect));
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Форум</title>
	<link rel="stylesheet" href="../css/style.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
	<?php
		include '../includes/header.php';
	?>
	<section class="container">
		<div class="themes">
			<a href="createtheme.php" class="createTheme">Создать тему</a>
			<a href="usersthemes.php" class="usersThemes">Мои темы</a>
			<?php if($_SESSION['user']['role'] === "admin"){
				echo '<a href="moderatedthemes.php" class="moderating">Модерация</a>';
			}?>
			<?php 
				if($result)
				{
					$rows = mysqli_num_rows($result);

					for($i = 1; $i <= $rows; $i++)
					{
						$row = mysqli_fetch_assoc($result);
						$author = mysqli_fetch_assoc(mysqli_query($connect, "SELECT surname, name FROM `users` WHERE id = $row[user_id]"));	
						
						echo 
						'<div class="theme">
							<h2 class="title"><a href="theme.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h2>
							<p class="text">' . mb_substr($row['text'], 0, 150) . '...</p>
							<p class="author">Автор: ' . $author['surname'] . ' ' . $author['name'] . '</p>
							<p class="dateTheme">Дата создания: ' . date("d-m-Y H:i:s", strtotime($row['date'])) . '</p>
						</div>';
					}
				}

				//$query = "SELECT * FROM `themes` WHERE user_id = " . $_SESSION[user][id] . " ORDER BY date DESC";
			?>
		</div>
	</section>
</body>
</html>