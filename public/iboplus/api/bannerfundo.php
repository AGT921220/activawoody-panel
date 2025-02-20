<?php
// Lê a opção salva no arquivo texto
$opcao = file_get_contents("opcaofundo.txt");

// Redireciona para a página correspondente à opção selecionada
header("Location: $opcao");
exit;
?>
