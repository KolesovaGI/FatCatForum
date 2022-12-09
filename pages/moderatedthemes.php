<?php
    session_start();
    require_once '../includes/connection.php';

    if(!$_SESSION['user'])
    {
		header('Location: ../index.php');
	} 
    else if($_SESSION['user']['role'] != "admin")
    {
        header('Location: forum.php');
    }

    $stmt = $connect->prepare("SELECT * FROM `themes` WHERE user_id = ? ORDER BY date DESC");
    $stmt->bind_param("s", $_SESSION[user][id]);
    $stmt->execute();
    $stmt->bind_result($result);

    $stmt->fetch();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Модерируемые темы</title>
</head>
<body>
    <?php 
        include '../includes/header.php';
    ?>
    <section class="container">
		<div class="themes">
			<a href="forum.php" class="backToForum">Назад</a>
			<?php 
				if($result)
                {
					$rows = mysqli_num_rows($result);

					for($i = 1; $i <= $rows; $i++)
                    {
						$row = $result->fetch_assoc();
                        $author = mysqli_fetch_assoc(mysqli_query($connect, "SELECT surname, name FROM `users` WHERE id = $row[user_id]"));
                        
                        echo 
                        '<div class="theme">
                            <h2 class="title">' . $row['title'] . '</h2>
                            <p class="text">' . $row['text'] . '</p>
                            <p class="author">Автор: ' . $author['surname'] . ' ' . $author['name'] . '</p>
                            <p class="dateTheme">Дата создания: ' . date("d-m-Y H:i:s", strtotime($row['date'])) . '</p>
                            <form action="approvetheme.php" method="post">
                                <input type="submit" name="approve" value="Одобрить" class="approveTheme">
                            </form>
                        </div>';
					}
				}
			?>
		</div>
	</section>
</body>
</html>