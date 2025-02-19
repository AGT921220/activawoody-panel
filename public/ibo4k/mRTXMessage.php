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
				</div>
				</div>
			</div>
			</div>
			<div class="card-body">
				<div class="card bg-primary text-white">
					<div class="card-header">
						<center>
							<h2><i class="fa fa-commenting"></i> Notification </h2>
						</center>
					</div>
					<div class="card-body">
							
			<?php
                    $jsonFilePath = './api/message.json';
                
                    $existingData = json_decode(file_get_contents($jsonFilePath), true);
                
                    if (isset($_POST['updateButton'])) {
                        $data = array(
                            'first_message' => $_POST['first_message'],
                            'second_message' => $_POST['second_message']
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
                        <label for="first_message">Title:</label>
                        <div class="form-group">
                                <input type="text" class="form-control" name="first_message" value="<?php echo isset($currentRecord['first_message']) ? $currentRecord['first_message'] : ''; ?>" required>
                        </div>
                        <label for="second_message">Content:</label>
                        <div class="form-group">
                                <input type="text" class="form-control" name="second_message" value="<?php echo isset($currentRecord['second_message']) ? $currentRecord['second_message'] : ''; ?>" required>
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