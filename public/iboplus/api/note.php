<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página com Balão</title>
    <!-- Integração com Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: transparent; /* Fundo transparente */
        }
        .baloon-container {
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            overflow: hidden;
        }
        .baloon {
            width: 100%;
            max-width: 90%;
            padding: 20px;
            background: linear-gradient(135deg, var(--color1), var(--color2), var(--color3));
            border-radius: 20px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
            font-size: 16px;
            color: white;
            text-align: center;
            word-wrap: break-word;
        }
        .hidden-message {
            visibility: hidden; /* Mensagem invisível */
        }
    </style>
</head>
<body>
    <div class="baloon-container">
        <div class="baloon" id="baloon">
            <span class="hidden-message" id="hidden-message"></span>
        </div>
    </div>

    <!-- Integração com jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Função para exibir a mensagem com os dados do PHP
            function exibirMensagem(mensagem, cor1, cor2, cor3) {
                var baloonDiv = $('#baloon');
                var hiddenMessageDiv = $('#hidden-message');
                document.documentElement.style.setProperty('--color1', cor1);
                document.documentElement.style.setProperty('--color2', cor2);
                document.documentElement.style.setProperty('--color3', cor3);
                hiddenMessageDiv.html('<strong>' + mensagem + '</strong>');
            }
            
            <?php
                // Define o caminho para o arquivo de texto
                $file_path = "cores.txt";

                // Lê o conteúdo do arquivo de texto
                $content = file_get_contents($file_path);

                // Divide o conteúdo em mensagem e cores
                $lines = explode("\n", $content);
                
                if(count($lines) >= 4) {
                    $mensagem = trim($lines[0]);
                    $cor1 = trim($lines[1]);
                    $cor2 = trim($lines[2]);
                    $cor3 = trim($lines[3]);
                    
                    echo 'exibirMensagem("' . $mensagem . '", "' . $cor1 . '", "' . $cor2 . '", "' . $cor3 . '");';
                } else {
                    // Se o arquivo não contém informações suficientes, exiba um aviso
                    echo 'console.error("O arquivo de descrições não contém informações suficientes.");';
                }
            ?>
        });
    </script>
</body>
</html>
