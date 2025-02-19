<?php
include "includes/header.php";
?>
<?php
// Read the JSON file
$jsonData = file_get_contents('./a/rtx/data.json');
$data = json_decode($jsonData, true);

$selectedOption = $data['option'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $selectedOption = $_POST['option'] ?? '';

  // Update the JSON file with the selected option
  $data = array('option' => $selectedOption);
  $jsonData = json_encode($data);
  file_put_contents('./a/rtx/data.json', $jsonData);
}
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800"> Backgrund Setting</h1>
    <!-- Custom codes -->
    <div class="card border-left-primary shadow h-100 card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cogs"></i> Select the type of background</h6>
        </div>
        <div class="card-body">


<form method="post" class="form-container">
  <input type="radio" name="option" value="option1" id="option1" <?php if ($selectedOption === 'option1') echo 'checked'; ?>>
  <label for="option1">Gradient Background</label><br>
  <input type="radio" name="option" value="option2" id="option2" <?php if ($selectedOption === 'option2') echo 'checked'; ?>>
  <label for="option2">Video Background</label><br>
  <input type="radio" name="option" value="option3" id="option3" <?php if ($selectedOption === 'option3') echo 'checked'; ?>>
  <label for="option3">Image Background</label><br>
  <input type="radio" name="option" value="option4" id="option4" <?php if ($selectedOption === 'option4') echo 'checked'; ?>>
  <label for="option4">Slider Background</label><br>
  <button type="submit" class="custom-button btn btn-success btn-icon-split">Submit</button>
</form>


        </div>
</div>
</div>
<br><br><br>
<style>
  .custom-button {
    padding: 10px 20px;
  }
</style>
<?php
include "includes/footer.php";
?>
<script>

</script>
</body>
</html>
