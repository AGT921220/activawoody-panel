<?php
        $jsonFile = '../Background/filenames.json';
        
        $jsonData = file_get_contents($jsonFile);
        
        $imageData = json_decode($jsonData, true);
        
        $filename = $imageData[0]['ImageName'];
        $type = $imageData[0]['Upload_type'];
        
        $parsedUrl = parse_url($_SERVER['REQUEST_URI']);
        $currentPath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/';
        
        $imageFile = "$filename";

header("Content-Type: image/jpeg");
if($type == 'by_file'){
    header('Location: '.'../Background/'.$imageFile);
}else{
   header('Location: '.$imageFile); 
}

exit;
?>
