<?php
error_reporting(0);
include "includes/header.php";

$db = new SQLite3("./api/.bet_tmdb.db");
$table_name = "api_key";
$db->exec("CREATE TABLE IF NOT EXISTS " . $table_name . " (id INTEGER PRIMARY KEY, key TEXT)");

$rows = $db->query("SELECT COUNT(*) as count FROM " . $table_name);
$row = $rows->fetchArray();
$numRows = $row["count"];

if ($numRows == 0) {
    $db->exec("INSERT INTO " . $table_name . "(key) VALUES('')");
	
	
}



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["submit"])) {
        $newKey = $_POST["key"]; // No validation/sanitization here for demonstration purposes

        // Use prepared statements to prevent SQL injection
        $stmt = $db->prepare("UPDATE " . $table_name . " SET key = :newKey WHERE id = 1");
        $stmt->bindValue(':newKey', $newKey, SQLITE3_TEXT);
        $stmt->execute();

        header("Location: tmdb_api.php");
        exit();
    
    } elseif (isset($_POST["deleteCache"])) {
        // Specify the path to your JSON cache file
        $cacheFilePath = "./api/cache/combined_cache.json";

        // Check if the cache file exists and delete it
        if (file_exists($cacheFilePath)) {
            unlink($cacheFilePath); // Delete the cache file
        }

        // Redirect and exit

        header("Location: tmdb_api.php");
        exit();
    }
}

$res = $db->query("SELECT * FROM " . $table_name . " WHERE id = 1");
$rowU = $res->fetchArray();


if (empty($rowU['key'])) {
    echo '<div class="alert alert-warning" role="alert">
        You must add your tMDB API key before using the app. Follow the instructions below to add your API key.
    </div>';
} 

?>
<div class="card border-left-primary shadow h-100 card shadow mb-4">
        <div class="card-header py-3">
                <div class="card-body">
                                <div class="card mb-4">
                                    <div class="card-header bg-primary py-3">
                                        <h4 align="center" class="m-0 font-weight-bold text-blue">
                                            <i class="fa fa-key" style="font-size:20px"></i>   
                                            Get Your tMDB API Key 
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <!-- Add instructions here -->
                                        <p style="font-size: 16px;">
                                            To use this application, you need to have a tMDB API key. Follow these steps to obtain your API key:
                                        </p>
                                        <ol>
                                            <li>Visit the tMDB website at <a href="https://www.themoviedb.org" target="_blank" style="font-weight: bold; color: #007bff; text-decoration: underline;">https://www.themoviedb.org/</a></li>
                                            <li>Sign in or create an account if you don't have one.</li>
                                            <li>To register for an API key, click the <a href="https://www.themoviedb.org/settings/api" target="_blank" style="font-weight: bold; color: #007bff; text-decoration: underline;">API link</a> from within your account settings page.</li>

                                            <li>
                                                Please note that the API registration process is not optimized for mobile devices so you should access these pages on a desktop computer and browser
                                            </li>
                                            <li>Generate a new API key and copy it.</li>
                                        </ol>
                                        <p>
                                            Paste the copied API key into the field below and click the "Save Settings" button.
                                        </p>
                                        <!-- End of instructions -->

                                        <form method="post">
                                            <div class="form-group mb-3">
                                                <label class="control-label text-primary" for="key">
                                                    <strong>Api key:</strong>
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control" id="key" name="key" value="<?= $rowU['key']; ?>" type="text" />
                                                </div>
                                            </div>
                                            <div align="center" class="form-group mb-3">
                                                <br>
                                                <div>
                                                    <button class="btn btn-success" name="submit" type="submit">
                                                        <span class="icon text-white-50"><i class="fas fa-save"></i>&nbsp;&nbsp;</span>
                                                        <span class="text">Save Settings</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                 <!-- Add the "Delete Cache" button -->
                    <form method="post">
                        <div align="center" class="form-group mb-3">
                            <button class="btn btn-danger" name="deleteCache" type="submit">
                                <span class="icon text-white-50"><i class="fas fa-trash"></i>&nbsp;&nbsp;</span>
                                <span class="text">Delete Cache</span>
                            </button>
                        </div>
                    </form>
                </div>
                    <!-- ============================================================== -->
                    <!-- End Container fluid  -->
                    <!-- ============================================================== -->
                </div>
                <!-- ============================================================== -->
                <!-- End Page wrapper  -->
                <!-- ============================================================== -->
            </div>
        </div>
    </div>
</div>
<?php include "includes/functions.php"; ?>
