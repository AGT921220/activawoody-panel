<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrossel de Banners</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        .banner-carousel {
            width: 100%;
            height: 100%;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .banner-slide {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            display: flex; /* Exibir imagem e texto lado a lado */
            transition: opacity 1s ease-in-out;
            align-items: center; /* Centralizar verticalmente o conteúdo */
        }

        .banner-slide.active {
            opacity: 1;
        }

        .banner-image {
            flex: 1;
            width: 100%;
            height: 100%;
            object-fit: contain; /* Ajusta a imagem para caber na tela sem cortar */
        }

        .banner-text {
            flex: 1;
            padding: 20px;
            font-size: 1.5rem;
            color: white; /* Texto branco */
            height: auto;
            box-sizing: border-box;
            display: flex;
            justify-content: center; /* Centraliza o texto horizontalmente */
            align-items: center; /* Centraliza o texto verticalmente */
            text-align: center; /* Centraliza o texto dentro da área */
        }
    </style>
</head>
<body>
    <div class="banner-carousel">
        <?php
        // Diretório onde os banners são armazenados
        $directory = "./qrlogin/";

        // Verifica se o diretório existe e é acessível
        if (is_dir($directory) && is_readable($directory)) {
            // Obtém todos os arquivos de imagem no diretório de uploads
            $banner_files = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

            // Exibe os banners na tabela
            foreach ($banner_files as $index => $file) {
                $class = $index === 0 ? 'banner-slide active' : 'banner-slide';
                $text_file = $directory . pathinfo($file, PATHINFO_FILENAME) . ".txt";

                // Exibe a imagem e o texto associados
                echo "<div class='$class'>";
                echo "<img class='banner-image' src='$file' alt='" . pathinfo($file, PATHINFO_FILENAME) . "'>";
                
                // Exibe o texto associado, se existir
                if (file_exists($text_file)) {
                    $banner_text = file_get_contents($text_file);
                    echo "<div class='banner-text'>$banner_text</div>";
                } else {
                    echo "<div class='banner-text'>Sem texto</div>";
                }

                echo "</div>";
            }
        } else {
            echo "<p>O diretório de uploads não existe ou não é acessível.</p>";
        }
        ?>
    </div>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.banner-slide');
        const totalSlides = slides.length;

        function showNextSlide() {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % totalSlides;
            slides[currentSlide].classList.add('active');
        }

        setInterval(showNextSlide, 5000); // Mudar slide a cada 5 segundos
    </script>
</body>
</html>
