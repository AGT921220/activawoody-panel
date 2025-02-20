<?php
ini_set('display_errors', 0);
include('includes/header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Salva a opção selecionada em um arquivo chamado "opcao.txt"
    $opcao_selecionada = $_POST["opcoes"];
    file_put_contents("./api/opcao.txt", $opcao_selecionada);

    echo "Opção salva com sucesso!";
}
?>

<style>
    .custom-button {
        padding: 10px 20px;
    }

    .modal-body {
        padding: 20px;
    }

    .card-header h2 {
        margin-bottom: 0;
    }

    .card-body {
        padding: 20px;
    }

    .ctinput label {
        display: block;
        margin-bottom: 10px;
    }

    .ctinput input[type="text"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .ctbtn {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .ctbtn:hover {
        background-color: #0056b3;
    }

    .custom-button {
        width: 100%;
        margin-top: 20px;
    }
</style>

<div class="col-md-6 mx-auto">
    <div class="modal fade" id="how2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"></div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="https://www.tvsportguide.com/page/widget/"><button type="button" class="btn btn-primary">Go to webpage</button></a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="card ctcard">
            <div class="card-header">
                <center>
                    <h2><i class="fa fa-file-image-o"></i> Opções.</h2>
                </center>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="ctinput">
                        <label for="opcoes">Escolha a opção:</label>
                        <select class="custom-button form-control" name="opcoes" id="opcoes">
                            <option value="Automático">Automático</option>
                            <option value="Automático 2">Automático 2</option>
                            <option value="Automático 3">Automático 3</option>
                            <option value="Automático 4 para banner pequeno">Automático 4 para banner pequeno</option>
                            <option value="Manual">Manual</option>
                            <option value="Pagina web">Pagina web</option>
                        </select>
                    </div>
                    <input type="submit" name="submit" value="Salvar" class="ctbtn ctuserbtn">
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

</body>

</html>
