<?php
$jsondata = file_get_contents("./api/page.json");
$arrayData = json_decode($jsondata, true);
$json = $arrayData['app'];

if (isset($_POST['submit'])) {
    $replacementData = array(
        'app' => array(
            'selected_option' => $_POST["selected_option"]
        )
    );
    $replacementJson = json_encode($replacementData, JSON_PRETTY_PRINT);
    file_put_contents("./api/page.json", $replacementJson);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

include ('includes/header.php');
?>
<style>
   .custom-image {
      width: 100%;
      max-width: 500px;
      height: auto;
   }
</style>
<main role="main" class="col-15 pt-4 px-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-primary text-white">
                <div class="card-header card-header-warning">
                    <h2 class="text-center"><i class="fa fa-globe"></i> Widget Selection</h2>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <h3>Widgets Available</h3>
                    </div>
                    <form method="post">
                        <div class="form-group">
                            <label class="form-label" for="selected_option">Pick Your Widget</label>
                            <select class="form-control" id="select" name="selected_option">
                                <option value="image.php" <?= $json['selected_option'] == 'image.php' ? 'selected' : '' ?>>BACKGROUND</option>
                                <option value="tmdb.php" <?= $json['selected_option'] == 'tmdb.php' ? 'selected' : '' ?>>POSTERS TMDB</option>
                                <option value="ads.php" <?= $json['selected_option'] == 'ads.php' ? 'selected' : '' ?>>MANUAL ADS</option>
                            </select>
                        </div>
                        <hr>
                        <div class="form-group text-center">
                            <button class="btn btn-info" name="submit" type="submit">
                                <i class="fa fa-check"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
      </div>
        </div>
    </div>
</main>
<?php 
include ('includes/footer.php');
require 'includes/boxbr.php';
?>
</body>
</html>