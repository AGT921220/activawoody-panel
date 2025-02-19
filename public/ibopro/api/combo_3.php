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
    
<?php
            function getCurrentValue() {
                $fileName = "rtx.json";
                if (file_exists($fileName)) {
                    $jsonData = file_get_contents($fileName);
                    $data = json_decode($jsonData, true);
                    if (isset($data["mVideoURL"])) {
                        return htmlspecialchars($data["mVideoURL"]);
                    }
                }
                return "";
            }
            ?>    
</head>
<body>
    <div class="container">
        <div class="iframe-wrapper">
           <iframe src="sport.php" class="iframe"></iframe>
        </div>
    </div>
</body>
</html>
