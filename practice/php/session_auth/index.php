<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İşlem Seçimi</title>
</head>




<body style="text-align: center;">
<?php
        session_start();

        if ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php') //yeni ekledin
        {
            if (!isset($_SESSION['user_id']) || (time() - $_SESSION['loggedin_time'] >= 3600))
            {
                                echo "Please login to continue";
                                header("Location: login.php");
            }


        }





?>



<h1>İşlem Seçimi</h1>

<?php


if ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php') //yeni ekledin
{

                    $conn = new mysqli("localhost", "root", "", "simple_web_app");
                    if ($conn->connect_error)
                    {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $user_id = $_SESSION['user_id'];


                    // Kullanıcının adreslerini çek
                    $sql = "SELECT username FROM users WHERE id = '$user_id'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0)
                    {
                        while($row = $result->fetch_assoc())
                        {
                            echo "Hoş geldin: " . $row["username"]. "</br>";
                        }
                    }



}



?>
<button onclick="window.location.href='get_address.php'">Adres Bilgileri</button>
<button onclick="window.location.href='logout.php'">Log Out</button>
</body>


</html>
