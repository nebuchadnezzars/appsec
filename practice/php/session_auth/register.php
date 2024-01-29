<?php
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

        // Parolayı hashle
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Kullanıcıyı database'e kaydet
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

        if ($conn->query($sql) === TRUE)
        {
            echo "New record created successfully";
        }

        else
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
</head>
<body>

<h1>Register</h1>
<form action="" method="post">
  Username: <input type="text" name="username"><br>
  Password: <input type="password" name="password"><br>
  <input type="submit" value="Register">
</form>

</body>
</html>

