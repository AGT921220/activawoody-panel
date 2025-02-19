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
    /* Estilos para layout com abas */
    .tabs-container {
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    .tabs {
        display: flex;
        gap: 10px;
        padding: 10px;
        background-color: #f4f4f4;
        border-radius: 8px;
    }
    .tab {
        padding: 10px 15px;
        background-color: #ddd;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        color: #333; /* Cor do texto para abas */
    }
    .tab:hover {
        background-color: #bbb;
    }
    .tab.active {
        background-color: #007bff;
        color: white; /* Cor branca para o texto quando a aba está ativa */
    }
    .tab-content {
        display: none;
        margin-top: 20px;
    }
    .tab-content.active {
        display: block;
    }
    .client-card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        text-align: center;
        color: #333; /* Garantir que o texto no cartão seja visível */
    }
    .actions {
        margin-top: 10px;
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
            
            <!-- Abas para categorizar os clientes -->
            <div class="tabs-container">
                <div class="tabs">
                    <div class="tab active" onclick="showTabContent('hoje')">Vencendo Hoje</div>
                    <div class="tab" onclick="showTabContent('1dia')">Vencendo em 1 Dia</div>
                    <div class="tab" onclick="showTabContent('3dias')">Vencendo em 3 Dias</div>
                    <div class="tab" onclick="showTabContent('5dias')">Vencendo em 5 Dias</div>
                </div>
            </div>
            
            <!-- Conteúdo das abas -->
            <div id="hoje" class="tab-content active">
                <?php exibirClientes($clientesHoje); ?>
            </div>
            <div id="1dia" class="tab-content">
                <?php exibirClientes($clientes1Dia); ?>
            </div>
            <div id="3dias" class="tab-content">
                <?php exibirClientes($clientes3Dias); ?>
            </div>
            <div id="5dias" class="tab-content">
                <?php exibirClientes($clientes5Dias); ?>
            </div>
        </div>
    </div>
</div>

<script>
    // Função JavaScript para alternar entre as abas
    function showTabContent(tab) {
        const contents = document.querySelectorAll('.tab-content');
        const tabs = document.querySelectorAll('.tab');
        
        contents.forEach(content => content.classList.remove('active'));
        tabs.forEach(tabEl => tabEl.classList.remove('active'));
        
        document.getElementById(tab).classList.add('active');
        event.target.classList.add('active');
    }

    // Alerta de sucesso para renovação
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    if (status == 3) {
        alert("Data de vencimento renovada com sucesso!");
    }
</script>

<?php
// Função para exibir clientes com layout de cartão
function exibirClientes($clientes) {
    if (empty($clientes)) {
        echo "<div class='client-card'>Sem clientes.</div>";
    } else {
        foreach ($clientes as $key => $user) { ?>
            <div class="client-card">
                <p><strong>Nome:</strong> <?= $user['name'] ?></p>
                <p><strong>Vencimento:</strong> <?= (new DateTime($user['expiration']))->format('d/m/Y') ?></p>
                <div class="actions">
                    <a href="?renew=<?= $key + 1 ?>" class="btn btn-success">Renovar</a>
                    <a href="https://wa.me/55<?= preg_replace('/\D/', '', $user['whatsapp']) ?>?text=Olá%20<?= urlencode($user['name']) ?>,%20seu%20plano%20vence%20<?= urlencode((new DateTime($user['expiration']))->format('d/m/Y')) ?>.%20Não%20deixe%20de%20renovar%20seu%20acesso." target="_blank" class="btn btn-info">WhatsApp</a>
                </div>
            </div>
        <?php }
    }
}
?>

<?php include('includes/footer.php'); ?>
