<?php
include ('includes/header.php');
?>



		<div class="col-md-6 mx-auto">
			<div class="modal fade" id="how2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">How to Get the API Key</h5>
				</div>
				<div class="modal-body">
					<p>Go to the website https://www.tvsportguide.com/page/widget/ , scroll to the bottom enter some BS info and it will give you url like below. The portion in red is what you need.
					<p><small>https://www.tvsportguide.com/widget/<em style="color:red;">5cc316f797659</em>?filter_mode=all&filter_value</small></p>
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
							<h2><i class="fa fa-wrench"></i> Setup Video link</h2>
						</center>
					</div>
					<div class="card-body">
                            <form action="" method="post">
                                </b>
                                <label for="inputText">Support .mp4 / .avi / .m3u8 :</label>
                                <div>
                                <input type="text" class="form-control" name="inputText" id="inputText" value="<?php echo getCurrentValue(); ?>" required>
                                <div>
                                 <div>
                                    <button class="btn btn-info" type="submit" name="submit">Save</button>
                                </div>
                                <div>
                            </form>
                            
                        
                            <?php
                            
                            function getCurrentValue() {
                                    $fileName = "./api/rtx.json";
                                    if (file_exists($fileName)) {
                                        $jsonData = file_get_contents($fileName);
                                        $data = json_decode($jsonData, true);
                                        if (isset($data["mVideoURL"])) {
                                            return htmlspecialchars($data["mVideoURL"]);
                                        }
                                    }
                                    return "";
                                }
                            
                            
                            
                            if (isset($_POST["submit"])) {
                                // Get the input text from the form
                                $inputText = $_POST["inputText"];
                        
                                // Create an associative array with the input text
                                $data = array("mVideoURL" => $inputText);
                        
                                // Convert the array to JSON format
                                $jsonData = json_encode($data);
                        
                                // Specify the file name to save the JSON data
                                $fileName = "./api/rtx.json";
                        
                                // Save the JSON data to the file
                                file_put_contents($fileName, $jsonData);
                        
                                echo "<p>Data saved successfully!</p>";
                                echo "<script>window.location.href='homevideo.php';</script>";
                            }
                            ?>
						</div>
					</div>
				</div>
		</div>

<?php include ('includes/footer.php');?>

</body>
</html>