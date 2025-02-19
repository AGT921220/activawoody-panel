<?php

ini_set("display_errors", 0);
require_once "../includes/functions.php";

$db = new SQLite3("./.db.db");
$resT = $db->querySingle("SELECT type FROM type WHERE id=1");

if ($resT == "rt") {
    rt_();
} else if ($resT == "ua") {
    ua_();
}

function ua_() {
    error_reporting(0);
    $db = new SQLite3('./.db.db');
    $note = $db->query('SELECT * FROM ads');
    $path = array();

    while ($notes = $note->fetchArray(SQLITE3_ASSOC)) {
        $path[] = array('path' => $notes['path']);
    }

    if (!empty($path)) {
        $data['result'] = 'success';
        $data['data']['vertical']['adds'] = $path;
        $data['data']['vertical']['count'] = count($data['data']['vertical']['adds']);
    } else {
        $data['result'] = 'error';
        $data['msg'] = 'No data found in the database';
    }

    echo json_encode($data);
    die();
}

function rt_() {
    $url = "https://www.fandango.com/movies-in-theaters";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $page = curl_exec($ch);
    curl_close($ch);

    $doc = new DOMDocument();
    @$doc->loadHTML($page);
    $divs = $doc->getElementsByTagName("img");
    $id = 0;
    $data = array();
    foreach ($divs as $div)  {
        if ($div->hasAttribute("class") && $div->getAttribute("class") == "f-logo-bg poster-card--img poster-card--img__small visual-thumb") {
            $img = urldecode($div->getAttribute("src"));
            if ($img != "") {
                $data[] = ["id" => $id, "title" => "FTG_" . $id, "type" => "image", "link" => "", "description" => "FTG", "orderby" => "0", "position" => "horizontal", "extension" => "png", "createdon" => "2022-05-15 03:32:03", "path" => $img, "orignal" => $img, "thumbpath" => $img];
                $id++;
            }
        }
    }
    $jdata = json_encode($data);
    echo "{\t\"result\":\"success\",\r\n\t\t\"data\":{\r\n\t\t\t\"vertical\":{\r\n\t\t\t\t\"adds\":\r\n\t\t\t" . $jdata . ",\r\n\t\t\t\"count\": 5\r\n\t\t\t}\r\n\t\t}\r\n\t}";
    die();
}
?>

