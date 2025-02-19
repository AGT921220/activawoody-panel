<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebView Layout Responsivo</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Wrapper para centralizar o conteúdo */
        .wrapper {
            width: 95%; /* Ocupar 90% da largura da tela */
            height: 100%; /* Ocupar 95% da altura */
            margin-right: 5%;
            display: flex;
            position: relative; /* Para manter os iframes estáticos */
        }

        /* Borda esquerda */
        .border {
            position: fixed; /* Fixa a borda na tela */
            width: 1%; /* 10% para a borda final */
            height: 100%; /* A altura é a mesma do wrapper */
            background-color: transparent; /* Transparente */
            left: 0; /* Fixa à esquerda */
        }

        /* Iframes que dividem o espaço restantes */
        .content {
            flex: 1; /* Preencher o espaço restante */
            display: flex; /* Flexbox para colocar os iframes lado a lado */
            margin-left: 1%; /* Margem para deixar espaço para a borda */
        }

        iframe {
            flex: 1; /* Preencher o espaço disponível */
            height: 100%;
            border: none; /* Remove a borda azul */
            box-sizing: border-box; /* Inclui a borda no cálculo da largura/altura */
            border-radius: 10px; /* Bordas arredondadas */
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <!-- Borda final -->
        <div class="border"></div>

        <!-- Container para os iframes -->
        <div class="content">
            <!-- Primeiro iframe -->
            <iframe src="autop.php"></iframe>

            <!-- Segundo iframe -->
            <iframe src="banner2.php"></iframe>
        </div>
    </div>

</body>
</html>
