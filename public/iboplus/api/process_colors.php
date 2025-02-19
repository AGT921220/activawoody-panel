<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe a mensagem e as cores do formulário
    $message = trim($_POST['message']);
    $color1 = trim($_POST['color1']);
    $color2 = trim($_POST['color2']);
    $color3 = trim($_POST['color3']);

    // Valida as cores (opcional)
    if (!preg_match('/^#[a-fA-F0-9]{6}$/', $color1) ||
        !preg_match('/^#[a-fA-F0-9]{6}$/', $color2) ||
        !preg_match('/^#[a-fA-F0-9]{6}$/', $color3)) {
        echo "As cores fornecidas não são válidas.";
        exit;
    }

    // Define o caminho para o arquivo de texto
    $file_path = "cores.txt";

    // Conteúdo a ser escrito no arquivo
    $content = $message . PHP_EOL . $color1 . PHP_EOL . $color2 . PHP_EOL . $color3 . PHP_EOL;

    // Escreve a mensagem e as cores no arquivo
    if (file_put_contents($file_path, $content) !== false) {
        echo "Mensagem e cores salvas com sucesso!";
    } else {
        echo "Falha ao salvar a mensagem e as cores.";
    }
}
?>
