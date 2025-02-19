<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new SQLite3('./api/.db.db');
$db->exec("CREATE TABLE IF NOT EXISTS subscription(id INTEGER PRIMARY KEY, mac_address TEXT, expire_date TEXT)");

$res = $db->query('SELECT * FROM subscription');

if (isset($_GET['index'])) {
    $index = $_GET['index'];
} else {
    $index = "";
}

if (isset($_POST['submit'])) {
    $expireDate = strtotime($_POST['expire_date']);
    $formattedExpireDate = date('Y-m-d', $expireDate);
    
    $macAddress = strtoupper($_POST['mac_address']);
    
    $checkQuery = "SELECT COUNT(*) as count FROM subscription WHERE mac_address = :macAddress";
    $stmt = $db->prepare($checkQuery);
    $stmt->bindValue(':macAddress', $macAddress, SQLITE3_TEXT);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    
    if ($row['count'] > 0) {

        echo '<script>alert("Only one subscription period can be added for one Mac Address. Edit it if you want to make any changes.");</script>';
    } else {

        $insertQuery = "INSERT INTO subscription (mac_address, expire_date) VALUES (:macAddress, :formattedExpireDate)";
        $stmt = $db->prepare($insertQuery);
        $stmt->bindValue(':macAddress', $macAddress, SQLITE3_TEXT);
        $stmt->bindValue(':formattedExpireDate', $formattedExpireDate, SQLITE3_TEXT);
        $stmt->execute();
        $db->close();
        header('Location: mRTXSubscription.php');
    }
}

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
    <h1 class="h3 mb-1 text-gray-800">Subscription</h1>
    <div class="card border-left-primary shadow h-100 card shadow mb-4">
        <div class="card-header py-3">
            <h6><i class="fa fa-subscript"></i> Add Subscription</h6>
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
                    <label class="control-label" for="expire_date">
                        <strong>Expiration</strong>
                    </label>
                    <div class="input-group">
                        <input type="date" placeholder="YYYY-MM-DD" class="form-control text-primary" name="expire_date" id="datetimepicker"/>
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