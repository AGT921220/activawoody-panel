<?php
// Verifica se o formulário de upload foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Diretório onde os banners são armazenados
    $directory = "./api/logo/";

    // Verifica se o diretório de uploads existe e é gravável
    if (!is_dir($directory) || !is_writable($directory)) {
        die("O diretório de uploads não existe ou não é gravável.");
    }

    // Verifica se o título do banner foi fornecido
    if (!empty($_FILES["banner"]["name"])) {
        // Obtém o nome do arquivo enviado
        $filename = $_FILES["banner"]["name"];
        
        // Define um nome simples para o arquivo
        $simple_name = uniqid() . ".jpg";
        
        // Caminho completo para o arquivo de destino
        $target = $directory . $simple_name;

        // Move o arquivo enviado para o diretório de uploads
        if (move_uploaded_file($_FILES["banner"]["tmp_name"], $target)) {
            // Redireciona para logo.php após o upload bem-sucedido
            header("Location: logo.php");
            exit(); // Certifica-se de que o script não continue após o redirecionamento
        } else {
            echo "Erro ao fazer upload do arquivo.";
        }
    } else {
        echo "Título do banner não foi fornecido.";
    }
}
?>
