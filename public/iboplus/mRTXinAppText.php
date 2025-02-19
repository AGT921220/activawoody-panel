<?php
ini_set('display_errors', 0);
include('includes/header.php');

// Caminho para o arquivo de texto
$file_path = "./ad_descriptions.txt";

// Inicializa as variáveis para armazenar o conteúdo do arquivo e a cor do texto
$file_content = "";
$text_color = "";

// Verifica se o arquivo existe antes de tentar lê-lo
if (file_exists($file_path)) {
    // Lê o conteúdo do arquivo e armazena na variável $file_content
    $file_content = file_get_contents($file_path);

    // Divide o conteúdo do arquivo em linhas
    $lines = explode("\n", $file_content);

    // Atribui o valor da cor da última linha ao $text_color
    if (count($lines) > 1) {
        $text_color = $lines[count($lines) - 1];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Atualiza a cor do texto com base no valor enviado pelo formulário
    $text_color = $_POST["text_color"];

    // Atualiza o conteúdo do arquivo com a nova descrição e cor
    $ad_description = $_POST["ad_item"];

    if (empty($ad_description)) {
        die("Por favor, insira uma descrição de anúncio.");
    }

    // Abre o arquivo para escrita
    $file = fopen($file_path, "w");

    // Escreve a descrição e a cor no arquivo
    fwrite($file, $ad_description . "\n" . $text_color . "\n");

    // Fecha o arquivo
    fclose($file);

    echo "Sucesso<br>";
}
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .card-header {
        background-color: #007bff;
        color: #fff;
        border-radius: 10px 10px 0 0;
        padding: 15px;
        text-align: center;
    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        margin-bottom: 0;
    }

    .custom-input {
        margin-bottom: 20px;
    }

    .custom-input label {
        display: block;
        margin-bottom: 5px;
    }

    .custom-input input[type="text"],
    .custom-input input[type="color"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ced4da;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .custom-input input[type="text"]:focus,
    .custom-input input[type="color"]:focus {
        border-color: #007bff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .custom-button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .custom-button:hover {
        background-color: #0056b3;
    }

    .txt-content {
        margin-top: 20px;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 5px;
        color: <?php echo $text_color; ?>;
    }

    .txt-content h3 {
        margin-top: 0;
    }

    .txt-content p {
        margin-bottom: 0;
    }
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-file-image"></i> Mensagens</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="custom-input">
                    <label for="ad_item">Adicione uma mensagem:</label>
                    <input class="form-control" type="text" name="ad_item" id="ad_item" placeholder="Exemplo: Servidor temporariamente fora do ar.">
                </div>
                <div class="custom-input">
                    <label for="text_color">Escolha a cor do texto:</label>
                    <input class="form-control" type="color" name="text_color" id="text_color">
                </div>
                <input type="submit" name="submit" value="Salvar" class="custom-button">
            </form>

            <div class="txt-content">
                <h3>Última mensagem:</h3>
                <p><?php echo $file_content; ?></p>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

</body>

</html>
