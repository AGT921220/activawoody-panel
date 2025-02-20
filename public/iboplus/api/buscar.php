<?php
ini_set('display_errors', 1);
include(__DIR__ . '/../includes/functions.php');

$macAddressReduced = '';
$usersData = [];

// Processa a solicitação do formulário de busca
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe o MAC address do formulário de busca
    if (isset($_POST['search_mac'])) {
        $macAddressInput = preg_replace('/[^A-Fa-f0-9]/', '', $_POST['mac_address']);
        $macAddressInput = strtoupper($macAddressInput);

        if (strlen($macAddressInput) == 12) {
            // Formata o MAC address no formato XX:XX:XX:XX:XX:XX
            $formattedMac = implode(':', str_split($macAddressInput, 2));
            $macAddressReduced = $formattedMac;

            // Consulta no banco de dados
            $result = $db->select('playlist', '*', 'mac_address = :mac_address', '', [':mac_address' => $macAddressReduced]);

            if (!empty($result)) {
                $usersData = $result; // Pega todos os resultados
            } else {
                echo "<p>Nenhuma lista encontrada para o MAC: $macAddressReduced</p>";
            }
        } else {
            echo "<p>Formato de MAC address inválido. Insira no formato XX:XX:XX:XX:XX:XX.</p>";
        }
    }

    // Exclui o usuário se o botão de exclusão for clicado
    if (isset($_POST['delete_user'])) {
        $macAddressReduced = $_POST['mac_address'];
        $userId = $_POST['user_id'];

        $deleteSuccess = $db->delete('playlist', 'mac_address = :mac_address AND id = :id', [':mac_address' => $macAddressReduced, ':id' => $userId]);

        if ($deleteSuccess) {
            echo "<p>Usuário excluído com sucesso!</p>";
            // Atualiza a lista de usuários após a exclusão
            $result = $db->select('playlist', '*', 'mac_address = :mac_address', '', [':mac_address' => $macAddressReduced]);
            $usersData = $result;
        } else {
            echo "<p>Erro ao excluir usuário.</p>";
        }
    }

    // Redireciona para a página de edição se o botão de edição for clicado
    if (isset($_POST['edit_user'])) {
        $userId = $_POST['user_id'];
        header("Location: edit.php?mac_address=" . urlencode($macAddressReduced) . "&user_id=" . urlencode($userId));
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Listas por MAC Address</title>
</head>
<body>
    <h2>Buscar Listas por MAC Address</h2>
    <form method="POST" action="">
        <label for="mac_address">MAC Address (formato: XX:XX:XX:XX:XX:XX):</label>
        <input type="text" id="mac_address" name="mac_address" value="<?= htmlspecialchars($macAddressReduced) ?>" required>
        <button type="submit" name="search_mac">Buscar</button>
    </form>

    <?php if (!empty($usersData)): ?>
        <h3>Usuários encontrados para o MAC: <?= htmlspecialchars($macAddressReduced) ?></h3>
        <ul>
            <?php foreach ($usersData as $user): ?>
                <li>
                    <strong>DNS ID:</strong> <?= htmlspecialchars($user['dns_id']) ?>,
                    <strong>Usuário:</strong> <?= htmlspecialchars($user['username']) ?>,
                    <strong>Senha:</strong> <?= htmlspecialchars($user['password']) ?>
                    <form method="POST" action="" style="display:inline;">
                        <input type="hidden" name="mac_address" value="<?= htmlspecialchars($macAddressReduced) ?>">
                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">
                        <button type="submit" name="edit_user">Editar</button>
                    </form>
                    <form method="POST" action="" style="display:inline;">
                        <input type="hidden" name="mac_address" value="<?= htmlspecialchars($macAddressReduced) ?>">
                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">
                        <button type="submit" name="delete_user" onclick="return confirm('Tem certeza de que deseja excluir este usuário?');">Excluir</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
