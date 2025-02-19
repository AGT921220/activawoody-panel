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
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<a href="https://www.tvsportguide.com/page/widget/"><button  type="button" class="btn btn-primary">Go to webpage</button></a>
				</div>
				</div>
			</div>
			</div>
			<div class="card-body">
				<div class="card ctcard">
					<div class="card-header">
						<center>
							<h2><i class="fa fa-file-image-o"></i> In-app add Settings</h2>
						</center>
					</div>
					<div class="card-body">

                    <?php
                        $db = new SQLite3('./api/.db_inapp_ads.db');
                    
                        if (!$db) {
                            die("Database connection error.");
                        }
                    
                        $query = "CREATE TABLE IF NOT EXISTS adsstatus (id INTEGER PRIMARY KEY, adstype TEXT)";
                        if ($db->exec($query)) {
                        } else {
                            echo "Error creating table: " . $db->lastErrorMsg() . "<br>";
                        }
                        
                        $query = "SELECT COUNT(*) FROM adsstatus";
                        $result = $db->querySingle($query);
                        
                    
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $ad_item = $_POST["ad_item"];
                    
                            if (empty($ad_item)) {
                                die("Please select an ad item.");
                            }
                            
                            if($result === 0){
                                $updateQuery = "INSERT INTO adsstatus (adstype) VALUES (:ad_item)";
                            }else{
                                $updateQuery = "UPDATE adsstatus SET adstype = :ad_item WHERE id = 1";
                            }
                            
                            $stmt = $db->prepare($updateQuery);
                            $stmt->bindValue(':ad_item', $ad_item, SQLITE3_TEXT);
                    
                            if ($stmt->execute()) {
                                echo "Ad item '$ad_item' has been successfully updated.<br>";
                            } else {
                                echo "Error updating record: " . $db->lastErrorMsg();
                            }
                        }
                        ?>
                    
                        <form method="POST" action="">
                            <div class="ctinput">
							<label for="ad_item">Select your requirement:</label>
                            <select name="ad_item" id="ad_item">
                                <option value="ON">ON</option>
                                <option value="OFF">OFF</option>
                            </select>
							</div>
                            
                            <input type="submit" name="submit" value="Update" class="ctbtn ctuserbtn">
                        </form>
                    
                        <?php
                        $db->close();
                        ?>
							
					</div>
					</div>
				</div>
		</div>

<?php include ('includes/footer.php');?>

</body>
</html>

