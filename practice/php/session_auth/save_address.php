<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
            if (isset($_SESSION['user_id']) && (time() - $_SESSION['loggedin_time'] < 3600))
            {
                        // Database bağlantısı
                        $conn = new mysqli("localhost", "root", "", "simple_web_app");
                        if ($conn->connect_error)
                        {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Post verilerini al
                        if(isset($_POST['address']))
                        {
                            $address = $conn->real_escape_string($_POST['address']);
                        }

                        $user_id = $_SESSION['user_id'];





                        $exist_address = "SELECT address FROM addresses WHERE user_id = '$user_id'";;
                        $result_of_address = $conn->query($exist_address);
                        $row_of_address = $result_of_address->fetch_assoc();

                        // Adresi database'e kaydet
                        if(isset($_POST['address']))
                        {
                               if(strlen($_POST['address']) > 0 and $row_of_address["address"] === null)
                               {
                                  $sql = "INSERT INTO addresses (user_id, address) VALUES ('$user_id', '$address')";

                                   if ($conn->query($sql) === TRUE)
                                   {
                                       echo "New address record created successfully";
                                   }

                                   else
                                   {
                                       echo "Error: " . $sql . "<br>" . $conn->error;
                                   }


                               }

                               else
                               {
                               echo "Lütfen bir adres giriniz.";
                               }
                        }



                        $conn->close();
            }

            else
            {
                echo "Please login to continue";
                header("Location: login.php");
            }
            ?>

}

<!DOCTYPE html>
<html>
<head>
    <title>Save Address</title>
</head>
<body>
    <form action="" method="post">
        Address: <textarea name="address"></textarea><br>
        <input type="submit" value="Save Address">
    </form>
</body>
</html>