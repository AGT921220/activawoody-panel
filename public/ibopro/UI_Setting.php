<?php
include ('includes/header.php');
?>
<style>
  .custom-button {
    padding: 10px 20px;
  }
</style>

  <style>
    .image-row {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }
    
    .image-container {
      margin: 0 10px;
      max-width: 100%;
      height: auto;
    }
    .horizontal-space {
      margin-right: 20px;
    }
    label, select, input {
            margin-left: 10px;
        }
    form {
            display: flex;
            justify-content: center;
        }
        
        
  </style>


		<div class="col-md-6 mx-auto">
			<div class="modal fade" id="how2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			</div>
			<div class="card-body">
				<center>
							<h2><i class="fa fa-wrench"></i> Setup UI</h2>
						</center>
					</div>
					<div class="card-body">
                            
                            
<?php


    $jsonData = file_get_contents('./api/theme.json');

    // Convert JSON data to PHP array
    $dataArray = json_decode($jsonData, true);
    
    // Function to extract and return "PanalData"
    function getPanalData($dataArray) {
        if (isset($dataArray[0]["PanalData"])) {
            return $dataArray[0]["PanalData"];
        } else {
            return null; // Return null if "PanalData" key not found
        }
    }
    
    // Get and print the "PanalData"
    $panalData = getPanalData($dataArray);
    echo "You selected: " . $panalData;



    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selectedOption = $_POST['options'];
        //echo " You new selected: " . $selectedOption;

        $jsonData = file_get_contents('./api/theme.json');
        $data = json_decode($jsonData, true);
        $data[0]["PanalData"] = $selectedOption;

        $jsonData = json_encode($data, JSON_PRETTY_PRINT);

        file_put_contents('./api/theme.json', $jsonData);
        
        echo "<script>window.location.href='UI_Setting.php';</script>";
    }
    ?>
    
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <select name="options" width="300" id="options">
        <option value="Widget_1">Widget_1 Channel</option>
        <option value="Widget_2">Widget_2 Ads</option>
        <option value="Widget_3">Widget_3 Sports</option>
        <!-- Add more options here if needed -->
    </select>
    <br>
    <br>
    <input type="submit" class="horizontal-space btn btn-success btn-icon-split" value=" Submit ">
</form>
<br>
<br>
<div class="image-row">
    <div class="image-container">
        <p>Widget_1 Channel</p>
        <img src="./img/1.png" width="200" height="130" alt="Widget_1">
    </div>

    <div class="image-container">
        <p>Widget_2 Ads</p>
        <img src="./img/2.png" width="200" height="130" alt="Widget_2">
    </div>

    <div class="image-container">
        <p>Widget_3 Sports</p>
        <img src="./img/3.png" width="200" height="130" alt="Widget_3">
    </div>
</div>

                            
						</div>
					</div>
				</div>
		</div>

<?php include ('includes/footer.php');?>

</body>
</html>