<?php
error_reporting(0);
$db = new SQLite3('intro.db');
$intro = $db->querySingle('SELECT url FROM intro WHERE id=1');

if (!empty($intro)) {
    header('Location: ' . $intro);
    exit();
} else {
    header('Location: https://google.com');
    exit();
}
?>
