<?php

include ('includes/header.php');

// Nome da tabela
$table_name = "playlist";

// Chamada da tabela
$res = $db->select($table_name, '*', '', '');

// Submeter novo
if (isset($_POST['submit'])){
    unset($_POST['submit'], $_POST['m3u']); // Remover 'm3u' dos dados enviados ao banco de dados
    $db->insert($table_name, $_POST);
    $db->close();
    echo "<script>window.location.href='". basename($_SERVER["SCRIPT_NAME"])."?status=1'</script>";
}

// Chamada de atualização
@$resU = $db->select($table_name, '*', 'id = :id', '', [':id' => $_GET['update']]);

if(isset($_POST['submitU'])){
    unset($_POST['submitU'], $_POST['m3u']); // Remover 'm3u' dos dados enviados ao banco de dados
    $updateData = $_POST;
    $db->update($table_name, $updateData, 'id = :id',[':id' => $_GET['update']]);
    echo "<script>window.location.href='". basename($_SERVER["SCRIPT_NAME"])."?status=1'</script>";
}

// Deletar linha
if(isset($_GET['delete'])){
    $db->delete($table_name, 'id = :id',[':id' => $_GET['delete']]);
    echo "<script>window.location.href='". basename($_SERVER["SCRIPT_NAME"])."?status=2'</script>";
}

// Modal de confirmação de exclusão
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
<?php
if (isset($_GET['create'])){ 

// Formulário de criação
?>
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
                                <?php
                                    } ?>
                            </select> 
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="m3u">M3U</label>
                            <input class="form-control" id="m3u" name="m3u" placeholder="Link M3U" type="text"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="dns">Endereço MAC (Não precisa colocar ":"  )</label>
                            <input class="form-control" id="mac" name="mac_address" placeholder="Endereço MAC" type="text"/>
                        </div>
                        <script>
                            document.getElementById("mac").addEventListener('keyup', function() { 
                                this.value = 
                                    (this.value.toUpperCase()
                                    .replace(/[^\d|A-Z]/g, '')
                                    .match(/.{1,2}/g) || [])
                                    .join(":")
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
                            <label class="form-label" for="dns">PIN Parental</label>
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
<?php
}else if (isset($_GET['update'])){ 

// Formulário de atualização
?>
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
                            <label class="form-label" for="title">ID DNS</label>
                            <select class="form-control" name="dns_id">
                                <?php
                                    $dnss = $db->select('dns', '*', '', '');
                                    foreach($dnss as $dns) { ?>
                                        <option value="<?=$dns['id']?>" <?= ($resU[0]['dns_id'] == $dns['id']) ? 'selected' : '' ?>><?=$dns['title'] ?></option>
                                <?php
                                    } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="m3u">M3U</label>
                            <input class="form-control" id="m3u" name="m3u" value="<?=$resU[0]['m3u'] ?>" placeholder="Link M3U" type="text"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="dns">Endereço MAC</label>
                            <input class="form-control" id="description" name="mac_address" value="<?=$resU[0]['mac_address'] ?>" type="text"/>
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
                        <!-- Campos ocultos para usuário e senha -->
                        <input type="hidden" name="username" value="<?=$resU[0]['username'] ?>">
                        <input type="hidden" name="password" value="<?=$resU[0]['password'] ?>">
                        <div class="form-group">
                            <label class="form-label" for="dns">PIN Parental</label>
                            <input class="form-control" id="description" name="pin" placeholder="PIN Parental" value="<?=$resU[0]['pin'] ?>" type="text"/>
                        </div>
                        <div class="form-group">
                            <center>
                                <button class="btn btn-info" name="submitU" type="submit">
                                    <i class="icon icon-check"></i> Enviar
                                </button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}else{
// Tabela/Formulário principal
?>
    <div class="col-md-12 mx-auto">
        <div class="card-body">
            <div class="card bg-primary text-white">
                <div class="card-header card-header-warning">
                    <center>
                        <h2><i class="icon icon-commenting"></i> Usuários Atuais</h2>
                    </center>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <center>
                            <a id="button" href="./<?=basename($_SERVER["SCRIPT_NAME"]) ?>?create" class="btn btn-info">Criar Usuário</a>
                        </center>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <input class="form-control" type="text" id="search" onkeyup="func2()" placeholder="Digite para pesquisar">
                        <table id="users" class="table table-striped table-sm">
                            <thead style="color:white!important">
                                <tr class="header">
                                    <th>ID DNS</th>
                                    <th>Endereço MAC</th>
                                    <th>Nome de Usuário</th>
                                    <th>Senha</th>
                                    <th>PIN Parental</th>
                                    <th>Mensagem&nbsp;&nbsp;&nbsp;Editar&nbsp;&nbsp;&nbsp;Deletar</th>
                                </tr>
                            </thead>
                            <?php foreach ($res as $row) { ?>
                 <tbody>
    <tr>
        <td><?=$row['dns_id'] ?></td>
        <td><?=$row['mac_address'] ?></td>
        <td><?=$row['username'] ?></td>
        <td><?=$row['password'] ?></td>
        <td><?=$row['pin'] ?></td>
        <td>
            <a class="btn btn-info btn-ok" href="mensagemmac.php?mac_address=<?=$row['mac_address'] ?>">
                <i class="fa fa-envelope"></i>
            </a>
            <a class="btn btn-info btn-ok" href="./<?=basename($_SERVER["SCRIPT_NAME"]) ?>?update=<?=$row['id'] ?>">
                <i class="fa fa-pencil-square-o"></i> 
            </a>
            <a class="btn btn-danger btn-ok" href="#" data-href="./<?=basename($_SERVER["SCRIPT_NAME"]) ?>?delete=<?=$row['id'] ?>" data-toggle="modal" data-target="#confirm-delete">
                <i class="fa fa-trash-o"></i> 
            </a>
        </td>
    </tr>
</tbody>



                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<script>
    function func2() {
        // Captura o valor do input de pesquisa
        var input = document.getElementById("search");
        var filter = input.value.toUpperCase();
        var table = document.getElementById("users");
        var tr = table.getElementsByTagName("tr");

        // Loop pelas linhas da tabela, exceto o cabeçalho
        for (var i = 1; i < tr.length; i++) {
            var td = tr[i].getElementsByTagName("td");
            var found = false;

            // Verifica cada célula da linha
            for (var j = 0; j < td.length; j++) {
                if (td[j]) {
                    if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }

            // Exibe ou esconde a linha com base na correspondência
            if (found) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
</script>

<?php include ('includes/footer.php'); ?>
</body>
</html>
