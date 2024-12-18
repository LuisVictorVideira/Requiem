<?php
session_start();
session_destroy(); // Destruir a sessão
header('Location: contatar\login.php'); // Redirecionar para o login
exit;
?>
