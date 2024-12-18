<?php
// Define o cabeçalho para JSON
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Capturar os dados do formulário
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));

    // Validação básica
    if (empty($name) || empty($email) || empty($subject)) {
        // Retorna um JSON de erro se algum campo estiver vazio
        echo json_encode(['success' => false, 'message' => 'Por favor, preencha todos os campos.']);
        exit;
    }

    // Validação de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Retorna um JSON de erro se o email for inválido
        echo json_encode(['success' => false, 'message' => 'Por favor, insira um email válido.']);
        exit;
    }

    // Montar os dados para salvar no arquivo
    $data = "$name|$email|$subject\n";

    // Salvar os dados em um arquivo texto
    $file = __DIR__ . '/mensagens/mensagens.txt';
    if (file_put_contents($file, $data, FILE_APPEND)) {
        // Retorna um JSON de sucesso se os dados forem salvos com sucesso
        echo json_encode(['success' => true, 'message' => 'Mensagem salva com sucesso. Obrigado por entrar em contato!']);
    } else {
        // Retorna um JSON de erro caso haja um problema ao salvar os dados
        echo json_encode(['success' => false, 'message' => 'Houve um erro ao salvar sua mensagem. Tente novamente mais tarde.']);
    }
} else {
    // Retorna um JSON de erro caso o método não seja POST
    echo json_encode(['success' => false, 'message' => 'Método de envio inválido.']);
}
?>
