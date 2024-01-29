<?php
session_start();
if (isset($_SESSION['user_id']) && (time() - $_SESSION['loggedin_time'] < 3600))
{
            // Database bağlantısı
            $conn = new mysqli("localhost", "root", "", "simple_web_app");
            if ($conn->connect_error)
            {
                die("Connection failed: " . $conn->connect_error);
            }

            $user_id = $_SESSION['user_id'];


            // Kullanıcının adreslerini çek
            $sql = "SELECT address FROM addresses WHERE user_id = '$user_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    echo "Address: " . $row["address"]. "<br>";
                }
            }

            else
            {
                        $mesaj = "Adres sayfasına yönlendiriliyorsunuz...";
                        // Hedef sayfaya yönlendirme yap
                        header("Location: save_address.html?mesaj=" . urlencode($mesaj));
            }

            $conn->close();

}




else
{
        echo "Please login to continue";
        header("Location: login.php");
}


?>

