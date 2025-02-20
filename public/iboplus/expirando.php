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

<div class="col-md-12 mx-auto">
    <div class="card-body">
        <div class="card bg-primary text-white">
            <div class="card-header card-header-warning">
                <center>
                    <h2><i class="icon icon-clock-o"></i> Clientes Próximos do Vencimento</h2>
                </center>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php 
                    // Função para exibir cada grupo de clientes com cores
                    function exibirClientes($titulo, $clientes, $cor) { ?>
                        <div class="col-md-3">
                            <div class="card text-white <?= $cor ?> mb-3">
                                <div class="card-header"><?= $titulo ?></div>
                                <div class="card-body">
                                    <?php if (empty($clientes)) { ?>
                                        <p>Sem clientes.</p>
                                    <?php } else { ?>
                                        <table class="table table-striped table-sm text-white">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>Vencimento</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($clientes as $key => $user) { ?>
                                                <tr>
                                                    <td><?= $user['name'] ?></td>
                                                    <td><?= (new DateTime($user['expiration']))->format('d/m/Y') ?></td>
                                                    <td>
                                                        <a href="?renew=<?= $key + 1 ?>" class="btn btn-success btn-sm">Renovar</a>
                                                        <a href="https://wa.me/55<?= preg_replace('/\D/', '', $user['whatsapp']) ?>?text=Olá%20<?= urlencode($user['name']) ?>,%20seu%20plano%20vence%20<?= urlencode((new DateTime($user['expiration']))->format('d/m/Y')) ?>.%20Não%20deixe%20de%20renovar%20seu%20acesso." target="_blank" class="btn btn-info btn-sm">WhatsApp</a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php }
                    
                    // Exibindo as caixas de clientes vencendo hoje, em 1 dia, 3 dias e 5 dias com as cores especificadas
                    exibirClientes("Vencendo Hoje", $clientesHoje, 'bg-danger'); // Vermelho
                    exibirClientes("Vencendo em 1 Dia", $clientes1Dia, 'bg-warning'); // Amarelo
                    exibirClientes("Vencendo em 3 Dias", $clientes3Dias, 'bg-primary'); // Azul
                    exibirClientes("Vencendo em 5 Dias", $clientes5Dias, 'bg-success'); // Verde
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
