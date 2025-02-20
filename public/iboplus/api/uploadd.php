<?php
// Verifica se o formulário de upload foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Diretório onde os banners são armazenados
    $directory = "api/uploads";

    // Verifica se o diretório de uploads existe e é gravável
    if (!is_dir($directory) || !is_writable($directory)) {
        die("O diretório de uploads não existe ou não é gravável.");
    }

    // Verifica se o título do banner foi fornecido
    if (isset($_POST["title"])) {
        $title = $_POST["title"];
        $filename = $_FILES["banner"]["name"];
        $target = $directory . basename($title . ".jpg"); // Nome do arquivo final

        // Move o arquivo enviado para o diretório de uploads
        if (move_uploaded_file($_FILES["banner"]["tmp_name"], $target)) {
            // Redireciona para fundo.php após o upload bem-sucedido
            header("Location: fundo.php");
            exit(); // Certifica-se de que o script não continue após o redirecionamento
        } else {
            echo "Erro ao fazer upload do arquivo.";
        }
    } else {
        echo "Título do banner não foi fornecido.";
    }
}
?>
