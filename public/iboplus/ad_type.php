<?php
if (isset($_POST['adType'])) {
    $jsonFilePath = 'includes/ad_type.json';
    $jsonData = json_decode(file_get_contents($jsonFilePath), true);
    $jsonData['adType'] = $_POST['adType'];
    file_put_contents($jsonFilePath, json_encode($jsonData));
}
?>
