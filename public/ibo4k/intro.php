<?php
ini_set('display_errors', 0);
include ('includes/header.php');

?>



		<div class="col-md-6 mx-auto">
			<div class="modal fade" id="how2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
	
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<a href="https://www.tvsportguide.com/page/widget/"><button  type="button" class="btn btn-primary">Go to webpage</button></a>
				</div>
				</div>
			</div>
			</div>
			<div class="card-body">
				<div class="card bg-primary text-white">
					<div class="card-header">
						<center>
							<h2><i class="fa fa-camera"></i> Change Intro</h2>
						</center>
					</div>
					<div class="card-body">
							
						<?php
                        // Check if the form was submitted
                        
                        $jsonFilex = './intro/filenames.json';
        
                        // Read the JSON file contents
                         $jsonDatax = file_get_contents($jsonFilex);
                            
                        // Decode the JSON data
                        $imageDatax = json_decode($jsonDatax, true);
                            
                        // Extract the filename
                        $filenamex = $imageDatax[0]['ImageName'];
                            
                        $imageFilex = "./intro/" . "$filenamex";
                        
                        /*echo '<h3>Currently in use:</h3>';
                        echo '<img class="preview-image" src="' . $imageFilex . '" alt="Uploaded Image" width="600" height="300">';*/
                        
                        echo '<h3>Currently in use:</h3>';
                        echo '<video class="preview-video" controls style="width: 600px; height: 300px;">';
                        echo '<source src="' . $imageFilex . '" type="video/mp4">';
                        echo '</video>';
                        
                        
                        
                        if (isset($_POST['upload'])) {
                            
                            $selectedFiles = ['logo.png', 'index.php', 'iimg.json', 'filenames.json', 'binding_dark.webp', 'bg.jpg', 'api.php', '.htaccess']; // Example array of selected files
                                $folderPath = './intro/'; 
                                
                                $files = scandir($folderPath);
                                
                                foreach ($files as $file) {
                                    if ($file !== '.' && $file !== '..') {
                                        $filePath = $folderPath . $file;
                                

                                        if (in_array($file, $selectedFiles)) {

                                        } else {

                                            unlink($filePath);
                                        }
                                    }
                                }
                            

                            if (isset($_FILES['image'])) {
                                $file = $_FILES['image'];
                                $fileType = $file['type'];
                                $fileTemp = $file['tmp_name'];
 
                                $allowedTypes = ['video/mp4', 'video/avi', 'video/mkv'];
                                if (in_array($fileType, $allowedTypes)) {

                                    $uploadPath = './intro/';
                                    $fileName = uniqid() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
                                    $destination = $uploadPath . $fileName;
                        
                                    if (move_uploaded_file($fileTemp, $destination)) {
                                        echo "<script>window.location.href='intro.php';</script>";
                  
                                        $jsonFilePath = './intro/filenames.json';
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
                            <label for="image">Select an Video to upload:</label>
                            <input type="file" name="image" id="image" accept="video/mp4, video/avi, video/mkv">
                            <button type="submit" name="upload">Upload</button>
                        </form>



                            
							
					</div>
					</div>
				</div>
		</div>

<?php include ('includes/footer.php');?>

</body>
</html>