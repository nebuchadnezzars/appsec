<?php
// Session'ı başlat
session_start();

// Session'ı yok et (kapat)
session_destroy();

// Kullanıcıyı başka bir sayfaya yönlendirme (örneğin, ana sayfa)
header("Location: login.php");
exit();
?>
