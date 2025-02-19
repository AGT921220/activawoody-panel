<?php
$file = 'lang.txt';

// Check if the file exists
if (file_exists($file)) {
    // Read the file contents
    $contents = file_get_contents($file);

    // Output the contents
    echo $contents;
} else {
    echo "The file does not exist.";
}
?>