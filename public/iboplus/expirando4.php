<?php
include('includes/header.php');

// Nome da tabela
$table_name = "playlist";

// Chamada da tabela
$res = json_decode(file_get_contents('data.json'), true);

// Função para calcular a diferença de dias entre duas datas (somente a data, sem hora)
function diasRestantes($dataVencimento) {
    $vencimento = new DateTime($dataVencimento);
    $hoje = new DateTime();
    
    // Zerar horas para evitar diferenças de tempo
    $hoje->setTime(0, 0);
    $vencimento->setTime(0, 0);
    
    return $hoje->diff($vencimento)->days;
}

// Categoriza clientes de acordo com o vencimento
$clientesHoje = array_filter($res, function($user) {
    return diasRestantes($user['expiration']) == 0;
});
$clientes1Dia = array_filter($res, function($user) {
    return diasRestantes($user['expiration']) == 1;
});
$clientes3Dias = array_filter($res, function($user) {
    return diasRestantes($user['expiration']) == 3;
});
$clientes5Dias = array_filter($res, function($user) {
    return diasRestantes($user['expiration']) == 5;
});

// Aumentar 1 mês no vencimento
if (isset($_GET['renew'])) {
    $id = $_GET['renew'] - 1;
    $vencimentoAtual = new DateTime($res[$id]['expiration']);
    $vencimentoAtual->modify('+1 month');
    $res[$id]['expiration'] = $vencimentoAtual->format('Y-m-d');
    file_put_contents('data.json', json_encode($res)); // Salva no JSON
    echo "<script>window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?status=3'</script>";
}
?>

<style>
    /* Estilo geral */
    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .section-title {
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .client-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
    }

    .actions .btn {
        font-size: 0.9rem;
        margin-right: 10px;
    }

    .bg-danger { background-color: #e74c3c !important; }
    .bg-warning { background-color: #f39c12 !important; }
    .bg-primary { background-color: #3498db !important; }
    .bg-success { background-color: #2ecc71 !important; }
    .text-white { color: white !important; }

    .text-danger { color: #e74c3c; }
    .text-warning { color: #f39c12; }
    .text-primary { color: #3498db; }
    .text-success { color: #2ecc71; }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Clientes Próximos do Vencimento</h2>
            
            <!-- Hoje -->
            <?php if (!empty($clientesHoje)) { ?>
                <div class="section-title bg-danger text-white text-center p-3 mb-4">
                    <h4>Vencendo Hoje</h4>
                </div>
                <div class="clients-list mb-5">
                    <?php foreach ($clientesHoje as $key => $user) { ?>
                        <div class="client-card bg-light p-4 mb-3">
                            <h5 class="text-danger"><?= $user['name'] ?></h5>
                            <p><strong>Vencimento:</strong> <?= (new DateTime($user['expiration']))->format('d/m/Y') ?></p>
                            <div class="actions">
                                <a href="?renew=<?= $key + 1 ?>" class="btn btn-success btn-sm">Renovar</a>
                                <a href="https://wa.me/55<?= preg_replace('/\D/', '', $user['whatsapp']) ?>?text=Olá%20<?= urlencode($user['name']) ?>,%20seu%20plano%20vence%20<?= urlencode((new DateTime($user['expiration']))->format('d/m/Y')) ?>.%20Não%20deixe%20de%20renovar%20seu%20acesso." target="_blank" class="btn btn-info btn-sm">WhatsApp</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <!-- 1 Dia -->
            <?php if (!empty($clientes1Dia)) { ?>
                <div class="section-title bg-warning text-white text-center p-3 mb-4">
                    <h4>Vencendo em 1 Dia</h4>
                </div>
                <div class="clients-list mb-5">
                    <?php foreach ($clientes1Dia as $key => $user) { ?>
                        <div class="client-card bg-light p-4 mb-3">
                            <h5 class="text-warning"><?= $user['name'] ?></h5>
                            <p><strong>Vencimento:</strong> <?= (new DateTime($user['expiration']))->format('d/m/Y') ?></p>
                            <div class="actions">
                                <a href="?renew=<?= $key + 1 ?>" class="btn btn-success btn-sm">Renovar</a>
                                <a href="https://wa.me/55<?= preg_replace('/\D/', '', $user['whatsapp']) ?>?text=Olá%20<?= urlencode($user['name']) ?>,%20seu%20plano%20vence%20<?= urlencode((new DateTime($user['expiration']))->format('d/m/Y')) ?>.%20Não%20deixe%20de%20renovar%20seu%20acesso." target="_blank" class="btn btn-info btn-sm">WhatsApp</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <!-- 3 Dias -->
            <?php if (!empty($clientes3Dias)) { ?>
                <div class="section-title bg-primary text-white text-center p-3 mb-4">
                    <h4>Vencendo em 3 Dias</h4>
                </div>
                <div class="clients-list mb-5">
                    <?php foreach ($clientes3Dias as $key => $user) { ?>
                        <div class="client-card bg-light p-4 mb-3">
                            <h5 class="text-primary"><?= $user['name'] ?></h5>
                            <p><strong>Vencimento:</strong> <?= (new DateTime($user['expiration']))->format('d/m/Y') ?></p>
                            <div class="actions">
                                <a href="?renew=<?= $key + 1 ?>" class="btn btn-success btn-sm">Renovar</a>
                                <a href="https://wa.me/55<?= preg_replace('/\D/', '', $user['whatsapp']) ?>?text=Olá%20<?= urlencode($user['name']) ?>,%20seu%20plano%20vence%20<?= urlencode((new DateTime($user['expiration']))->format('d/m/Y')) ?>.%20Não%20deixe%20de%20renovar%20seu%20acesso." target="_blank" class="btn btn-info btn-sm">WhatsApp</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <!-- 5 Dias -->
            <?php if (!empty($clientes5Dias)) { ?>
                <div class="section-title bg-success text-white text-center p-3 mb-4">
                    <h4>Vencendo em 5 Dias</h4>
                </div>
                <div class="clients-list mb-5">
                    <?php foreach ($clientes5Dias as $key => $user) { ?>
                        <div class="client-card bg-light p-4 mb-3">
                            <h5 class="text-success"><?= $user['name'] ?></h5>
                            <p><strong>Vencimento:</strong> <?= (new DateTime($user['expiration']))->format('d/m/Y') ?></p>
                            <div class="actions">
                                <a href="?renew=<?= $key + 1 ?>" class="btn btn-success btn-sm">Renovar</a>
                                <a href="https://wa.me/55<?= preg_replace('/\D/', '', $user['whatsapp']) ?>?text=Olá%20<?= urlencode($user['name']) ?>,%20seu%20plano%20vence%20<?= urlencode((new DateTime($user['expiration']))->format('d/m/Y')) ?>.%20Não%20deixe%20de%20renovar%20seu%20acesso." target="_blank" class="btn btn-info btn-sm">WhatsApp</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
