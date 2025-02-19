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
    /* Estilos aprimorados */
    .card-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    .client-card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .client-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }
    .card-header {
        padding: 10px 15px;
        font-weight: bold;
        font-size: 1.2rem;
        text-align: center;
        background-color: #007bff;
        color: white;
    }
    .card-content {
        padding: 15px;
        text-align: center;
    }
    .card-content p {
        color: #666;
        margin-bottom: 10px;
    }
    .expiration-date {
        font-weight: bold;
        color: #e74c3c;
    }
    .actions {
        display: flex;
        justify-content: center;
        gap: 10px;
    }
    .btn {
        font-size: 0.9rem;
        padding: 5px 10px;
    }
</style>

<div class="col-md-12 mx-auto">
    <div class="card-body">
        <div class="card bg-primary text-white">
            <div class="card-header card-header-warning">
                <center>
                    <h2><i class="icon icon-clock-o"></i> Clientes Próximos do Vencimento</h2>
                </center>
            </div>
            <div class="card-container">
                <?php 
                // Função para exibir cada grupo de clientes com cores
                function exibirClientes($titulo, $clientes) { 
                    if (empty($clientes)) { ?>
                        <div class="client-card">
                            <div class="card-header"><?= $titulo ?></div>
                            <div class="card-content">
                                <p>Sem clientes.</p>
                            </div>
                        </div>
                    <?php } else { 
                        foreach ($clientes as $key => $user) { ?>
                            <div class="client-card">
                                <div class="card-header"><?= $titulo ?></div>
                                <div class="card-content">
                                    <p><strong>Nome:</strong> <?= $user['name'] ?></p>
                                    <p><strong>Vencimento:</strong> <span class="expiration-date"><?= (new DateTime($user['expiration']))->format('d/m/Y') ?></span></p>
                                    <div class="actions">
                                        <a href="?renew=<?= $key + 1 ?>" class="btn btn-success">Renovar</a>
                                        <a href="https://wa.me/55<?= preg_replace('/\D/', '', $user['whatsapp']) ?>?text=Olá%20<?= urlencode($user['name']) ?>,%20seu%20plano%20vence%20<?= urlencode((new DateTime($user['expiration']))->format('d/m/Y')) ?>.%20Não%20deixe%20de%20renovar%20seu%20acesso." target="_blank" class="btn btn-info">WhatsApp</a>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    }
                }

                // Exibindo as caixas de clientes vencendo hoje, em 1 dia, 3 dias e 5 dias
                exibirClientes("Vencendo Hoje", $clientesHoje);
                exibirClientes("Vencendo em 1 Dia", $clientes1Dia);
                exibirClientes("Vencendo em 3 Dias", $clientes3Dias);
                exibirClientes("Vencendo em 5 Dias", $clientes5Dias);
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    // Alerta de sucesso para renovação
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    if (status == 3) {
        alert("Data de vencimento renovada com sucesso!");
    }
</script>

<?php include('includes/footer.php'); ?>
