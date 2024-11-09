<?php
    session_start();
    include "../component/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <h1><?= $_SESSION['user']['email'] ?></h1>
    <a href='../../routes/route.php?page=logout'>logout</a>
</body>
</html>