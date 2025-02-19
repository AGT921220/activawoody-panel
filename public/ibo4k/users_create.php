<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$db = new SQLite3('./api/.db.db');
$db->exec('CREATE TABLE IF NOT EXISTS ibo(id INTEGER PRIMARY KEY NOT NULL,mac_address VARCHAR(100),username VARCHAR(100),password VARCHAR(100),expire_date VARCHAR(100),url VARCHAR(100),title VARCHAR(100),created_at VARCHAR(100))');
$res = $db->query('SELECT * FROM ibo');

if(isset($_GET['index'])) {
    $index = $_GET['index'];

} else {

    $index = ""; // Default value

}


if (isset($_POST['submit'])) {
	$we = strtotime($_POST['expire_date']);
	$ne = date('Y-m-d', $we);
	$start = date('Y-m-d');
	$end = date('h:m:s');
	$full = $start . 'T' . $end . '.000000Z';
	$db->exec('INSERT INTO ibo(mac_address, username, password, expire_date, url, title, created_at) VALUES(\'' . strtoupper($_POST['mac_address']) . '\', \'' . $_POST['username'] . '\', \'' . $_POST['password'] . '\', \'' . $ne . '\', \'' . $_POST['dns'] . '\', \'' . $_POST['title'] . '\',\'' . $full . '\')');
	$db->close();
	header('Location: users.php');
}

$playlistNames = [
    'Ultimate Entertainment',
    'Global TV Hub',
    'Prime Streaming Zone',
    'All-in-One IPTV Lounge',
    'HD Channel Showcase',
    'Sports Mania',
    'Movie Magic',
    'News Network Central',
    'Kids Fun Zone',
    'Lifestyle Paradise',
    'Documentary Delight',
    'Music Melodies',
    'Comedy Central',
    'Reality TV Extravaganza',
    'Traveler\'s Guide',
    'Sci-Fi Spectacle',
    'Health and Fitness Channel',
    'Gaming Galaxy',
    'Fashion Forward',
    'Business Buzz',
    'Foodie Haven',
    'Educational Excellence',
    'Thriller Theater',
    'History Channel Vault',
    'Cartoons Unlimited',
    'Tech Titans',
    'Wildlife Adventure',
    'Artistic Expressions',
    'Supernatural Secrets',
    'Retro Rewind',
    'Romance Reels',
    'Spiritual Serenity',
    'DIY Network',
    'Car Enthusiast\'s Paradise',
    'Action Packed',
    'True Crime Stories',
    'International Flavor',
    'Nature\'s Wonders',
    'Home Makeover Madness',
    'Anime Haven',
    'Pop Culture Playground',
    'Hidden Gems',
    'Blockbuster Bonanza',
    'Motivational Mojo',
    'Vintage Vibes',
    'Outdoor Expeditions',
    'Social Media Stars',
    'Celebrity Showcase',
    'Science and Technology Marvels',
    'Fitness Freaks'
];

$randomPlaylistName = $playlistNames[array_rand($playlistNames)];

include 'includes/header.php';


?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var macAddressInput = document.getElementById("mac_address");

    macAddressInput.addEventListener("input", function(e) {
        var value = e.target.value;
        value = value.replace(/[^a-fA-F0-9]/g, "").toUpperCase();

        var formattedValue = "";
        for (var i = 0; i < value.length; i++) {
            formattedValue += value[i];
            if ((i + 1) % 2 === 0 && i < value.length - 1) {
                formattedValue += ":";
            }
        }

        e.target.value = formattedValue;
    });
});
</script>
<script>
function extract(event) {
  event.preventDefault(); // Prevent page refresh

  var m3uLink = document.getElementById("m3u_address").value;

  // Extract server URL
  var serverUrl = m3uLink.split("/get.php")[0];
  document.getElementById("server_url").value = serverUrl;

  // Extract username
  var username = getParameterByName("username", m3uLink);
  document.getElementById("username").value = username;

  // Extract password
  var password = getParameterByName("password", m3uLink);
  document.getElementById("password").value = password;
}

function getParameterByName(name, url) {
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
      results = regex.exec(url);
  if (!results) return "";
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}


</script>
<div class="container-fluid">
    <h1 class="h3 mb-1 text-gray-800">Activate User</h1>
        <div class="card border-left-primary shadow h-100 card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-color"><i class="fa fa-user"></i> User Details</h6>
        </div>
        <div class="card-body">
            <form >
                <div class="form-group">
                    <label class="control-label" for="mac_address">
                        <strong>M3U Extractor</strong>
                    </label>
                    <div class="input-group">
                        <input class="form-control text-primary" id="m3u_address" name="m3u_address" placeholder="Enter M3U Link" type="text" required/>
                        <br>
                        <button class="btn btn-success btn-icon-split" id="extract_button" onclick="extract(event)" >
                            <span class="icon text-white-50"><i class="fa fa-expand"></i></span><span class="text">extract</span>
                        </button>
                        </div>
                    </div>
                <div>
            </div>
            </form>

</div>
</div>
    <div class="card border-left-primary shadow h-100 card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-color"><i class="fas fa-user"></i> User Details</h6>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label class="control-label" for="mac_address">
                        <strong>Mac Address</strong>
                    </label>
                    <div class="input-group">
                        <input class="form-control text-primary" id="mac_address" name="mac_address" placeholder="Enter Mac Address" type="text" value="<?php echo strtoupper($index); ?>" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="title">
                        <strong>Server Name</strong>
                    </label>
                    <div class="input-group">
                        <input type="text" class="form-control text-primary" name="title" placeholder="Enter Server Name" id="discription" value="<?php echo $randomPlaylistName; ?>" required/>
                    </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="dns">
                    <strong>DNS</strong>
                </label>
                <div class="input-group">
                    <input type="text" class="form-control text-primary" name="dns" placeholder="Enter DNS" id="server_url"  required/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="username">
                    <strong>Username</strong>
                </label>
                <div class="input-group">
                    <input type="text" class="form-control text-primary" name="username" placeholder="Enter Username" id="username"  required/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="password">
                    <strong>Password</strong>
                </label>
                <div class="input-group">
                    <input type="text" class="form-control text-primary" name="password" placeholder="Enter Password" id="password"  required/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="expire_date">
                    <strong>Expiration</strong>
                </label>
                <div class="input-group">
                    <input type="text" placeholder="YYYY-MM-DD" class="form-control text-primary" name="expire_date" id="datetimepicker"/>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <button class="btn btn-success btn-icon-split" name="submit" type="submit">
                        <span class="icon text-white-50"><i class="fas fa-check"></i></span><span class="text">Submit</span>
                    </button>
                </div>
            </div>
</form>
</div>
</div>
</div>
<br><br><br>

<script>
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>


</body>
<?php 
include 'includes/footer.php';
?>
</html>