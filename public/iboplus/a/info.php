<?php
// Definindo as configurações de exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexão com o banco de dados SQLite
try {
    $db = new SQLite3('a/.eggziedb.db');
} catch (Exception $e) {
    // Se houver um erro ao abrir o banco de dados, exibe a mensagem de erro e encerra o script
    die('Erro ao abrir o banco de dados: ' . $e->getMessage());
}

// Consulta para obter os registros que estão próximos ao vencimento em 5 dias
$consulta_registros = $db->query("SELECT * FROM ibo WHERE expire_date <= date('now', '+5 days') ORDER BY id ASC");

// Data de hoje
$hoje = date('Y-m-d');

// Contagem de registros
$total_registros = 0;
while ($consulta_registros->fetchArray()) {
    $total_registros++;
}

// Reinicie a consulta para exibir os resultados
$consulta_registros->reset();

// Inclui o cabeçalho
include 'includes/header.php';
?>
<main role="main" class="container pt-4">
    <div class="row justify-content-center">
        <div class="col-12 mb-2 text-center">
            <img src="vencimento.png" alt="Imagem" class="img-fluid" style="max-width: 150px; max-height: 150px;">
        </div>
        <div class="col-12 text-center">
            <h1 class="h3 mb-1 text-gray-800">Informações (<?php echo $total_registros; ?>)</h1>
        </div>
    </div>
    <div class="table-responsive">
        <!-- Tabela para exibir os registros -->
        <ul class="list-group">
            <?php
            while ($registro = $consulta_registros->fetchArray()) {
                // Obtém os dados de cada registro
                $mac_address = $registro['mac_address'];
                $username = $registro['username'];
                $expire_date = $registro['expire_date'];
                $expired = $expire_date < $hoje;
                $url = $registro['url']; // Obtém a URL diretamente

                // Calcula a diferença de tempo em segundos
                $diff_in_seconds = strtotime($expire_date) - strtotime($hoje);
                // Calcula o número de segundos em 5 dias
                $five_days_in_seconds = 5 * 24 * 60 * 60;
            ?>
                <li class="list-group-item">
                    <!-- Exibe as informações de cada registro -->
                    <div class="row">
                        <div class="col-12">
                            <strong class="text-danger">MAC Address: </strong><?php echo $mac_address; ?><br>
                            <strong>Usuário: </strong><?php echo $username; ?><br>
                            <strong>Expiração: </strong><?php echo $expire_date; ?><br>
                            <strong>Status: </strong><span class="<?php echo $expired ? 'text-danger' : 'text-success'; ?>"><?php echo $expired ? 'Expirado' : 'Ativo'; ?></span><br>
                            <strong>DNS: </strong><?php echo $url; ?>
                            <?php if (!$expired && $diff_in_seconds <= $five_days_in_seconds): ?>
                                <br><span class="text-primary"> - <strong>Vencimento em 5 dias.</strong></span>
                            <?php endif; ?>
                            <?php if ($expired): ?>
                                <div class="text-center mt-2">
                                    <a href="users.php" class="btn btn-primary">
                                        <i class="fas fa-check-circle mr-1"></i>Renovar
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</main>

<br><br><br>
<?php
// Inclui o rodapé e outros arquivos necessários
include 'includes/footer.php';
require 'includes/egz.php';
?>
