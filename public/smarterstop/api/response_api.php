<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    if (isset($data['action']) && $data['action'] === "getAnnouncement") {
        $myres = '{"sc":"'.$data['sc'].'","status":true,"response":[]}';
        echo $myres;
    } else {
        echo "Invalid request";
    }
} else {
    echo "Only POST requests are allowed";
}
?>
