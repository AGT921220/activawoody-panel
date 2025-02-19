<?php
$target_url = "https://www.thesportsdb.com/tv_main.php";

$content = file_get_contents($target_url);

$text_replacements = array(
    "../" => "https://www.thesportsdb.com/",
    "/images/icons/calendar.png" => "https://www.thesportsdb.com/images/icons/calendar.png",
    "/images/icons/time.png" => "https://www.thesportsdb.com/images/icons/time.png"
);

$content = str_replace(array_keys($text_replacements), array_values($text_replacements), $content);

$content = preg_replace('/(<img[^>]+)(>)/i', '$1 style="border-radius: 10px;"$2', $content);


$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML($content);
libxml_use_internal_errors(false);

$xpath = new DOMXPath($dom);
$linkElements = $xpath->query('//a');
foreach ($linkElements as $linkElement) {
    $linkElement->removeAttribute('href');
}

$xpath = new DOMXPath($dom);
$tdElements = $xpath->query('//td');
foreach ($tdElements as $tdElement) {
    $tdElement->setAttribute('style', 'text-align: left; vertical-align: top; width: 20%; color: white; text-shadow: 2px 2px 2px black;');
}

$xpath = new DOMXPath($dom);
$htmlElement = $xpath->query('//html')->item(0);
if ($htmlElement) {
    $htmlElement->setAttribute('style', 'background-color: red;');
}

$xpath = new DOMXPath($dom);
$table = $xpath->query('//table')->item(0);

if ($table) {
    $html = $dom->saveXML($table);
    echo $html;
} else {
    echo "Table not found.";
}
?>
