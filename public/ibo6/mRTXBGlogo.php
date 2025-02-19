<?php
include "includes/header.php";
?>
<style>
  .custom-button {
    padding: 10px 20px;
  }
</style>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800"> Change Logo</h1>
    <!-- Custom codes -->
    <div class="card border-left-primary shadow h-100 card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cogs"></i> Choose</h6>
        </div>
        <div class="card-body">
           <?php
						
						$jsonFilex = './a/rtx/logo_filenames.json';
        
                        // Read the JSON file contents
                         $jsonDatax = file_get_contents($jsonFilex);
                            
                        // Decode the JSON data
                        $imageDatax = json_decode($jsonDatax, true);
                            
                        // Extract the filename
                        $filenamex = $imageDatax[0]['ImageName'];
                            
                        $imageFilex = "./rtx/logo/" . "$filenamex";
						
						echo '<h3>Currently in use:</h3>';
                        echo '<img class="preview-image" src="' . $imageFilex . '" alt="Uploaded Image" width="600" height="300">';
                        
                        
                        if (isset($_POST['upload'])) {
                            // Handle the uploaded file
                            // Check if the form was submitted
                        
                                $selectedFiles = ['logo.png', 'index.php', 'iimg.json', 'filenames.json', 'binding_dark.webp', 'bg.jpg', 'api.php', 'favicon.ico', 'logo_ne.png' , '.htaccess']; // Example array of selected files
                                $folderPath = './rtx/logo/'; // Replace with the actual folder path
                                
                                $files = scandir($folderPath);
                                
                                foreach ($files as $file) {
                                    if ($file !== '.' && $file !== '..') {
                                        $filePath = $folderPath . $file;
                                
                                        // Check if the file is selected
                                        if (in_array($file, $selectedFiles)) {
                                            // File is selected, do nothing
                                        } else {
                                            // Delete the file
                                            unlink($filePath);
                                        }
                                    }
                                }
                                
                            if (isset($_FILES['image'])) {
                                $file = $_FILES['image'];
                                $fileType = $file['type'];
                                $fileTemp = $file['tmp_name'];
                        
                                // Validate the file type
                                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                                if (in_array($fileType, $allowedTypes)) {
                                    // Define the path to store the uploaded image
                                    $uploadPath = './rtx/logo/';
                                    $fileName = uniqid() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
                                    $destination = $uploadPath . $fileName;
                        
                                    // Move the uploaded file to the destination
                                    if (move_uploaded_file($fileTemp, $destination)) {
                                        echo "<script>window.location.href='mRTXBGlogo.php';</script>";
                                        
                                        $jsonFilePath = './a/rtx/logo_filenames.json';
                                        $jsonData = json_encode([["ImageName" => $fileName]]);
                                        file_put_contents($jsonFilePath, $jsonData);
                                    } else {
                                        echo 'Failed to move the uploaded file.';
                                    }
                                } else {
                                    echo 'Invalid file type. Only JPEG, PNG, and GIF images are allowed.';
                                }
                            }
                        }
                        ?>
                        
                        <form method="post" enctype="multipart/form-data">
                            <label for="image">Select an Image to upload:</label>
                            <input  type="file" name="image" id="image" accept="image/jpeg, image/png, image/gif">
                            <button class="custom-button btn btn-success btn-icon-split" type="submit" name="upload">Upload</button>
                        </form>

        </div>
</div>
</div>
<?php
include "includes/footer.php";
?>
</body>
</html>
