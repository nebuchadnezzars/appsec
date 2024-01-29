<?php
session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
                    // Database bağlantısı
                    $conn = new mysqli("localhost", "root", "", "simple_web_app");
                    if ($conn->connect_error)
                    {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Post verilerini al
                    $username = $conn->real_escape_string($_POST['username']);
                    $password = $conn->real_escape_string($_POST['password']);

                    // Kullanıcıyı doğrula
                    $sql = "SELECT id, password FROM users WHERE username = '$username'";
                    $result = $conn->query($sql);


                    if ($result->num_rows > 0)
                    {
                        $row = $result->fetch_assoc();
                        if (password_verify($password, $row['password']))
                        {
                            // Session oluştur
                            $_SESSION['user_id'] = $row['id'];
                            $_SESSION['loggedin_time'] = time();

                            echo "Login successful";
                            header("Location: index.php");
                            exit; // Yönlendirme işleminden sonra kodun devam etmemesi için exit()
                        }

                        else
                        {
                                echo "Invalid password";
                        }
                    }

                     else
                     {
                        echo "Invalid username";
                     }

                    $conn->close();
        }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h1>Login</h1>
    <form action="" method="post">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
</br></br></br>
</body>


</html>

