<?php
    session_start();
    require_once 'connection.php';

    $title = $_POST['title'];
    $text = $_POST['text'];
    $user_id = $_SESSION['user']['id'];
    $date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO `themes` (title, text, user_id, date) VALUES ('$title', '$text', '$user_id', '$date')";
    $result = mysqli_query($connect, $sql);
    
    if($result)
    {
        header('Location: ../pages/forum.php');
    }
?>