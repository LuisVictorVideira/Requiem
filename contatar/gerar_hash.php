<?php
// Substitua "senha123" pela senha desejada
$password = "entranao";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
echo "Hash da senha: " . $hashed_password;
?>
