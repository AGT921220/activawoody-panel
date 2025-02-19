<?php
// Remova a configuração para mostrar os erros
// ini_set('display_errors', 0);
include('includes/header.php');

// Função para obter a última opção salva
function obterUltimaOpcao()
{
    $arquivo = "./api/ultima_opcaofundo.txt";
    if (file_exists($arquivo)) {
        return file_get_contents($arquivo);
    } else {
        return "";
    }
}

// Função para obter o rótulo da opção selecionada
function obterRotuloOpcao($opcao)
{
    switch ($opcao) {
        case 'autoads.php':
            return 'Automático';
        case 'main_movies.php':
            return 'Automático 2';
        case 'autocima.php':
            return 'Automático 3';
        case 'autop.php':
            return 'Automático 4 para banner pequeno';
             case 'autosinopsebaixo.php':
            return 'Automatico 5.';
        case 'menads.php':
            return 'Manual';
        case 'pagina.php':
            return 'Página web';
        case 'note.php':
            return 'Banner com mensagem.';
            case 'autosinopsecima.php':
            return 'Automatico 6.';
            case 'autosinopselado.php':
            return 'Automatico 7.';
    }
}

// Função para obter o link da imagem para cada opção
function obterLinkImagem($opcao)
{
    // Insira o link da imagem correspondente a cada opção
    switch ($opcao) {
        case 'autoads.php':
            return 'https://i.imgur.com/VWkonfC.jpeg';
        case 'main_movies.php':
            return 'https://i.imgur.com/2rX1U7z.jpeg';
        case 'autocima.php':
            return 'https://i.imgur.com/00JWjLa.jpeg';
        case 'autop.php':
            return 'https://i.imgur.com/n4fzoTY.jpeg';
        case 'menads.php':
            return 'https://i.imgur.com/r5bVG7s.jpeg';
        case 'pagina.php':
            return 'https://i.imgur.com/DW6Mc64.jpeg';
        case 'note.php':
            return 'https://i.imgur.com/8PWHhYe.jpeg';
        case 'autosinopsebaixo.php':
            return 'https://i.imgur.com/r2yTp8u.jpeg';
            case 'autosinopsecima.php':
            return 'https://i.imgur.com/j9NtXmf.jpeg';
            case 'autosinopselado.php':
            return 'https://i.imgur.com/d3Ax5Ba.jpeg';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Salva a opção selecionada em um arquivo chamado "opcaofundo.txt"
    $opcao_selecionada = $_POST["opcoes"];
    file_put_contents("./api/opcaofundo.txt", $opcao_selecionada);

    // Salva a opção selecionada como última opção em um arquivo "ultima_opcao.txt"
    file_put_contents("./api/ultima_opcaofundo.txt", $opcao_selecionada);

    // Se a opção selecionada for "Banner com mensagem", redireciona para mRTXinAppText.php
    if ($opcao_selecionada === 'note.php') {
        echo '<meta http-equiv="refresh" content="0; URL=mRTXinAppText.php">';
        exit; // Certifique-se de sair do script após o redirecionamento
    }
    // Se a opção selecionada for "Página web", redireciona para site.php
    elseif ($opcao_selecionada === 'pagina.php') {
        echo '<meta http-equiv="refresh" content="0; URL=site.php">';
        exit; // Certifique-se de sair do script após o redirecionamento
    }
    // Se a opção selecionada for "Manual", redireciona para fundo.php
    elseif ($opcao_selecionada === 'menads.php') {
        echo '<meta http-equiv="refresh" content="0; URL=fundo.php">';
        exit; // Certifique-se de sair do script após o redirecionamento
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Opções de Banner</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <style>
  
    /* Estilos básicos */
    body {
      font-family: 'Arial', sans-serif;
      font-size: 16px;
      color: #333;
      background-color: #f5f5f5;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }

    .card-header {
      background-color: #007bff;
      color: #fff;
      border-radius: 10px 10px 0 0;
      padding: 20px;
      text-align: center;
    }

    .card-body {
      padding: 20px;
    }

    .h2 {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .filter-container {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .filter-input {
      width: 200px;
      margin-right: 10px;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
      color: #fff;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }

    .opcao-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .opcao-item {
      width: 300px;
      margin-bottom: 20px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      text-align: center;
      cursor: pointer;
    }

    .opcao-item:hover {
      background-color: #f0f0f0;
    }

    .opcao-item img {
      display: block;
      margin: auto;
      margin-top: 10px;
      width: 250px;
    }

    .opcao-item h4 {
      font-size: 18px;
      font-weight: bold;
      margin-top: 10px;
    }

    .opcao-item p {
      margin-top: 5px;
      color: #666;
    }

    .opcao-selecionada {
      font-weight: bold;
      margin-top: 10px;
      text-align: center;
    }

    .radio-label {
      font-weight: normal;
    }

    .form-check-input {
      margin-right: 10px;
    }

    .form-check {
      margin-bottom: 10px;
    }

    .pagination {
      justify-content: center;
      margin-top: 20px;
    }

    .pagination .page-item {
      margin: 0 5px;
    }


    </style>
</head>

<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Tipo de banner</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="opcao-container">
                            <?php
                            $opcoes = [
                                'autoads.php' => 'Automático.',
                                'main_movies.php' => 'Automático 2.',
                                'autocima.php' => 'Automático 3.',
                                'autop.php' => 'Automático 4 para banner pequeno.',
                                'autosinopsebaixo.php' => 'Automático 5.',
                                'autosinopsecima.php' => 'Automático 6.',
                                'autosinopselado.php' => 'Automático 7 para icones em baixo.',
                                'note.php' => 'Banner com mensagem.',
                                'menads.php' => 'Manual.',
                                'pagina.php' => 'Página web.'
                            ];
                            ?>
                            <?php foreach ($opcoes as $valor => $rotulo) : ?>
                                <div class="opcao-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="opcoes" id="<?php echo $valor; ?>" value="<?php echo $valor; ?>" <?php if (obterUltimaOpcao() === $valor) echo 'checked'; ?>>
                                        <label class="form-check-label radio-label" for="<?php echo $valor; ?>">
                                            <?php echo $rotulo; ?>
                                        </label>
                                        <br>
                                        <?php $link_imagem = obterLinkImagem($valor); ?>
                                        <img src="<?php echo $link_imagem; ?>" alt="Imagem de exemplo">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Salvar</button>
                        <!-- Exibe a última opção selecionada -->
                        <?php $ultima_opcao = obterUltimaOpcao(); ?>
                        <?php if (!empty($ultima_opcao)) : ?>
                            <p class="opcao-selecionada">Última opção selecionada: <?php echo obterRotuloOpcao($ultima_opcao); ?></p>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
