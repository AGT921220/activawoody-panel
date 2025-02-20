<?php
include('includes/header.php');

// Função para obter a última opção salva
function obterUltimaOpcao()
{
    $arquivo = "./api/ultima_opcao1.txt";
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
        case 'siteesportes.php':
            return 'Pagina.';
        case 'menadss.php':
            return 'Manual.';
    }
}

// Função para obter o link da imagem para cada opção
function obterLinkImagem($opcao)
{
    switch ($opcao) {
        case 'menadss.php':
            return 'https://i.imgur.com/r5bVG7s.jpeg';
        case 'paginaesportes.php': // Corrigido para coincidir com o valor no formulário
            return 'https://i.imgur.com/DW6Mc64.jpeg';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $opcao_selecionada = $_POST["opcoes"];
    file_put_contents("./api/opcao12.txt", $opcao_selecionada);
    file_put_contents("./api/ultima_opcao12.txt", $opcao_selecionada);

    if ($opcao_selecionada === 'note.php') {
        echo '<meta http-equiv="refresh" content="0; URL=mRTXinAppText.php">';
        exit;
    } elseif ($opcao_selecionada === 'paginaesportes.php') {
        echo '<meta http-equiv="refresh" content="0; URL=siteesportes.php">';
        exit;
    } elseif ($opcao_selecionada === 'menads.php') {
        echo '<meta http-equiv="refresh" content="0; URL=fundoo.php">';
        exit;
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
    body {
      font-family: 'Arial', sans-serif;
      font-size: 16px;
      color: #333;
      background-color: #f5f5f5;
    }
    #sidebar-wrapper {
      background-color: #343a40;
      color: #ffffff;
      height: 100%;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1000;
      overflow-y: auto;
    }
    .sidebar-heading {
      text-align: center;
      font-size: 1.5em;
      margin: 1em 0;
      color: #ffffff;
    }
    .list-group-item {
      background-color: #343a40;
      color: #ffffff;
      border: none;
      border-radius: 0;
      padding: 15px;
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
    .opcao-item img {
      display: block;
      margin: auto;
      margin-top: 10px;
      width: 250px;
    }
    .opcao-item:hover {
      background-color: #f0f0f0;
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
    .opcao-selecionada {
      font-weight: bold;
      margin-top: 10px;
      text-align: center;
    }
    .pagination {
      justify-content: center;
      margin-top: 20px;
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
                                'menadss.php' => 'Manual.',
                                'paginaesportes.php' => 'Página web.'
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
