<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Banners</title>
    <style>
        /* Estilos para o carrossel de banners */
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
        }

        .banner-slide {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .banner-slide.active {
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="banner-carousel">
        <?php
        // Diretório onde os banners são armazenados
        $directory = "./logo/";

        // Verifica se o diretório existe e se é acessível
        if (is_dir($directory) && is_readable($directory)) {
            // Obtém todos os arquivos de imagem no diretório de uploads
            $banner_files = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
            
            // Exibe os banners
            foreach ($banner_files as $index => $file) {
                $class = $index === 0 ? 'banner-slide active' : 'banner-slide';
                $timestamp = filemtime($file); // Obtém o timestamp da última modificação
                echo "<img class='$class' src='$file?t=$timestamp' alt='" . pathinfo($file, PATHINFO_FILENAME) . "'>";
            }
        } else {
            echo "<p>O diretório de uploads não existe ou não é acessível.</p>";
        }
        ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slides = document.querySelectorAll('.banner-slide');
            let currentSlide = 0;

            function showSlide(index) {
                slides.forEach(slide => slide.classList.remove('active'));
                slides[index].classList.add('active');
            }

            function nextSlide() {
                const previousSlide = currentSlide;
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }

            setInterval(nextSlide, 5000); // Troca de slide a cada 5 segundos
        });
    </script>
</body>
</html>
