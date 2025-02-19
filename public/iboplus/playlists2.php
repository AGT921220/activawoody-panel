<?php
include('includes/header1.php');

// Nome da tabela
$table_name = "playlist";

// Variáveis de busca
$macAddressInput = '';
$usersData = [];

// Captura o MAC address da URL
if (isset($_GET['mac_address'])) {
    $macAddressInput = preg_replace('/[^A-Fa-f0-9]/', '', $_GET['mac_address']);
    $macAddressInput = strtoupper($macAddressInput);

    if (strlen($macAddressInput) == 12) {
        $formattedMac = implode(':', str_split($macAddressInput, 2));
    } else {
        $formattedMac = '';
    }
}

// Processa a solicitação do formulário de busca
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_mac'])) {
    $macAddressInput = preg_replace('/[^A-Fa-f0-9]/', '', $_POST['mac_address']);
    $macAddressInput = strtoupper($macAddressInput);

    if (strlen($macAddressInput) == 12) {
        $formattedMac = implode(':', str_split($macAddressInput, 2));
        $usersData = $db->select($table_name, '*', 'mac_address = :mac_address', '', [':mac_address' => $formattedMac]);
    } else {
        echo "<p class='alert alert-danger'>Formato de MAC address inválido. Insira no formato XX:XX:XX:XX:XX:XX.</p>";
    }
}

// Submeter novo
if (isset($_POST['submit'])) {
    unset($_POST['submit'], $_POST['m3u']); // Remover 'm3u' dos dados enviados ao banco de dados
    $db->insert($table_name, $_POST);
    $db->close();
    echo "<script>window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?status=1&mac_address=" . urlencode($formattedMac) . "'</script>";
}

// Chamada de atualização
@$resU = $db->select($table_name, '*', 'id = :id', '', [':id' => $_GET['update']]);

if (isset($_POST['submitU'])) {
    unset($_POST['submitU'], $_POST['m3u']); // Remover 'm3u' dos dados enviados ao banco de dados
    $updateData = $_POST;
    $db->update($table_name, $updateData, 'id = :id', [':id' => $_GET['update']]);
    echo "<script>window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?status=1&mac_address=" . urlencode($formattedMac) . "'</script>";
}

// Deletar linha
if (isset($_GET['delete'])) {
    $db->delete($table_name, 'id = :id', [':id' => $_GET['delete']]);
    echo "<script>window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?status=2&mac_address=" . urlencode($formattedMac) . "'</script>";
}
?>

<!-- Modal de confirmação de exclusão -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Confirmar Exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Você realmente quer deletar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger btn-ok">Deletar</a>
            </div>
        </div>
    </div>
</div>

