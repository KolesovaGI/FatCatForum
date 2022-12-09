<?php
    session_start();
    require 'connection.php';   // Соединение с БД

    $answer = $_GET['comment_text'];
    $author = $_SESSION['user']['surname'] . ' ' . $_SESSION['user']['name'];
    $date = date('Y-m-d H:i:s');

    $stmt = $connect->prepare("INSERT INTO `answers` (author, text, theme_id, date) VALUES ('?', '?', '1', '?')");
    $stmt->bind_param("sss", $author, $answer, $date);
    $stmt->execute();
    $stmt->bind_result($result);

    $stmt->fetch();

	if($result)
    {
        header('Location: ../pages/theme.php?id=1');
    } 
    else
    {
        echo "Ошибка " . mysqli_error($connect);
    }
?>