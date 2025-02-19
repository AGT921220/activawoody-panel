<?php

function Submit($sub_type, $db, $table_name)
{
    if ($sub_type == 'sub_new' && isset($_POST['intro_url'])) {
        $intro_url = $_POST['intro_url'];
        $stmt = $db->prepare("UPDATE $table_name SET url = :url WHERE id = 1");
        $stmt->bindValue(':url', $intro_url, SQLITE3_TEXT);
        $stmt->execute();
    }
}

error_reporting(0); // Avoid displaying errors to users in production
include 'includes/header.php';

$table_name = 'intro';
$db = new SQLite3('./api/intro.db'); // Replace with your database configuration

$db->exec("CREATE TABLE IF NOT EXISTS $table_name (id INTEGER PRIMARY KEY, url TEXT)");
$rows = $db->querySingle("SELECT COUNT(*) as count FROM $table_name");
$numRows = intval($rows);

if ($numRows === 0) {
    $db->exec("INSERT INTO $table_name (url) VALUES ('')");
}

$intro = $db->querySingle("SELECT url FROM $table_name WHERE id = 1");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Submit('sub_new', $db, $table_name);
}

if (!file_exists('intro')) {
    mkdir('intro', 0755, true);
}

?>

<div class="col-md-6 mx-auto">
    <div class="card-header card-header-warning">
    <center>
        <h2><i class="fa fa-television" aria-hidden="true" style="color: gray;"></i> <span style="color: black;">Channel M3U8 Manager</span></h2>
    </center>
</div>
            <div class="card-body">
                <div class="col-12">
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <br>
                    <div id="loc" class="form-group form-float form-group-lg">
                        <div class="form-line">
                            <label class="form-label"><strong>URL</strong></label>
                            <input type="text" class="form-control" name="intro_url" placeholder="http://url.m3u8">
                        </div>
                    </div>
                    <div class="form-group">
                        <center>
                            <button class="btn btn-info" name="submit" type="submit">
                                <i class="icon icon-check"></i> Submit
                            </button>
                        </center>
                    </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>
