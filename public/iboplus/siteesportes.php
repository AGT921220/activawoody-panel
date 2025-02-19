<?php
ini_set('display_errors', 0);
include('includes/header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Salva a URL inserida em um arquivo chamado "urlurlesportes.txt" na pasta "./api"
    $url = $_POST["url"];
    file_put_contents("./api/urlesportes.txt", $url);

    echo "URL salva com sucesso!";
}
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }

    .container {
        max-width: 500px;
        margin: 50px auto;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .card-header {
        background-color: #007bff;
        color: #fff;
        border-radius: 10px 10px 0 0;
        padding: 20px;
        text-align: center;
    }

    .card-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ced4da;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
        border-color: #007bff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        width: 100%;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Adicionar URL</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="url">URL:</label>
                    <input type="text" class="form-control" name="url" id="url" placeholder="Insira a URL aqui">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
