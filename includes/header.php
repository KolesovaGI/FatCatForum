<header>
    <div class="container">
        <div class="date">Новосибирск, <?php echo date('d.m.Y')?></div>
        <div class="username">
            <?= $_SESSION['user']['surname'] . ' ' . $_SESSION['user']['name'];?>
            <a href="../includes/logout.php" class="logout">Выйти</a>
        </div>
    </div>
</header>