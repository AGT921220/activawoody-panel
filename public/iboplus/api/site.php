<?php
ini_set('display_errors', 0);
include('includes/header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Salva a URL inserida em um arquivo chamado "url.txt" na pasta "./api"
    $url = $_POST["url"];
    file_put_contents("./api/url.txt", $url);

    echo "URL salva com sucesso!";
}
?>

<style>
    .custom-button {
        padding: 10px 20px;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #007bff;
        color: #fff;
        border-radius: 10px 10px 0 0;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .logo {
        position: absolute;
        top: 20px;
        left: 20px;
        width: 100px;
        height: auto;
    }
</style>

<img src="logo.png" alt="Logo" class="logo">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Adicionar URL:</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="url">URL:</label>
                            <input type="text" class="form-control" name="url" id="url">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
