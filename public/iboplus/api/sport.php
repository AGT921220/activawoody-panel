<?php
$websiteUrl = 'https://iboa.wctv.fun/teste/api/banner2.php';

$htmlContent = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebView</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
        }
        iframe {
            width: 100%;
            height: 100vh;
            border: none;
        }
    </style>
</head>
<body>
    <iframe id="webview" src="$websiteUrl" frameborder="0" allowfullscreen></iframe>
    <script>
        document.getElementById('webview').onload = function() {
            console.log('Scrolling...');
            document.body.scrollIntoView({ behavior: 'smooth', block: 'end', inline: 'nearest' });
        };
    </script>
</body>
</html>
HTML;

header("Content-Type: text/html");
echo $htmlContent;
?>