<?php
$url = file_get_contents('urlesportes.txt');
if ($url !== false && !empty($url)) {
    header("Location: $url");
    exit();
} else {
    echo "Nenhuma URL foi salva.";
}
?>
