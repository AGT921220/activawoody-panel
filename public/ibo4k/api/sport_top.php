<?php
// Fetch and display another webpage through your URL
$target_url = "https://www.thesportsdb.com/";

// Fetch the content
$content = file_get_contents($target_url);

// Define an array of old and new texts for replacement
$text_replacements = array(
    "../" => "https://www.thesportsdb.com/",
    "/images/icons/calendar.png" => "https://www.thesportsdb.com/images/icons/calendar.png",
    "/images/icons/time.png" => "https://www.thesportsdb.com/images/icons/time.png"
);

// Perform text replacements
$content = str_replace(array_keys($text_replacements), array_values($text_replacements), $content);

// Add rounded corners to <img> elements and reduce image size by 30%
$content = preg_replace_callback('/(<img[^>]+)(>)/i', function($matches) {
    $img_tag = $matches[1];
    $img_tag = preg_replace('/width="(\d+)"/i', '', $img_tag); // Remove existing width attribute
    $img_tag = preg_replace('/height="(\d+)"/i', '', $img_tag); // Remove existing height attribute
    return $img_tag . ' style="border-radius: 10px; max-width: 70%;"' . $matches[2];
}, $content);

// Create a new DOMDocument object
$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML($content);
libxml_use_internal_errors(false);

// Apply white text color and text shadow to <td> elements
$xpath = new DOMXPath($dom);
$tdElements = $xpath->query('//td');
foreach ($tdElements as $tdElement) {
    $tdElement->setAttribute('style', 'text-align: left; vertical-align: top; width: 20%; color: white; text-shadow: 1px 1px 2px black;');
}

// Disable clickable links
$linkElements = $xpath->query('//a');
foreach ($linkElements as $linkElement) {
    $linkElement->removeAttribute('href');
}

// Modify the background color of the HTML output
$htmlElement = $xpath->query('//html')->item(0);
if ($htmlElement) {
    $htmlElement->setAttribute('style', 'background-color: red;');
}

// Hide everything except the table
$table = $xpath->query('//table')->item(4);

if ($table) {
    $html = $dom->saveXML($table);
    echo $html;
} else {
    echo "Table not found.";
}
?>
