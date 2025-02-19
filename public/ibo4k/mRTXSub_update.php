<?php
// Display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to the SQLite database
$db = new SQLite3('./api/.db.db');

// Retrieve user data based on the 'update' parameter from the URL
$updateId = $_GET['update'];
$query = 'SELECT * FROM subscription WHERE id=:id';
$stmt = $db->prepare($query);
$stmt->bindValue(':id', $updateId, SQLITE3_TEXT);
$res = $stmt->execute();
$row = $res->fetchArray(SQLITE3_ASSOC);

// Store user data in variables
$id = $row['id'];
$macAddress = $row['mac_address'];
$expireDate = $row['expire_date'];

// Handle form submission
if (isset($_POST['submit'])) {
    $expireDateTimestamp = strtotime($_POST['expire_date']);
    $formattedExpireDate = date('Y-m-d', $expireDateTimestamp);

    $updateQuery = 'UPDATE subscription SET mac_address=:mac_address, expire_date=:expire_date WHERE id=:id';
    $updateStmt = $db->prepare($updateQuery);
    $updateStmt->bindValue(':mac_address', $_POST['mac_address'], SQLITE3_TEXT);
    $updateStmt->bindValue(':expire_date', $formattedExpireDate, SQLITE3_TEXT);
    $updateStmt->bindValue(':id', $_POST['id'], SQLITE3_TEXT);
    $updateStmt->execute();

    // Close the database connection and redirect
    $db->close();
    header('Location: mRTXSubscription.php');
}

// Include the header
include 'includes/header.php';

// Store user data in variables for use in the HTML form
$userUpdateId = $row['id'];
$userUpdateMacAddress = $row['mac_address'];
$userUpdateExpireDate = $row['expire_date'];
?>

<div class="container-fluid">
    <h1 class="h3 mb-1 text-gray-800">Subscription</h1>
    <div class="card border-left-primary shadow h-100 card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-color"><i class="fa fa-subscript"></i>  Update Subscription</h6>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label for="mac_address"><strong>Mac Address</strong></label>
                    <div class="input-group">
                        <input type="hidden" name="id" value="<?= $userUpdateId ?>">
                        <input class="form-control text-primary" id="description" name="mac_address" value="<?= $userUpdateMacAddress ?>" type="text" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="expire_date"><strong>Expiration</strong></label>
                    <div class="input-group">
                        <input type="text" class="form-control text-primary" name="expire_date" value="<?= $userUpdateExpireDate ?>" id="datepicker" />
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <button class="btn btn-success btn-icon-split" name="submit" type="submit">
                            <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                            <span class="text">Submit</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
// Include the footer
include 'includes/footer.php';
?>
</body>
</html>
