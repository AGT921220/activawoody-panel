<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include('includes/header.php');
$dbPath = './api/.db.db';
$db = new SQLiteWrapper($dbPath);

// Check if a new theme has been selected
if(isset($_POST['theme_id'])) {
    var_dump($_POST); // Adicione esta linha para verificar os dados enviados
    $themeData = ['theme_id' => $_POST['theme_id']];
    $db->update('themes', $themeData, 'id = :id', [':id' => 1]);
    echo "<script>window.location.href='". basename($_SERVER["SCRIPT_NAME"])."?status=1'</script>";
}

$result = $db->select('themes', 'theme_id', 'id = 1', '');
$currentThemeId = !empty($result) ? $result[0]['theme_id'] : '1'; // Replace 'default_theme_id' with a suitable default or null

// Fetch the current theme
$currentThemeId = $db->select('themes', 'theme_id', 'id = 1', '')[0]['theme_id'];
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<div class="col-md-10 mx-auto">
    <div class="card-body">
        <div class="card bg-primary text-white">
            <div class="card-header card-header-warning">
                <center><h2><i class="icon icon-bullhorn"></i> Theme Settings</h2></center>
            </div>
            <div class="card-body">
                <!-- Theme Selection Form -->
                <form method="post">
                    <div class="form-group">
                        <label for="theme-selector">Select Theme:</label>
                        <select class="form-control" id="theme-selector" name="theme_id">
                            <?php for($i = 1; $i <= 26; $i++): ?>
                                <option value="<?= $i ?>" <?= $currentThemeId == $i ? 'selected' : '' ?>>
                                    Theme <?= $i ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <button class="btn btn-info" type="submit">
                        <i class="icon icon-check"></i> Update Theme
                    </button>
                </form>

                <!-- Theme Thumbnails -->
                <div class="theme-thumbnails">
                    <?php 
                    $themeNumbers = range(1, 26); // Array with theme numbers from 1 to 18
                    foreach ($themeNumbers as $num): ?>
                        <div class="<?= $currentThemeId == $num ? 'selected-theme' : '' ?>">
                            <div class="theme-title">Theme <?= $num ?></div>
                            <img src="img/theme_<?= $num ?>.png" alt="Theme <?= $num ?>">
                            <img src="img/selected.png" alt="Selected" class="selected-indicator">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<style>
.theme-thumbnails {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Adjusted to three columns */
    gap: 20px;
    justify-content: center;
    margin-top: 20px;
}

.theme-thumbnails div {
    display: flex;
    flex-direction: column; /* Stack title and image vertically */
    align-items: center;
    justify-content: center;
    text-align: center;
    position: relative; /* Needed for absolute positioning of the selected indicator */
}

.theme-thumbnails .theme-title {
    font-size: 24px; /* Increased font size */
    color: white; /* White font color */
    margin-bottom: 10px; /* Space between title and image */
}

.theme-thumbnails img {
    max-width: 100%;
    height: auto;
    object-fit: contain; /* Ensures the entire image is visible */
}

.selected-indicator {
    position: absolute;
    bottom: 0; /* Align with the bottom of the parent div */
    right: 0; /* Align with the right of the parent div */
    display: none; /* Hide by default */
    width: 70px; /* Adjust the size as needed */
    height: auto;
    z-index: 2; /* Ensure it's above the image */
}

.selected-theme .selected-indicator {
    display: block; /* Show the indicator for the selected theme */
}
</style>
