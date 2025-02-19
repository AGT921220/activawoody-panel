<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleção de Cores e Mensagem</title>
    <!-- Integração com Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
        }
        .color-picker {
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        }
        .color-preview {
            width: 30px;
            height: 30px;
            display: inline-block;
            border-radius: 50%;
            margin-left: 10px;
            border: 1px solid #ccc;
            cursor: pointer;
        }
        .color-preview:hover {
            transform: scale(1.1);
        }
        .color1-preview {
            background-color: #ff6347; /* Cor de exemplo */
        }
        .color2-preview {
            background-color: #00bfff; /* Cor de exemplo */
        }
        .color3-preview {
            background-color: #7cfc00; /* Cor de exemplo */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4">Selecionar Cores e Mensagem</h2>
        <form method="post" action="process_colors.php">
            <div class="form-group">
                <label for="message">Mensagem:</label>
                <input type="text" class="form-control" id="message" name="message" required>
            </div>
            <div class="form-group">
                <label for="color1">Cor 1:</label>
                <input type="color" class="color-picker" id="color1" name="color1" value="#ff6347" required>
                <div class="color-preview color1-preview"></div>
            </div>
            <div class="form-group">
                <label for="color2">Cor 2:</label>
                <input type="color" class="color-picker" id="color2" name="color2" value="#00bfff" required>
                <div class="color-preview color2-preview"></div>
            </div>
            <div class="form-group">
                <label for="color3">Cor 3:</label>
                <input type="color" class="color-picker" id="color3" name="color3" value="#7cfc00" required>
                <div class="color-preview color3-preview"></div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Salvar Cores e Mensagem</button>
        </form>
    </div>

    <!-- Integração com jQuery para exibir a pré-visualização das cores -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // Atualiza a pré-visualização da cor ao alterar o valor do input type="color"
        $(document).ready(function() {
            $('#color1').change(function() {
                $('.color1-preview').css('background-color', $(this).val());
            });
            $('#color2').change(function() {
                $('.color2-preview').css('background-color', $(this).val());
            });
            $('#color3').change(function() {
                $('.color3-preview').css('background-color', $(this).val());
            });
        });
    </script>
</body>
</html>
