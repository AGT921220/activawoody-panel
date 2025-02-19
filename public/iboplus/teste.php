<?php
include('includes/header1.php');

// Função para obter o MAC address correspondente à chave do JSON
function getMacFromKey($key) {
    $keyFile = './api/key.json';
    if (file_exists($keyFile)) {
        $keys = json_decode(file_get_contents($keyFile), true);
        foreach ($keys as $mac => $details) {
            if (isset($details['key']) && $details['key'] === $key) {
                return $mac;
            }
        }
    }
    return null; // Retorna null se a chave não for encontrada
}

// Função para salvar informações no arquivo JSON
function saveToCodigoJson($key, $dns, $m3u) {
    $codigoFile = './api/codigo.json';
    $data = file_exists($codigoFile) ? json_decode(file_get_contents($codigoFile), true) : [];
    
    // Salva a chave como índice e adiciona as informações
    $data[$key] = [
        'dns' => $dns,
        'm3u' => $m3u,
    ];

    // Salva de volta no arquivo
    file_put_contents($codigoFile, json_encode($data, JSON_PRETTY_PRINT));
}

// Verificar se não há parâmetros de URL definidos (create, update, delete)
if (!isset($_GET['create']) && !isset($_GET['update']) && !isset($_GET['delete'])) {
    echo "<script>window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?create'</script>";
    exit;
}

// Submeter novo
if (isset($_POST['submit'])) {
    // Obter informações do formulário
    $key = $_POST['mac_address'];
    $dns = $_POST['dns_id'];
    $m3u = $_POST['m3u'];

    // Verificar se é uma chave válida
    if (strlen($key) === 6 && ctype_digit($key)) {
        saveToCodigoJson($key, $dns, $m3u); // Salvar no arquivo JSON

        echo "<script>
            alert('As informações foram salvas com sucesso no arquivo JSON.');
            window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?status=1';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Chave inválida! Por favor, insira uma chave válida (6 dígitos).');
            window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?create';
        </script>";
        exit;
    }
}

// Atualização de registro
if (isset($_POST['submitU'])) {
    // Obter informações do formulário
    $key = $_POST['mac_address'];
    $dns = $_POST['dns_id'];
    $m3u = $_POST['m3u'];

    // Verificar se é uma chave válida
    if (strlen($key) === 6 && ctype_digit($key)) {
        saveToCodigoJson($key, $dns, $m3u); // Atualizar no arquivo JSON

        echo "<script>
            alert('As informações foram atualizadas com sucesso no arquivo JSON.');
            window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?status=1';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Chave inválida! Por favor, insira uma chave válida (6 dígitos).');
            window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?update={$_GET['update']}';
        </script>";
        exit;
    }
}

// Deletar linha
if (isset($_GET['delete'])) {
    $codigoFile = './api/codigo.json';
    $data = file_exists($codigoFile) ? json_decode(file_get_contents($codigoFile), true) : [];

    // Verifica e remove a chave do JSON
    $key = $_GET['delete'];
    if (isset($data[$key])) {
        unset($data[$key]);
        file_put_contents($codigoFile, json_encode($data, JSON_PRETTY_PRINT));
        echo "<script>
            alert('As informações foram deletadas com sucesso do arquivo JSON.');
            window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?status=2';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Chave não encontrada.');
            window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?status=2';
        </script>";
        exit;
    }
}
?>
