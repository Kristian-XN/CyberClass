<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <?php
        require_once './generateToken.php';
        if(isset($_SESSION['username']))
        {
            header('Location: ./home.php');
            exit();
        }
    ?>
    <a href="./index.php">back</a>
    <form action="./controllers/registerController.php" method="post">
        <label for="username">Username: </label>
        <input type="text" name="username" id="username" placeholder="Your username..."><br><br>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Your email..."><br><br>

        <label for="passwd">Password:</label>
        <input type="password" name="passwd" id="passwd" placeholder="Your password..."><br><br>

        <?php
            if(array_key_exists('error', $_SESSION))
            {
                if(isset($_SESSION['error']))
                {
        ?>
                    <p style="color: red;"><?php echo $_SESSION['error'];?></p>
        <?php
                    unset($_SESSION['error']);
                }
            }
        ?>

        <input type="hidden" name="token" value=<?php echo $_SESSION['token'];?>>

        <input type="submit" value="Submit">
    </form>
    <p>Login <a href="./register.php">here</a></p>
</body>
</html>
