<?php
include "includes/header.php";
$keyFilePath = __DIR__ . '/api/key.json';

// Lê o conteúdo atual do arquivo key.json
$keys = [];
if (file_exists($keyFilePath)) {
    $keys = json_decode(file_get_contents($keyFilePath), true);
}

// Obtém o MAC address passado via GET
$macAddress = isset($_GET['mac_address']) ? $_GET['mac_address'] : '';

// Se o formulário for submetido
if (isset($_POST["submit"])) {
    unset($_POST["submit"]);
    
    // Obtém os dados do formulário
    $macAddress = strtoupper(trim($_POST["mac_address"]));
    $message = trim($_POST["message"]);
    
    // Se o MAC address já existe, atualiza somente a mensagem
    if (isset($keys[$macAddress])) {
        $keys[$macAddress]['message'] = $message; // Atualiza apenas a mensagem
    } else {
        // Se o MAC address não existe, adiciona a nova entrada com a chave
        $keys[$macAddress] = [
            "key" => generateUniqueKey(), // Ou outra lógica para gerar a chave
            "message" => "Bem-vindo", // Mensagem padrão ao criar um novo MAC
            "mensagem" => $message // Mensagem que foi enviada
        ];
    }

    // Salva o array de volta no arquivo key.json
    file_put_contents($keyFilePath, json_encode($keys, JSON_PRETTY_PRINT));

    echo "<script>window.location.href='mensagemmac.php?status=1'</script>";
}

// Verifica se o MAC address existe no JSON e pega a mensagem
$welcomeMessage = "";
if (isset($keys[$macAddress])) {
    $welcomeMessage = $keys[$macAddress]['message']; // Usa a mensagem do JSON
}

?>

<div class="col-md-6 mx-auto">
    <div class="card-body">
        <div class="card bg-primary text-white">
            <div class="card-header card-header-warning">
                <center>
                    <h2><i class="icon icon-bullhorn"></i>  Envie mensagem individual através do MAC do seu cliente</h2>
                    <h3><?= $welcomeMessage ?></h3> <!-- Mensagem de boas-vindas -->
                </center>
            </div>
            
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label class="form-label">Digite MAC</label>
                        <input class="form-control" name="mac_address" type="text" placeholder="XX:XX:XX:XX:XX:XX" required value="<?= $macAddress ?>"/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Mensagem</label>
                        <input class="form-control" name="message" type="text" required/>
                    </div>

                    <div class="form-group">
                        <center>
                            <button class="btn btn-info" name="submit" type="submit">
                                <i class="icon icon-check"></i> Submit
                            </button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>