<!-- Formulário de busca -->
<?php if (empty($macAddressInput)) { ?>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="text-center"><i class="icon icon-search"></i> Buscar por MAC Address</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="mac_address">MAC Address (formato: XX:XX:XX:XX:XX:XX):</label>
                        <input type="text" id="mac_address" name="mac_address" value="<?= htmlspecialchars($macAddressInput) ?>" class="form-control" required>
                    </div>
                    <button type="submit" name="search_mac" class="btn btn-info">Buscar</button>
                </form>
            </div>
        </div>
    </div>
<?php } else { ?>
    <!-- Formulário de criação ou atualização -->
    <?php if (isset($_GET['create'])) { ?>
        <div class="container mt-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="text-center"><i class="icon icon-bullhorn"></i> Adicionar Usuário</h2>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="dns">DNS</label>
                            <select class="form-control" name="dns_id" required>
                                <option value="">Escolha um</option>
                                <?php
                                $dnss = $db->select('dns', '*', '', '');
                                foreach ($dnss as $dns) { ?>
                                    <option value="<?= $dns['id'] ?>"><?= $dns['title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="m3u">M3U</label>
                            <input class="form-control" id="m3u" name="m3u" placeholder="Link M3U" type="text" />
                        </div>
                        <div class="form-group">
                            <label for="mac">Endereço MAC (Não precisa colocar ":" )</label>
                            <input class="form-control" id="mac" name="mac_address" placeholder="Endereço MAC" type="text" value="<?= htmlspecialchars($formattedMac) ?>" />
                        </div>
                        <script>
                            document.getElementById("mac").addEventListener('keyup', function() {
                                this.value = (this.value.toUpperCase().replace(/[^\d|A-Z]/g, '').match(/.{1,2}/g) || []).join(":");
                            });

                            document.getElementById("m3u").addEventListener('change', function() {
                                let m3uLink = this.value;
                                if (m3uLink) {
                                    let url = new URL(m3uLink);
                                    let username = url.searchParams.get("username");
                                    let password = url.searchParams.get("password");
                                    if (username) {
                                        document.querySelector('input[name="username"]').value = username;
                                    }
                                    if (password) {
                                        document.querySelector('input[name="password"]').value = password;
                                    }
                                }
                            });
                        </script>
                        <input type="hidden" name="username" value="">
                        <input type="hidden" name="password" value="">
                        <div class="form-group">
                            <label for="pin">PIN Parental</label>
                            <input class="form-control" id="pin" name="pin" placeholder="PIN Parental" type="text" value="0000" />
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-info" name="submit" type="submit">
                                <i class="icon icon-check"></i> Enviar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } elseif (isset($_GET['update'])) { ?>
        <div class="container mt-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="text-center"><i class="icon icon-bullhorn"></i> Editar Usuário Atual</h2>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="dns">DNS</label>
                            <select class="form-control" name="dns_id" required>
                                <?php
                                $dnss = $db->select('dns', '*', '', '');
                                foreach ($dnss as $dns) { ?>
                                    <option value="<?= $dns['id'] ?>" <?= $dns['id'] == $resU[0]['dns_id'] ? 'selected' : '' ?>>
                                        <?= $dns['title'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="m3u">M3U</label>
                            <input class="form-control" id="m3u" name="m3u" placeholder="Link M3U" type="text" value="<?= $resU[0]['m3u'] ?>" />
                        </div>
                        <div class="form-group">
                            <label for="mac">Endereço MAC</label>
                            <input class="form-control" id="mac" name="mac_address" value="<?= $resU[0]['mac_address'] ?>" type="text" />
                        </div>
                        <script>
                            document.getElementById("m3u").addEventListener('change', function() {
                                let m3uLink = this.value;
                                if (m3uLink) {
                                    let url = new URL(m3uLink);
                                    let username = url.searchParams.get("username");
                                    let password = url.searchParams.get("password");
                                    if (username) {
                                        document.querySelector('input[name="username"]').value = username;
                                    }
                                    if (password) {
                                        document.querySelector('input[name="password"]').value = password;
                                    }
                                }
                            });
                        </script>
                        <input type="hidden" name="username" value="<?= $resU[0]['username'] ?>">
                        <input type="hidden" name="password" value="<?= $resU[0]['password'] ?>">
                        <div class="form-group">
                            <label for="pin">PIN Parental</label>
                            <input class="form-control" id="pin" name="pin" placeholder="PIN Parental" value="<?= $resU[0]['pin'] ?>" type="text" />
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-info" name="submitU" type="submit">
                                <i class="icon icon-check"></i> Enviar
                            </button>
                            <a href="playlists2.php" class="btn btn-warning">
                                <i class="icon icon-arrow-left"></i> Voltar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <!-- Tabela/Formulário principal -->
        <div class="container mt-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="text-center"><i class="icon icon-commenting"></i> Usuários Atuais</h2>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <a id="button" href="playlists2.php?create&mac_address=<?= urlencode($formattedMac) ?>" class="btn btn-info">Criar Usuário para este MAC.</a>
                        <a href="playlists2.php" class="btn btn-warning">Buscar outro MAC Address</a>
                    </div>
                    <div class="table-responsive">
                        <input class="form-control mb-3" type="text" id="search" onkeyup="func2()" placeholder="Digite para pesquisar">
                        <table id="users" class="table table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID DNS</th>
                                    <th>Endereço MAC</th>
                                    <th>Nome de Usuário</th>
                                    <th>Senha</th>
                                    <th>PIN Parental</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usersData as $row) { ?>
                                <tr>
                                    <td><?= $row['dns_id'] ?></td>
                                    <td><?= $row['mac_address'] ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td><?= $row['password'] ?></td>
                                    <td><?= $row['pin'] ?></td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="playlists2.php?update=<?= $row['id'] ?>&mac_address=<?= urlencode($formattedMac) ?>"><i class="fa fa-pencil-square-o"></i></a>
                                        <a class="btn btn-danger btn-sm" href="#" data-href="playlists2.php?delete=<?= $row['id'] ?>&mac_address=<?= urlencode($formattedMac) ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>

<?php include('includes/footer.php'); ?>
</body>
</html>
