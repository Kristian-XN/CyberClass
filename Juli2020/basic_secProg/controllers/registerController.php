<?php
    require_once './../db/db.php';

    if($_SERVER['REQUEST_METHOD'] === "POST")
    {
        if($_POST['token'] == $_SESSION['token'])
        {
            if($_POST['username'] !== '' && $_POST['email'] !== '' && $_POST['passwd'] !== '')
            {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $passwd = password_hash($_POST['passwd'], PASSWORD_BCRYPT);
    
                $stmt = $conn->prepare("SELECT * FROM credentials WHERE username=? OR email=?");
                $stmt->bind_param("ss", $username, $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
    
                if($result->num_rows > 0)
                {
                    $_SESSION['error'] = 'Duplicate data found';
                    header('Location: ./../register.php');
                    exit();
                }
    
                // // vuln to SQLi
                // $res = $conn->query("INSERT INTO credentials(username, email, passwd) VALUES('$username', '$email', '$passwd')");
    
                $stmt = $conn->prepare("INSERT INTO credentials(username, email, passwd) VALUES(?,?,?)");
                $stmt->bind_param("sss", $username, $email, $passwd);
                $stmt->execute();
                $stmt->close();
    
                header('Location: ./../login.php');
                exit();
            }
            else
            {
                $_SESSION['error'] = "Please fill all form";
                exit();
            }
        }
    }
    header('Location: ./../register.php');
?>
