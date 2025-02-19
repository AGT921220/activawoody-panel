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

// Verificar se não há parâmetros de URL definidos (create, update, delete)
if (!isset($_GET['create']) && !isset($_GET['update']) && !isset($_GET['delete'])) {
    echo "<script>window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?create'</script>";
    exit;
}

// Nome da tabela
$table_name = "playlist";

// Submeter novo
if (isset($_POST['submit'])) {
    unset($_POST['submit'], $_POST['m3u']); // Remover 'm3u' dos dados enviados ao banco de dados

    // Verificar se é uma chave e obter o MAC address correspondente
    $mac_address = getMacFromKey($_POST['mac_address']);
    if ($mac_address) {
        $_POST['mac_address'] = $mac_address;
    } else {
        echo "<script>
            alert('Chave inválida! Por favor, insira uma chave válida.');
            window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?create';
        </script>";
        exit;
    }

    $db->insert($table_name, $_POST);
    $db->close();
    echo "<script>
        alert('A lista foi enviada com sucesso. Solicite ao seu cliente que saia e volte ao aplicativo.');
        window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?status=1';
    </script>";
    exit;
}

// Chamada de atualização
@$resU = $db->select($table_name, '*', 'id = :id', '', [':id' => $_GET['update']]);

if (isset($_POST['submitU'])) {
    unset($_POST['submitU'], $_POST['m3u']); // Remover 'm3u' dos dados enviados ao banco de dados

    // Verificar se é uma chave e obter o MAC address correspondente
    $mac_address = getMacFromKey($_POST['mac_address']);
    if ($mac_address) {
        $_POST['mac_address'] = $mac_address;
    } else {
        echo "<script>
            alert('Chave inválida! Por favor, insira uma chave válida.');
            window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?update={$_GET['update']}';
        </script>";
        exit;
    }

    $updateData = $_POST;
    $db->update($table_name, $updateData, 'id = :id', [':id' => $_GET['update']]);
    echo "<script>
        alert('A lista foi atualizada com sucesso. Solicite ao seu cliente que saia e volte ao aplicativo.');
        window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?status=1';
    </script>";
    exit;
}

// Deletar linha
if (isset($_GET['delete'])) {
    $db->delete($table_name, 'id = :id', [':id' => $_GET['delete']]);
    echo "<script>
        alert('A lista foi deletada com sucesso.');
        window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?status=2';
    </script>";
    exit;
}
?>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Confirmar</h2>
            </div>
            <div class="modal-body">
                Você realmente quer deletar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger btn-ok">Deletar</a>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_GET['create'])){ ?>
    <!-- Formulário de criação -->
    <div class="col-md-8 mx-auto">
        <div class="card-body">
            <div class="card bg-primary text-white">
                <div class="card-header card-header-warning">
                    <center>
                        <h2><i class="icon icon-bullhorn"></i> Adicionar Usuário</h2>
                    </center>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <h3>Adicionar Usuário</h3>
                    </div>
                    <form method="post">
                        <div class="form-group">
                            <label class="form-label" for="title">DNS</label>
                            <select class="form-control" name="dns_id">
                               <option selected="selected">Escolha um</option>
                               <?php
                                 $dnss = $db->select('dns', '*', '', '');
                                 foreach($dnss as $dns) { ?>
                                   <option value="<?=$dns['id']?>"><?=$dns['title'] ?></option>
                               <?php } ?>
                             </select> 
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="m3u">M3U</label>
                                <input class="form-control" id="m3u" name="m3u" placeholder="Link M3U" type="text"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="mac">Chave Do dispositivo. (6 dígitos)</label>
                                <input class="form-control" id="mac" name="mac_address" placeholder="Chave MAC" type="text"/>
                        </div>
                        <script>
                            document.getElementById("mac").addEventListener('input', function() {
                                // Remove qualquer caractere que não seja dígito
                                this.value = this.value.replace(/\D/g, '');

                                // Se o valor tiver 6 dígitos, formate com ":" ao final
                                if (this.value.length > 6) {
                                    this.value = this.value.substring(0, 6);
                                }
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
                        <!-- Campos ocultos para usuário e senha -->
                        <input type="hidden" name="username" value="">
                        <input type="hidden" name="password" value="">
                        <div class="form-group">
                            <label class="form-label" for="pin">PIN Parental</label>
                                <input class="form-control" id="description" name="pin" placeholder="PIN Parental" type="text" value="0000"/>
                        </div>
                        <div class="form-group">
                            <center>
                                <button class="btn btn-info" name="submit" type="submit">
                                    <i class="icon icon-check"></i> Enviar
                                </button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } else if (isset($_GET['update'])) { ?>
    <!-- Formulário de atualização -->
    <div class="col-md-8 mx-auto">
        <div class="card-body">
            <div class="card bg-primary text-white">
                <div class="card-header card-header-warning">
                    <center>
                        <h2><i class="icon icon-bullhorn"></i> Editar Usuário Atual</h2>
                    </center>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <h3>Editar Usuário</h3>
                    </div>
                    <form method="post">
                        <div class="form-group">
                            <label class="form-label" for="id">ID DNS</label>
                                <input class="form-control" id="description" name="id" value="<?=$resU[0]['id'] ?>" readonly type="text" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="m3u">M3U</label>
                                <input class="form-control" id="m3u" name="m3u" value="<?=$resU[0]['m3u'] ?>" placeholder="Link M3U" type="text"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="mac">Chave Do Dispositivo (6 dígitos)</label>
                                <input class="form-control" id="mac" name="mac_address" value="<?=$resU[0]['mac_address'] ?>" placeholder="Chave MAC" type="text"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="pin">PIN Parental</label>
                                <input class="form-control" id="description" name="pin" value="<?=$resU[0]['pin'] ?>" placeholder="PIN Parental" type="text" />
                        </div>
                        <div class="form-group">
                            <center>
                                <button class="btn btn-info" name="submitU" type="submit">
                                    <i class="icon icon-check"></i> Atualizar
                                </button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>

<?php include('includes/footer.php'); ?>
