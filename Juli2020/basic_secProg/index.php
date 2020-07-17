<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web demo</title>
</head>
<body>
    <?php
        session_start();

        if(isset($_SESSION['username']))
        {
            header('Location: ./home.php');
            exit();
        }
    ?>
    <a href="./login.php">Login</a>
    <p>OR</p>
    <a href="./register.php">Register</a>
</body>
</html>