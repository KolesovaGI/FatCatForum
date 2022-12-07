<?php
    session_start();
    require_once '../includes/connection.php';

    if(!$_SESSION['user'])
	{
		header('Location: ../index.php');
	}

	$query = "SELECT * FROM `themes` WHERE user_id = " . $_SESSION[user][id] . " ORDER BY date DESC";
	$result = mysqli_query($connect, $query) or die("Ошибка " . mysqli_error($connect));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <section class="container">
		<div class="themes">
			<a href="forum.php" class="backToForum">Назад</a>
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
							<h2 class="title"><a href="theme.php?id=' . $i . '">' . $row['title'] . '</a></h2>
							<p class="text">' . $row['text'] . '</p>
							<p class="author">Автор: ' . $author['surname'] . ' ' . $author['name'] . '</p>
							<p class="dateTheme">Дата создания: ' . date("d-m-Y H:i:s", strtotime($row['date'])) . '</p>
						</div>';
					}
				}
			?>
		</div>
	</section>
</body>
</html>