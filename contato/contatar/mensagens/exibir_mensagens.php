<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: login.php'); // Redireciona para o login se não estiver autenticado
    exit;
}



// Caminho para o arquivo de mensagens
$file = __DIR__ . '/mensagens.txt';
$table_rows = '';

// Verificar se o arquivo existe e contém dados
if (file_exists($file)) {
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Dividir os dados pelo separador "|"
        $fields = explode('|', $line);
        if (count($fields) === 3) { // Garantir que há 3 campos: Nome, Email, Mensagem
            $name = htmlspecialchars($fields[0]);
            $email = htmlspecialchars($fields[1]);
            $message = htmlspecialchars($fields[2]);
            $table_rows .= "<tr><td>{$name}</td><td>{$email}</td><td>{$message}</td></tr>";
        }
    }
}

// Caso não haja mensagens
if (empty($table_rows)) {
    $table_rows = '<tr><td colspan="3">Nenhuma mensagem salva ainda.</td></tr>';
}

// Carregar o template HTML
$template = file_get_contents(__DIR__ . '/exibir_mensagens_template.html');

// Substituir a tag {{table_rows}} pelo conteúdo dinâmico
$output = str_replace('{{table_rows}}', $table_rows, $template);

// Exibir a página completa
echo $output;

?>
