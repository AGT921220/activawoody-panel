<?php
include "includes/header.php";
?>
<style>
  .custom-button {
    padding: 8px 10px;
  }
</style>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800"> SetUp Your Web site</h1>
    <!-- Custom codes -->
    <div class="card border-left-primary shadow h-100 card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cogs"></i> Enter</h6>
        </div>
        <div class="card-body">
            
            <?php
            // Read the JSON file and decode its contents
            $jsonData = file_get_contents('./a/rtx/Setting.json');
            $data = json_decode($jsonData, true);
            
            // Check if form is submitted
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Get the input text from the form
                $inputText = $_POST['input_text'];
            
                // Find the index of the record with "RTXSetting" equal to "mWebpage"
                $index = array_search('mWebpage', array_column($data, 'RTXSetting'));
            
                // Update the existing record or create a new one if it doesn't exist
                if ($index !== false) {
                    $data[$index]['PanalData'] = $inputText;
                } else {
                    $newRecord = array(
                        'RTXSetting' => 'mWebpage',
                        'PanalData' => $inputText
                    );
                    $data[] = $newRecord;
                }
            
                // Encode the updated data array back to JSON
                $jsonData = json_encode($data, JSON_PRETTY_PRINT);
            
                // Save the JSON data to the file
                file_put_contents('./a/rtx/Setting.json', $jsonData);
            }
            
            // Retrieve the current input text from the data array
            $index = array_search('mWebpage', array_column($data, 'RTXSetting'));
            $inputText = ($index !== false) ? $data[$index]['PanalData'] : '';
            
            ?>
            
            <form method="post" action="">
                <label for="input_text">Enter Web URl:</label>
                <input class="custom-button" type="text" name="input_text" id="input_text" value="<?php echo $inputText; ?>" />
                <button class="custom-button horizontal-space btn btn-success btn-icon-split" type="submit" name="submit_button">Save and Update</button>
            </form>
 

        </div>
</div>
</div>


<?php
include "includes/footer.php";
?>
</body>
</html>
