<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.7.2/jquery.min.js" 
            integrity="sha512-poSrvjfoBHxVw5Q2awEsya5daC0p00C8SKN74aVJrs7XLeZAi+3+13ahRhHm8zdAFbI2+/SUIrKYLvGBJf9H3A==" 
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <ul>
        <?php
        session_start();
            if($_SESSION['user']['role'] == 1) {
        ?>
        <li><a href="../../routes/route.php?page=user&sub=manageuser">Manage User</a></li>
        <?php
            } elseif($_SESSION['user']['role'] == 2) {
        ?>
        <li><a href="">Upload TA</a></li>
        <?php
            }
        ?>
    </ul>
</body>
</html>