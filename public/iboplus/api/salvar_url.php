<?php
if(isset($_POST['url'])) {
    $url = $_POST['url'];
    file_put_contents('url.txt', $url);
    echo "URL salva com sucesso!";
} else {
    echo "URL não foi fornecida!";
}
?>
