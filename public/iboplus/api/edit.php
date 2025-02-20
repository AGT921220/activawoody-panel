<?php
ini_set('display_errors', 1);
include(__DIR__ . '/../includes/functions.php');

$macAddressReduced = $_GET['mac_address'] ?? '';
$userId = $_GET['user_id'] ?? null;
$editUserData = null;

// Verifica se o ID do usuário e o MAC address estão definidos
if ($userId && $macAddressReduced) {
    // Consulta no banco de dados para obter os dados do usuário
    $result = $db->select('playlist', '*', 'id = :id AND mac_address = :mac_address', '', [':id' => $userId, ':mac_address' => $macAddressReduced]);

    if (!empty($result)) {
        $editUserData = $result[0];
    } else {
        echo "<p>Dados do usuário não encontrados.</p>";
        exit();
    }
}

// Atualiza o usuário e senha se o botão de atualização for clicado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $newUsername = $_POST['new_username'];
    $newPassword = $_POST['new_password'];

    if (!empty($newUsername) && !empty($newPassword)) {
        $updateSuccess = $db->update(
            'playlist',
            ['username' => $newUsername, 'password' => $newPassword],
            'mac_address = :mac_address AND id = :id',
            [':mac_address' => $macAddressReduced, ':id' => $userId]
        );

        if ($updateSuccess) {
            echo "<p>Usuário e senha atualizados com sucesso!</p>";
            header("Location: search.php?mac_address=" . urlencode($macAddressReduced));
            exit();
        } else {
            echo "<p>Erro ao atualizar usuário e senha.</p>";
        }
    } else {
        echo "<p>Nome de usuário ou senha não podem estar vazios.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário e Senha</title>
</head>
<body>
    <h2>Editar Usuário e Senha</h2>
    <?php if ($editUserData): ?>
        <form method="POST" action="">
            <input type="hidden" name="mac_address" value="<?= htmlspecialchars($macAddressReduced) ?>">
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($userId) ?>">
            <label for="new_username">Novo Usuário:</label>
            <input type="text" id="new_username" name="new_username" value="<?= htmlspecialchars($editUserData['username']) ?>" required><br>

            <label for="new_password">Nova Senha:</label>
            <input type="password" id="new_password" name="new_password" value="<?= htmlspecialchars($editUserData['password']) ?>" required><br>

            <button type="submit" name="update_user">Salvar Alterações</button>
        </form>
    <?php else: ?>
        <p>Dados do usuário não encontrados.</p>
    <?php endif; ?>
</body>
</html>
