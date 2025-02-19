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
  
  
  <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selectedOption = $_POST['options'];
        echo "You selected: " . $selectedOption;

        // Read existing JSON data from file
        $jsonData = file_get_contents('./a/rtx/Setting.json');
        $data = json_decode($jsonData, true);

        // Update first record in JSON data
        $data[0]["RTXSetting"] = "mLayout";
        $data[0]["PanalData"] = $selectedOption;

        // Encode the updated data back to JSON
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);

        // Write the updated JSON data to file
        file_put_contents('./a/rtx/Setting.json', $jsonData);
    }
    ?>
    
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <select name="options" width="300" id="options">
            <option value="theme_d">theme_d</option>
            <option value="theme_1">theme_1</option>
            <option value="theme_2">theme_2</option>
            <option value="theme_3">theme_3</option>
            <option value="theme_4">theme_4</option>
            <option value="theme_5">theme_5</option>
            <option value="random">random</option>
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
              <p>theme_d</p>
              <img src="./rtx/layout/d.png" width="300" height="170" alt="theme_d">
            </div>
          
            <div class="image-container">
              <p>theme_1</p>
              <img src="./rtx/layout/1.png" width="300" height="170" alt="theme_1">
            </div>
          
            <div class="image-container">
                <p>theme_2</p>
              <img src="./rtx/layout/2.png" width="300" height="170" alt="theme_2">
            </div>
          </div>
          
          <div class="image-row">
            <div class="image-container">
              <p>theme_3</p>
              <img src="./rtx/layout/3.png" width="300" height="170" alt="theme_3">
            </div>
          
            <div class="image-container">
              <p>theme_4</p>
              <img src="./rtx/layout/4.png" width="300" height="170" alt="theme_4">
            </div>
          
            <div class="image-container">
              <p>theme_5</p>
              <img src="./rtx/layout/5.png" width="300" height="170" alt="theme_5">
            </div>
      </div>
  
  
</div>
</div>
</div>
<?php
include "includes/footer.php";
?>
</body>
</html>
