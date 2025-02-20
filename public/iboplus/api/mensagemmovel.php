<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página com Mensagem</title>
    <!-- Integração com Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: transparent; /* Fundo transparente */
        }
        .mensagem {
            position: fixed;
            top: 17%;
            right: -100%; /* Começa fora da tela à direita */
            white-space: nowrap; /* Impede quebra de linha */
            z-index: 1000;
            font-size: 20px;
            line-height: 1.6;
            color: red; /* Cor padrão */
        }
    </style>
</head>
<body>
    <div class="mensagem" id="mensagem"></div>

    <!-- Integração com jQuery (necessário para mostrar a mensagem) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Função para exibir a mensagem com os dados do PHP
            function exibirMensagem(mensagem, cor) {
                var mensagemDiv = $('#mensagem');
                mensagemDiv.html('<strong style="color: ' + cor + '">' + mensagem + '</strong>');

                // Função para animar a mensagem da direita para a esquerda
                function animaMensagem() {
                    mensagemDiv.css('right', '-100%'); // Reseta a posição para fora da tela
                    mensagemDiv.animate({ right: '100%' }, 30000, 'linear', function() {
                        animaMensagem(); // Chama a função novamente para criar o loop
                    });
                }

                animaMensagem(); // Chama a função de animação inicialmente
            }
            
            <?php
                // Define o caminho para o arquivo de texto
                $file_path = "../ad_descriptions.txt";

                // Lê o conteúdo do arquivo de texto
                $content = file_get_contents($file_path);

                // Divide o conteúdo em mensagem e cor
                $lines = explode("\n", $content);
                
                if(count($lines) >= 2) {
                    $mensagem = trim($lines[0]);
                    $cor = trim($lines[1]);
                    
                    // Se a cor não estiver vazia, aplique-a na mensagem
                    if (!empty($cor)) {
                        echo 'exibirMensagem("' . $mensagem . '", "' . $cor . '");';
                    } else {
                        // Caso a cor não esteja definida, use a cor padrão
                        echo 'exibirMensagem("' . $mensagem . '", "red");';
                    }
                } else {
                    // Se o arquivo não contém informações suficientes, exiba um aviso
                    echo 'console.error("O arquivo de descrições não contém informações suficientes.");';
                }
            ?>
        });
    </script>
</body>
</html>
