<?php
/**
*
* @ This file is created by http://DeZender.Net
* @ deZender (PHP7 Decoder for SourceGuardian Encoder)
*
* @ Version			:	4.1.0.1
* @ Author			:	DeZender
* @ Release on		:	29.08.2020
* @ Official site	:	http://DeZender.Net
*
*/

$db = new SQLite3('./api/sport.db');
$db->exec('CREATE TABLE IF NOT EXISTS sport(id INTEGER PRIMARY KEY NOT NULL, title VARCHAR(25), url VARCHAR(200), c1 VARCHAR(25), c2 VARCHAR(25), c3 VARCHAR(25))');
$rows = $db->query('SELECT COUNT(*) as count FROM sport');
$row1 = $rows->fetchArray();
$numRows = $row1['count'];

if ($numRows == 0) {
	$db->exec('INSERT INTO sport(id, title, url, c1, c2, c3) VALUES(\'1\', \'Default\', \'https://www.tvsportguide.com/widget/5cc316f797659/?heading=Events&border_color=custom&autoscroll=1&custom_colors=\',\'#1d23dd\',\'#ffffff\',\'#000000\')');
}

$res = $db->query('SELECT * ' . "\n\t\t\t\t" . '  FROM sport ' . "\n\t\t\t\t" . '  WHERE id=\'1\'');
$row = $res->fetchArray();
$id = $row['id'];
$urll = $row['url'];
$c1 = $row['c1'];
$c2 = $row['c2'];
$c3 = $row['c3'];

if (isset($_POST['submit'])) {
	$db->exec('UPDATE sport SET' . "\t" . ' url=\'' . $_POST['urll'] . '\',' . "\n" . '                                c1=\'' . $_POST['c1'] . '\', ' . "\n\t\t\t\t\t\t\t\t" . 'c2=\'' . $_POST['c2'] . '\', ' . "\n\t\t\t\t\t\t\t\t" . 'c3=\'' . $_POST['c3'] . '\'' . "\n\t\t\t\t\t\t" . '  WHERE ' . "\n\t\t\t\t\t\t\t\t" . 'id=\'1\' ');
	header('Location: sport.php?success');
}

include 'includes/header.php';
echo ' <!-- Begin Page Content -->' . "\n";
echo '        <div class="container-fluid">' . "\n";
echo "\n";

if (isset($_GET['admin_success'])) {
	echo $msg_success_admin;
}

if (isset($_GET['admin_fail'])) {
	echo $msg_error;
}

if (isset($_GET['success'])) {
	echo $msg_success;
}

echo '          <h1 class="h3 mb-1" style="color:' . $colour_head_16 . ';">Update Sports</h1>' . "\n";
echo '         ' . "\n";
echo '          <!-- Content Row -->' . "\n";
echo '          <div class="row">' . "\n";
echo "\n";
echo '            <!-- First Column -->' . "\n";
echo '            <div class="col-lg-4">' . "\n";
echo "\n";
echo '              <!-- Custom codes -->' . "\n";
echo '                <div class="card border-left-primary shadow h-100 card shadow mb-4">' . "\n";
echo '                <div class="card-header py-3">' . "\n";
echo '                <h6 class="m-0 font-weight-bold" style="color:' . $colour_head_11 . ';"><i class="fa fa-futbol"></i> Update Sports Url</h6>' . "\n";
echo '                </div>' . "\n";
echo '                <div class="card-body">' . "\n";
echo '                            <form method="post">' . "\n";
echo '                            <div class="form-group ">' . "\n";
echo '                            <label class="control-label " style="color:' . $colour_head_18 . ';" for="urll">' . "\n";
echo '                            <strong>URL</strong>' . "\n";
echo '                            </label>' . "\n";
echo '                            <div class="input-group">' . "\n";
echo '                            <input type="text" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" class="form-control" name="urll"  value="' . $urll . '" placeholder="Enter URL">' . "\n";
echo '                            </div>' . "\n";
echo '                            </div>' . "\n";
echo '                                <div class="form-group">' . "\n";
echo '                                    <label class="control-label " style="color:' . $colour_head_18 . ';"   for="c1">' . "\n";
echo '                                        <input value="' . $c1 . '" name="c1" type="color">' . "\n";
echo '                                        <strong>Border Colour </strong>' . "\n";
echo '                                    </label>' . "\n";
echo '                        </div>' . "\n";
echo '                                <div class="form-group">' . "\n";
echo '                                    <label class="control-label"  style="color:' . $colour_head_18 . ';" for="c2">' . "\n";
echo '                                        <input value="' . $c2 . '" name="c2" type="color">' . "\n";
echo '                                        <strong>Background Colour </strong>' . "\n";
echo '                                    </label>' . "\n";
echo '                        </div>' . "\n";
echo '                                <div class="form-group">' . "\n";
echo '                                    <label class="control-label"  style="color:' . $colour_head_18 . ';" for="c3">' . "\n";
echo '                                        <input value="' . $c3 . '" name="c3" type="color">' . "\n";
echo '                                        <strong>Text Colour </strong>' . "\n";
echo '                                    </label>' . "\n";
echo '                                </div>' . "\n";
echo "\t\t\t\t\t\t\t\t" . '                       <div class="form-group">' . "\n";
echo '                        <button class="btn btn-success btn-icon-split" style="background-color:' . $colour_head_btn . ';border-color:' . $colour_head_btn . ';color:' . $colour_head_10 . ';" name="submit" type="submit">' . "\n";
echo '                        <span class="icon text-white-50"><i class="fas fa-check" style="color:' . $colour_head_10 . ';"></i></span><span class="text">Submit</span>' . "\n";
echo '                        </button>' . "\n";
echo '                            </div>' . "\n";
echo '                            </form>' . "\n";
echo '                            </div>' . "\n";
echo '                            </div>' . "\n";
echo '                            </div>' . "\n";
echo '            </div>' . "\n";
echo '                </div>' . "\n";
include 'includes/footer.php';
require 'includes/egz.php';
echo '</body>' . "\n";

?>