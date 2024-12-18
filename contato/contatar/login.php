<?php
session_start();

// Verificar se o usuário já está logado
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    header('Location: ../contato/contatar/mensagens/exibir_mensagens.php'); // Redireciona para a página protegida
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
        header('Location: ../contato/contatar/mensagens/exibir_mensagens.php');
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
    <style>
        /* Reseta estilos padrões */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #6200ea;
        }

        label {
            font-size: 14px;
            margin-bottom: 5px;
            color: #333;
            display: block;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #6200ea;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #6200ea;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #5300c7;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form method="post">
            <label for="username">Usuário:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Senha:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Entrar</button>
        </form>
    </div>

</body>
</html>
