<?php
ini_set('display_errors', 0);
include ('includes/header.php');

?>
<style>
  .custom-button {
    padding: 10px 20px;
  }
    #url-form {
        display: none;
    }
    .custom-input {
        color: blue;
    }

</style>


		<div class="col-md-6 mx-auto">
			<div class="modal fade" id="how2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
	
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
		
				</div>
				</div>
			</div>
			</div>
			<div class="card-body">
				<div class="card ctcard">
					<div class="card-header">
						<center>
							<h2><i class="fa fa-file-image-o"></i> App Logo</h2>
						</center>
					</div>
					<div class="card-body">

<?php
						
						$jsonFilex = './logo/filenames.json';
        
  
                         $jsonDatax = file_get_contents($jsonFilex);
                            
     
                        $imageDatax = json_decode($jsonDatax, true);
                            

                        $filenamex = $imageDatax[0]['ImageName'];
                        $uploadmethord = $imageDatax[0]['Upload_type'];
                        
                        if ($uploadmethord == "by_file") {
                            $string = $filenamex;

                            $imageFilex = "./logo/"."$string";
                            $methord = "   Upload Method";
                        } elseif ($uploadmethord == "by_url") {
                            $imageFilex = "$filenamex";
                            $methord = "   URL Method";
                        }else{
                            $imageFilex = "https://c4.wallpaperflare.com/wallpaper/159/71/731/errors-minimalism-typography-red-wallpaper-preview.jpg";
                            $methord = "";
                        }
                        
                            
						
						echo '<h4>Currently in use:' . $methord . '</h4>';
						echo '<div class="ctradio"><input type="radio" name="upload-type" id="upload-radio" checked> Set Background Using File &nbsp&nbsp</div>';
                        echo '<div class="ctradio"><input type="radio" name="upload-type" id="url-radio"> Set Background Using URL </div>';
                        echo '<div class="ctapplogo"><img class="preview-image" src="' . $imageFilex . '" alt="Uploaded Image" width="600" height="300"> </div>';
                        
                        
                        if (isset($_POST['upload'])) {
     

                        
                                $selectedFiles = ['logo.png', 'index.php', 'iimg.json', 'filenames.json', 'binding_dark.webp', 'bg.jpg', 'api.php', 'favicon.ico', 'logo_ne.png' , '.htaccess', 'bg.php']; // Example array of selected files
                                $folderPath = './logo/'; 
                                
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
                        

                                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                                if (in_array($fileType, $allowedTypes)) {
    
                                    $uploadPath = './logo/';
                                    $fileName = uniqid() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
                                    $destination = $uploadPath . $fileName;
                        

                                    if (move_uploaded_file($fileTemp, $destination)) {
                                        echo "<script>window.location.href='mRTXlogo.php';</script>";
                                        
                                        $jsonFilePath = './logo/filenames.json';
                                        $jsonData = json_encode([["ImageName" => $fileName, 'Upload_type' => 'by_file']]);
                                        file_put_contents($jsonFilePath, $jsonData);
                                    } else {
                                        echo 'Failed to move the uploaded file.';
                                    }
                                } else {
                                    echo 'Invalid file type. Only JPEG, PNG, and GIF images are allowed.';
                                }
                            }
                        }

                            if (isset($_POST['url-submit'])) {
                                $imageUrl = $_POST['image-url'];
                            

                                if (filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                                    $jsonFilePath = './logo/filenames.json';
                            

                                    $newImageData = [
                                        'ImageName' => $imageUrl,
                                        'Upload_type' => 'by_url'
                                    ];
                            
   
                                    $jsonData = file_get_contents($jsonFilePath);
                            

                                    $imageData = json_decode($jsonData, true);
                            

                                    $imageData[0] = $newImageData;
                            

                                    $jsonData = json_encode($imageData);
                            

                                    if (file_put_contents($jsonFilePath, $jsonData)) {
                                        echo "<script>window.location.href='mRTXlogo.php';</script>";
                                    } else {
                                        echo 'Failed to save the image data to the JSON file.';
                                    }
                                } else {
                                    echo 'Invalid URL.';
                                }
                            }

                        ?>
                        
                        <!--<form method="post" enctype="multipart/form-data">
                            <label for="image">Select an Image to upload:</label>
                            <input class="custom-button" type="file" name="image" id="image" accept="image/jpeg, image/png, image/gif">
                            <button class="custom-button btn btn-success btn-icon-split" type="submit" name="upload">Upload</button>
                        </form>
                        <form method="post">
                            <label for="image-url">Select an Image to URL:</label>
                            <input class="custom-button" type="text" name="image-url" id="image-url" placeholder="https://example.com/image.jpg">
                            <button class="custom-button btn btn-success btn-icon-split" type="submit" name="url-submit">Submit URL</button>
                        </form>-->
                        
                        
                        <form method="post" enctype="multipart/form-data" id="upload-form">
							<div class="ctinput ctfile">
                            <label for="image">Select an Image to upload:</label>
							<input class="custom-button" type="file" name="image" id="image" accept="image/jpeg, image/png, image/gif">
                            </div>
							<button class="custom-button btn btn-success btn-icon-split ctbtn ctuserbtn" type="submit" name="upload">Upload</button>
                        </form>
                        
                        <form method="post" id="url-form">
                            <div class="ctinput">
							<label for="image-url">Select an Image URL:</label>
                            <input class="custom-button" type="text" name="image-url" id="image-url" placeholder="https://example.com/image.jpg">
                            </div>
							<button class="custom-button btn btn-success btn-icon-split ctbtn ctuserbtn" type="submit" name="url-submit">Submit URL</button>
                        </form>
                        
                        <script>
                            const uploadRadio = document.getElementById('upload-radio');
                            const urlRadio = document.getElementById('url-radio');
                            const uploadForm = document.getElementById('upload-form');
                            const urlForm = document.getElementById('url-form');
                        
                            uploadRadio.addEventListener('change', () => {
                                uploadForm.style.display = 'block';
                                urlForm.style.display = 'none';
                            });
                        
                            urlRadio.addEventListener('change', () => {
                                uploadForm.style.display = 'none';
                                urlForm.style.display = 'block';
                            });
                        </script>


                            
							
					</div>
					</div>
				</div>
		</div>

<?php include ('includes/footer.php');?>

</body>
</html>