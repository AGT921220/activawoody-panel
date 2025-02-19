<?php
error_reporting(0);

if (file_exists('ovpn.zip')) {
	unlink('ovpn.zip');
}

$rootPath = realpath('./../vpn');
$zip = new ZipArchive();
$zip->open('ovpn.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
$filesToDelete = [];
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootPath), RecursiveIteratorIterator::LEAVES_ONLY);

foreach ($files as $name => $file) {
	if (!$file->isDir()) {
		$filePath = $file->getRealPath();
		$relativePath = substr($filePath, strlen($rootPath) + 1);
		$zip->addFile($filePath, $relativePath);
	}
}

$zip->close();
$url = 'ovpn.zip';
header('Content-Description: File Transfer');
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename=' . $url);
readfile($url);
exit();
