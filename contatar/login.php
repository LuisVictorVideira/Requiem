<?php
session_start();

// Verificar se o usuário já está logado
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    header('Location: exibir_mensagens.php'); // Redireciona para a página protegida
    exit;
}

// Processar o formulário
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Credenciais válidas
    $valid_username = "admin";
    $hashed_password = '$2y$10$Hdyh/o6MJzPlIvzo1JJT4O4QlbTASdQDksCvJ2x1G88QPoHO3eJuq'; // Substitua pelo hash gerado

    if ($username === $valid_username && password_verify($password, $hashed_password)) {
        $_SESSION['authenticated'] = true;
        header('Location: exibir_mensagens.php');
        exit;
    } else {
        $error = "Usuário ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="post">
        <label for="username">Usuário:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
