<?php
include('includes/header.php');

// Nome da tabela
$table_name = "playlist";

// Chamada da tabela
$res = json_decode(file_get_contents('data.json'), true);

// Submeter novo
if (isset($_POST['submit'])) {
    unset($_POST['submit']); // Remover 'submit' dos dados enviados ao banco de dados
    $data = $_POST;
    $data['mac'] = uniqid(); // Gerar um MAC address único (ou modifique conforme sua lógica)
    $res[] = $data; // Adiciona os dados ao array
    file_put_contents('data.json', json_encode($res)); // Salva o array no JSON
    echo "<script>window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?status=1'</script>";
}

// Chamada de atualização
@$resU = $res[$_GET['update'] - 1]; // Supondo que os IDs sejam sequenciais

if (isset($_POST['submitU'])) {
    unset($_POST['submitU']); // Remover 'submitU' dos dados enviados ao banco de dados
    $updateData = $_POST;
    $updateData['mac'] = $resU['mac']; // Manter o MAC address ao atualizar
    $res[$_GET['update'] - 1] = $updateData; // Atualiza os dados no array
    file_put_contents('data.json', json_encode($res)); // Salva o array no JSON
    echo "<script>window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?status=1'</script>";
}

// Deletar linha
if (isset($_GET['delete'])) {
    unset($res[$_GET['delete'] - 1]); // Remove o elemento do array
    file_put_contents('data.json', json_encode(array_values($res))); // Reindexa e salva
    echo "<script>window.location.href='" . basename($_SERVER["SCRIPT_NAME"]) . "?status=2'</script>";
}
?>

<!-- Modal de confirmação de exclusão -->
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

<?php if (isset($_GET['create'])) { ?>

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
                        <label class="form-label" for="name">Nome</label>
                        <input class="form-control" id="name" name="name" placeholder="Nome" type="text" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="username">Usuário</label>
                        <input class="form-control" id="username" name="username" placeholder="Usuário" type="text" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Senha</label>
                        <input class="form-control" id="password" name="password" placeholder="Senha" type="password" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="expiration">Vencimento</label>
                        <input class="form-control" id="expiration" name="expiration" placeholder="Data de Vencimento" type="date" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="whatsapp">WhatsApp</label>
                        <input class="form-control" id="whatsapp" name="whatsapp" placeholder="Número do WhatsApp" type="text" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" id="email" name="email" placeholder="Email" type="email" required />
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
                        <label class="form-label" for="name">Nome</label>
                        <input class="form-control" id="name" name="name" value="<?= $resU['name'] ?>" placeholder="Nome" type="text" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="username">Usuário</label>
                        <input class="form-control" id="username" name="username" value="<?= $resU['username'] ?>" placeholder="Usuário" type="text" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Senha</label>
                        <input class="form-control" id="password" name="password" value="<?= $resU['password'] ?>" placeholder="Senha" type="password" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="expiration">Vencimento</label>
                        <input class="form-control" id="expiration" name="expiration" value="<?= $resU['expiration'] ?>" placeholder="Data de Vencimento" type="date" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="whatsapp">WhatsApp</label>
                        <input class="form-control" id="whatsapp" name="whatsapp" value="<?= $resU['whatsapp'] ?>" placeholder="Número do WhatsApp" type="text" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" id="email" name="email" value="<?= $resU['email'] ?>" placeholder="Email" type="email" required />
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

<?php } else { ?>

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
                        <a id="button" href="./<?= basename($_SERVER["SCRIPT_NAME"]) ?>?create" class="btn btn-info">Criar Usuário</a>
                    </center>
                </div>
                <br>
                <div class="table-responsive">
                    <input class="form-control" type="text" id="search" onkeyup="func2()" placeholder="Digite para pesquisar">
                    <table id="users" class="table table-striped table-sm">
                        <thead style="color:white!important">
                            <tr class="header">
                                <th>Nome</th>
                                <th>Usuário</th>
                                <th>Senha</th>
                                <th>Vencimento</th>
                                <th>WhatsApp</th>
                                <th>Email</th>
                             
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($res as $key => $user) { ?>
                            <tr>
                                <td><?= $user['name'] ?></td>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['password'] ?></td>
                                <td><?= $user['expiration'] ?></td>
                                <td>
                                    <?= $user['whatsapp'] ?>
                                    <a href="https://wa.me/<?= str_replace([' ', '-', '(', ')'], '', $user['whatsapp']) ?>?text=Olá <?= $user['name'] ?>, sua lista vence <?= $user['expiration'] ?>" class="btn btn-success btn-sm">
                                        Enviar Mensagem
                                    </a>
                                </td>
                                <td><?= $user['email'] ?></td>
                                
                                <td>
                                    <a href="?update=<?= $key + 1 ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirm-delete" data-href="?delete=<?= $key + 1 ?>">Deletar</button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<script>
    function func2() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("users");
        tr = table.getElementsByTagName("tr");
        
        for (i = 1; i < tr.length; i++) {
            tr[i].style.display = "none"; // Oculta a linha
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = ""; // Mostra a linha
                        break;
                    }
                }
            }
        }
    }
</script>

<script>
    $('#confirm-delete').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>

<?php include('includes/footer.php'); ?>
