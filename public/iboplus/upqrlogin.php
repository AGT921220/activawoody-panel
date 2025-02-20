<?php
if (isset($_POST['submit'])) {
    $target_dir = "./api/qrlogin/";

    // Processa a imagem do banner
    $banner_file = $target_dir . basename($_FILES["banner"]["name"]);
    $imageFileType = strtolower(pathinfo($banner_file, PATHINFO_EXTENSION));

    // Valida o envio da imagem
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

    // Atualiza a p¨¢gina ap¨®s o envio
    echo "<meta http-equiv='refresh' content='0'>";
}
?>
