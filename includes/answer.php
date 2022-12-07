<?php
    session_start();
    require 'connection.php';   // Соединение с БД

    $answer = $_GET['comment_text'];
    $author = $_SESSION['user']['surname'] . ' ' . $_SESSION['user']['name'];
    $date = date('Y-m-d H:i:s');

	$sql = "INSERT INTO `answers` (author, text, theme_id, date) VALUES ('$author', '$answer', '1', '$date')";  // Добавление комментария в БД
	$result = mysqli_query($connect, $sql);

	if($result)
    {
        header('Location: ../pages/theme.php?id=1');
    } 
    else
    {
        echo "Ошибка " . mysqli_error($connect);
    }
?>