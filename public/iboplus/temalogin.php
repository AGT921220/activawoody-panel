<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include('includes/header.php');

// Definir o caminho para o banco de dados
$dbPath = './api/.db.db';
$db = new SQLiteWrapper($dbPath);

// Verificar se um novo tema foi selecionado
if (isset($_POST['themelog'])) {
    var_dump($_POST); // Adicione esta linha para verificar os dados enviados
    $themeData = ['themelog' => $_POST['themelog']];
    $db->update('logintheme', $themeData, 'id = :id', [':id' => 1]); // Mantém id 1 (primeira linha)
    echo "<script>window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?status=1'</script>";
}

// Buscar o tema atual no banco de dados
$result = $db->select('logintheme', 'themelog', 'id = 1', ''); // Mantém id 1 (primeira linha)
$currentThemeId = !empty($result) ? $result[0]['themelog'] : '26'; // Define default como 26

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<div class="col-md-10 mx-auto">
    <div class="card-body">
        <div class="card bg-primary text-white">
            <div class="card-header card-header-warning">
                <center><h2><i class="icon icon-bullhorn"></i> Theme Settings</h2></center>
            </div>
            <div class="card-body">
                <!-- Formulário de Seleção de Tema -->
                <form method="post">
                    <div class="form-group">
                        <label for="theme-selector">Select Theme:</label>
                        <select class="form-control" id="theme-selector" name="themelog">
                            <option value="26" <?= $currentthemelog == 26 ? 'selected' : '' ?>>Theme 26</option>
                            <option value="27" <?= $currentthemelog == 27 ? 'selected' : '' ?>>Theme 27</option>
                        </select>
                    </div>

                    <button class="btn btn-info" type="submit">
                        <i class="icon icon-check"></i> Update Theme
                    </button>
                </form>

                <!-- Miniaturas dos Temas -->
                <div class="theme-thumbnails">
                    <div class="<?= $currentthemelog == 26 ? 'selected-theme' : '' ?>">
                        <div class="theme-title">Theme 26</div>
                        <img src="img/theme_26.png" alt="Theme 26">
                        <img src="img/selected.png" alt="Selected" class="selected-indicator">
                    </div>
                    <div class="<?= $currentthemelog == 27 ? 'selected-theme' : '' ?>">
                        <div class="theme-title">Theme 27</div>
                        <img src="img/theme_27.png" alt="Theme 27">
                        <img src="img/selected.png" alt="Selected" class="selected-indicator">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<style>
.theme-thumbnails {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* Ajustado para duas colunas */
    gap: 20px;
    justify-content: center;
    margin-top: 20px;
}

.theme-thumbnails div {
    display: flex;
    flex-direction: column; /* Empilhar título e imagem verticalmente */
    align-items: center;
    justify-content: center;
    text-align: center;
    position: relative; /* Necessário para o posicionamento absoluto do indicador de seleção */
}

.theme-thumbnails .theme-title {
    font-size: 24px; /* Aumentado o tamanho da fonte */
    color: white; /* Cor da fonte branca */
    margin-bottom: 10px; /* Espaço entre o título e a imagem */
}

.theme-thumbnails img {
    max-width: 100%;
    height: auto;
    object-fit: contain; /* Garante que a imagem inteira seja visível */
}

.selected-indicator {
    position: absolute;
    bottom: 0; /* Alinha com a parte inferior do div pai */
    right: 0; /* Alinha com a direita do div pai */
    display: none; /* Escondido por padrão */
    width: 70px; /* Ajuste o tamanho conforme necessário */
    height: auto;
    z-index: 2; /* Garante que o indicador fique acima da imagem */
}

.selected-theme .selected-indicator {
    display: block; /* Exibe o indicador para o tema selecionado */
}
</style>
