<?php
// Lê a opção salva no arquivo texto
$opcao = file_get_contents("opcao1.txt");

// Redireciona para a página correspondente à opção selecionada
header("Location: $opcao");
exit;
?>
