<?php 
    session_start();
    require_once '../includes/connection.php';

    $query = mysqli_query($connect, "SELECT * FROM `themes` WHERE id = " . $_GET['id']);
    $result = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signin.css">
    <link rel="stylesheet" href="../css/style.css">
    <title><?= $result['title'];?></title>
</head>
<body>
    <?php 
        include '../includes/header.php';
    ?>
        <section class="themes container">
            <a href="forum.php" class="backToForum">Назад</a>
            <?php
                if($result)
                {
                    $author = mysqli_fetch_assoc(mysqli_query($connect, "SELECT surname, name FROM `users` WHERE id = $result[user_id]"));			
                    
                    echo 
                    '<div class="theme">
                        <h2 class="title">' . $result['title'] . '</h2>
                        <p class="text">' . $result['text'] . '</p>
                        <p class="author">Автор: ' . $author['surname'] . ' ' . $author['name'] . '</p>
                        <p class="dateTheme">Дата создания: ' . $result['date'] . '</p>
                    </div>';
                }
            ?>
        </section>
        <section class="container answers">
            <h2 class="title">Ответы</h2>
            <?php 
                $query = mysqli_query($connect, "SELECT * FROM `answers` WHERE theme_id = " . $_GET['id']) or die("Ошибка " . mysqli_error($connect));

                while($result = mysqli_fetch_assoc($query))
                {
                    echo 
						'<div class="answer">
							<h3 class="answerAuthor">' . $result['author'] . '</h3>
							<p class="answerText">' . $result['text'] . '</p>
							<p class="answerDate">Дата ответа: ' . date("d-m-Y H:i:s", strtotime($result['date'])) . '</p>
						</div>';
                }
			?>
            <div class="leaveAnswer">
                <form action="" method="POST">
                    <textarea name="comment_text" placeholde="Ваш ответ"></textarea>
                    <input type="submit" name="send_answer" value="Ответить">
                </form>
            </div>
        </section>
        <?php
        
    if(isset($_POST['send_answer']))
    {
        $answer = $_POST['comment_text'];
        $author = $_SESSION['user']['surname'] . ' ' . $_SESSION['user']['name'];
        $date = date('Y-m-d H:i:s');
        $theme_id = $_GET['id'];
        $result = mysqli_query($connect, "INSERT INTO `answers` (author, text, theme_id, date) VALUES ('$author', '$answer', '$theme_id', '$date')");
    }
        ?>
</body>
</html>