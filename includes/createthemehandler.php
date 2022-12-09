<?php
    session_start();
    require_once 'connection.php';

    $title = $_POST['title'];
    $text = $_POST['text'];
    $user_id = $_SESSION['user']['id'];
    $date = date('Y-m-d H:i:s');

    $stmt = $connect->prepare("INSERT INTO `themes` (title, text, user_id, date) VALUES ('?', '?', '?', '?')");
    $stmt->bind_param("ssss", $title, $text, $user_id, $date);
    $stmt->execute();
    $stmt->bind_result($result);

    $stmt->fetch();

    if($result)
    {
        header('Location: ../pages/forum.php');
    }
?>