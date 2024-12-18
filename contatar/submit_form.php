<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Capturar os dados do formulário
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));

    // Validação básica
    if (empty($name) || empty($email) || empty($subject)) {
        echo "<p style='color: red;'>Por favor, preencha todos os campos.</p>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color: red;'>Por favor, insira um email válido.</p>";
        exit;
    }

    // Montar os dados para salvar no arquivo
    $data = "Nome: $name\nEmail: $email\nAssunto: $subject\n---\n";

    // Salvar os dados em um arquivo texto
    $file = 'contatar\mensagens.txt'; // Nome do arquivo onde os dados serão armazenados
    if (file_put_contents($file, $data, FILE_APPEND)) {
        echo "<p style='color: green;'>Mensagem salva com sucesso. Obrigado por entrar em contato!</p>";
    } else {
        echo "<p style='color: red;'>Houve um erro ao salvar sua mensagem. Tente novamente mais tarde.</p>";
    }
} else {
    echo "<p style='color: red;'>Método de envio inválido.</p>";
}
?>
