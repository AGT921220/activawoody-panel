<?php include 'includes/header.php'; ?>
<style>
    /* Estilo para botões verdes */
    .btn-green {
        background-color: #1cc88a; /* Cor de fundo verde */
        color: white; /* Cor do texto branco */
        padding: 10px 20px; /* Espaçamento interno */
        border: none; /* Sem borda */
        border-radius: 5px; /* Bordas arredondadas */
        cursor: pointer; /* Cursor de mão ao passar */
        text-decoration: none; /* Sem sublinhado */
    }

    .btn-green:hover {
        background-color: #17A673; /* Cor de fundo mais escura */
    }

    /* Estilo para a tabela */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        color: #333;
        font-weight: bold;
    }

    td {
        background-color: #fff;
        color: #555;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f5f5f5;
        transition: background-color 0.3s ease;
    }

    .action-buttons button {
        padding: 5px 10px;
        margin-right: 5px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .action-buttons button.delete {
        background-color: #e74c3c;
        color: #fff;
    }

    .action-buttons button.delete:hover {
        background-color: #c0392b;
    }
</style>

<div class="col-lg-12">
    <div class="card border-left-primary shadow h-100 card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Gerenciar Banner</h6>
        </div>
        <div class="card-body">
            <button class="btn-green" onclick="showForm()">Adicionar Banner</button>

            <!-- Formulário de adicionar banner (inicialmente oculto) -->
            <div class="card-header py-3" id="bannerForm" style="display: none;">
                <h1 class="h3 mb-1 text-gray-800">Adicionar Novo Banner</h1>
                <form action="upqrlogin.php" method="post" enctype="multipart/form-data">
                    <label for="banner">Selecione a Imagem:</label>
                    <input type="file" name="banner" id="banner" required><br><br>

                    <label for="bannerText">Texto do Banner:</label>
                    <input type="text" name="bannerText" id="bannerText" placeholder="Digite o texto do banner" required><br><br>

                    <input class="btn-green" type="submit" value="Enviar" name="submit">
                </form>
            </div>

            <h2>Banners Existentes</h2>
            <table>
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Texto</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Diretório onde os banners são armazenados
                    $directory = "./api/qrlogin/";

                    // Verifica se o diretório de uploads existe e é acessível
                    if (is_dir($directory) && is_readable($directory)) {
                        // Obtém todos os arquivos de imagem no diretório de uploads
                        $banner_files = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

                        // Inverte a ordem dos arquivos para exibir os mais recentes primeiro
                        $banner_files = array_reverse($banner_files);

                        // Exibe os banners na tabela
                        foreach ($banner_files as $file) {
                            $text_file = $directory . pathinfo($file, PATHINFO_FILENAME) . ".txt";
                            $banner_text = file_exists($text_file) ? file_get_contents($text_file) : "Sem texto";

                            echo "<tr>";
                            echo "<td><img src='$file' alt='$file' width='100'></td>";
                            echo "<td>$banner_text</td>";
                            echo "<td class='action-buttons'>";
                            echo "<button class='btn-green delete' onclick='confirmDelete(\"$file\")'>Excluir</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>O diretório de uploads não existe ou não é acessível.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <script>
                // Função para mostrar o formulário de adicionar banner
                function showForm() {
                    document.getElementById("bannerForm").style.display = "block";
                }

                // Função para confirmar a exclusão do banner
                function confirmDelete(filename) {
                    if (confirm("Tem certeza que deseja excluir este banner?")) {
                        window.location.href = "qrlogin.php?delete=" + filename;
                    }
                }
            </script>

            <?php
            // Lógica para exclusão do banner
            if (isset($_GET['delete'])) {
                $filename = $_GET['delete'];
                if (file_exists($filename)) {
                    unlink($filename);

                    // Excluir o arquivo de texto associado
                    $text_file = $directory . pathinfo($filename, PATHINFO_FILENAME) . ".txt";
                    if (file_exists($text_file)) {
                        unlink($text_file);
                    }

                    echo "<script>alert('Banner excluído com sucesso.');</script>";
                    echo "<meta http-equiv='refresh' content='0'>";
                    exit;
                }
            }

            // Lógica para o upload do banner e texto
            if (isset($_POST['submit'])) {
                $target_dir = "./api/qrlogin/";

                // Processa a imagem do banner
                $banner_file = $target_dir . basename($_FILES["banner"]["name"]);
                $imageFileType = strtolower(pathinfo($banner_file, PATHINFO_EXTENSION));

                if (move_uploaded_file($_FILES["banner"]["tmp_name"], $banner_file)) {
                    echo "Banner enviado com sucesso.<br>";
                } else {
                    echo "Desculpe, houve um erro ao enviar o arquivo.<br>";
                }

                // Processa o texto do banner
                $bannerText = htmlspecialchars($_POST['bannerText']);
                $text_file = $target_dir . pathinfo($banner_file, PATHINFO_FILENAME) . ".txt";

                // Salva o texto em um arquivo .txt
                if (file_put_contents($text_file, $bannerText)) {
                    echo "Texto salvo com sucesso.<br>";
                } else {
                    echo "Desculpe, houve um erro ao salvar o texto.<br>";
                }

                // Atualiza a página após o envio
                echo "<meta http-equiv='refresh' content='0'>";
            }
            ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
