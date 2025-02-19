<!DOCTYPE html>
<html>
<head>
    <title>Side-by-Side PHP Files</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        .container {
            display: flex;
            height: 100%;
        }

        .iframe-wrapper {
            flex: 1;
            position: relative;
            margin-right: 0px; /* Adjust the spacing between iframes */
        }

        .iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .space-between-iframes {
            width: 10px; /* Adjust the width of the space between iframes */
            background-color: rgba(255,192,203, 0.7); /* Transparent red color */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="iframe-wrapper">
            <iframe src="webview.php" class="iframe"></iframe>
        </div>
        <div class="space-between-iframes"></div>
        <div class="iframe-wrapper">
            <iframe src="sport.php" class="iframe"></iframe>
        </div>
    </div>
</body>
</html>
