<?php
    require_once './../db/db.php';

    if($_SERVER['REQUEST_METHOD'] === "POST")
    {
        if($_POST['token'] === $_SESSION['token'])
        {
            if($_POST['username'] !== '' && $_POST['passwd'] !== '')
            {
                $username = $_POST['username'];
                $passwd = $_POST['passwd'];
    
                $stmt = $conn->prepare("SELECT * FROM credentials WHERE username=?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
    
                if($result->num_rows == 0)
                {
                    $_SESSION['error'] = 'User not exist';
                    header('Location: ./../login.php');
                    exit();
                }            
    
                $usr = $result->fetch_assoc();
                if(password_verify($passwd, $usr['passwd']))
                {
                    // mencegah session fixation
                    session_regenerate_id(true);
    
                    // terautentikasi
                    $_SESSION['username'] = $usr['username'];
                    $_SESSION['time'] = time();
    
                    header('Location: ./../home.php');
                    exit();
                }
                else
                {
                    $_SESSION['error'] = 'Wrong username or password';
                    header('Location: ./../login.php');
                    exit();
                }
            }
            else
            {
                $_SESSION['error'] = "Please fill all form";
                header('Location: ./../login.php');
                exit();
            }
        }
    }
    header('Location: ./../login.php');
?>
