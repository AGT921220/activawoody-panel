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
							<h2><i class="fa fa-desktop"></i> Setup Demo</h2>
						</center>
					</div>
					<div class="card-body">
							
			<?php
                    $jsonFilePath = './api/trial.json';
                
                    $existingData = json_decode(file_get_contents($jsonFilePath), true);
                
                    if (isset($_POST['updateButton'])) {
                        $data = array(
                            'playlistName' => $_POST['playlistName'],
                            'dns' => $_POST['dns'],
                            'username' => $_POST['username'],
                            'password' => $_POST['password']
                        );
                
                        if (!empty($existingData)) {
                            $existingData[0] = $data;
                            file_put_contents($jsonFilePath, json_encode($existingData, JSON_PRETTY_PRINT));
                
                            echo "<p>Record has been updated successfully!</p>";
                        } else {
                            echo "<p>No records found in the JSON file.</p>";
                        }
                    }
                    $currentRecord = !empty($existingData) ? $existingData[0] : array();
                    ?>
                
                    <form method="post">
                        <label for="playlistName">Playlist Name:</label>
                        <div class="form-group">
                                <input type="text" class="form-control" name="playlistName" value="<?php echo isset($currentRecord['playlistName']) ? $currentRecord['playlistName'] : ''; ?>" required>
                        </div>
                        <label for="dns">DNS:</label>
                        <div class="form-group">
                                <input type="text" class="form-control" name="dns" value="<?php echo isset($currentRecord['dns']) ? $currentRecord['dns'] : ''; ?>" required>
                        </div>
                        <label for="username">Username:</label>
                        <div class="form-group">
                                <input type="text" class="form-control" name="username" value="<?php echo isset($currentRecord['username']) ? $currentRecord['username'] : ''; ?>" required>
                        </div>
                        <label for="password">Password:</label>
                        <div class="form-group">
                                <input type="text" class="form-control" name="password" value="<?php echo isset($currentRecord['password']) ? $currentRecord['password'] : ''; ?>" required>
                        </div>
                        <input type="submit" class="custom-button btn btn-success btn-icon-split" name="updateButton" value="Save and Update">
                    </form>
					</div>
					</div>
				</div>
		</div>

<?php include ('includes/footer.php');?>

</body>
</html>