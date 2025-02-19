<?php
// Base path to the image file without the extension
$image_base_path = __DIR__ . '/../backgrounds/background_image';

// List of supported image extensions
$supported_extensions = ['jpg', 'jpeg', 'png', 'gif'];

// Check for the file with supported extensions
$image_file = '';
foreach ($supported_extensions as $ext) {
    $current_file = $image_base_path . '.' . $ext;
    if (file_exists($current_file)) {
        $image_file = $current_file;
        break;
    }
}

if ($image_file) {
    // Determine the protocol
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

    // Construct the base path from PHP_SELF to locate the correct directory
    $script_name = $_SERVER['PHP_SELF'];
    $script_path = dirname($script_name);

    // Remove the /api from the path to reach the backgrounds directory
    $base_path = str_replace('/api', '', $script_path);

    // Construct the full URL using HTTP_HOST and calculated path
    $host = $_SERVER['HTTP_HOST'];
    $image_url = $protocol . '://' . $host . $base_path . '/backgrounds/' . basename($image_file);

    // Redirect to the image URL
    header('Location: ' . $image_url);
    exit;
} else {
    // If the image does not exist, send a 404 response
    header('HTTP/1.0 404 Not Found');
    echo 'Image not found.';
}
?>
