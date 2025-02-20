<?php
// Inclua sua classe de banco de dados ou qualquer configuração necessária aqui
include('api/.db.db');

// Nome da tabela
$table_name = "playlist";

// Submeter novo
if (isset($_POST['submit'])) {
    // Remover 'm3u' dos dados enviados ao banco de dados
    unset($_POST['submit'], $_POST['m3u']);
    // Inserir dados no banco de dados
    $db->insert($table_name, $_POST);
    // Fechar a conexão com o banco de dados
    $db->close();
    // Redirecionar após o envio
    echo "<script>window.location.href='". basename($_SERVER["SCRIPT_NAME"])."?status=1'</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Usuário</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById("mac").addEventListener('keyup', function() { 
                this.value = 
                    (this.value.toUpperCase()
                    .replace(/[^\d|A-Z]/g, '')
                    .match(/.{1,2}/g) || [])
                    .join(":");
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
        });
    </script>
</head>
<body>
    <div class="container mt-5">
        <div class="col-md-8 mx-auto">
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
                            <label for="dns_id">DNS</label>
                            <select class="form-control" name="dns_id" required>
                                <option value="">Escolha um</option>
                                <?php
                                    // Puxar dados da tabela 'dns' do banco de dados
                                    $dnss = $db->select('dns', '*', '', '');
                                    foreach($dnss as $dns) { ?>
                                        <option value="<?=$dns['id']?>"><?=$dns['title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="m3u">M3U</label>
                            <input class="form-control" id="m3u" name="m3u" placeholder="Link M3U" type="text" required />
                        </div>
                        <div class="form-group">
                            <label for="mac">Endereço MAC (Não precisa colocar ":")</label>
                            <input class="form-control" id="mac" name="mac_address" placeholder="Endereço MAC" type="text" required />
                        </div>
                        <input type="hidden" name="username" value="">
                        <input type="hidden" name="password" value="">
                        <div class="form-group">
                            <label for="pin">PIN Parental</label>
                            <input class="form-control" id="pin" name="pin" placeholder="PIN Parental" type="text" value="0000" required />
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
</body>
</html>
