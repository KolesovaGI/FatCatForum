<?php 
	session_start();
	if(!$_SESSION['user']){
		header('Location: ../index.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/signin.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Создать тему</title>
</head>
<body>
    <div class="wrapper">
        <form action="../includes/createthemehandler.php" method="post">
            <input type="text" name="title" placeholder="Название">
            <textarea name="text" cols="30" rows="10" placeholder="Текст..."></textarea>
            <input type="submit" value="Создать">
        </form>
    </div>
</body>
</html>