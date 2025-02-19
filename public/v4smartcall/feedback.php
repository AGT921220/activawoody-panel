<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$results_per_page = 3;

if (isset($_GET['view'])) {
    $page = $_GET['view'];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $results_per_page;
$db1 = new SQLite3('./api/.db.db');

$feedbackquery = "CREATE TABLE IF NOT EXISTS rtxfeedback (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    username TEXT,
    macaddress TEXT,
    feedback TEXT
)";
$db1->exec($feedbackquery);

// Search functionality
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$searchQuery = '';
if (!empty($searchTerm)) {
    $searchQuery = "WHERE mac_address LIKE '%$searchTerm%' OR mac_address LIKE '%$searchTerm%'";
}

$result = $db1->query("SELECT COUNT(id) AS total FROM rtxfeedback $searchQuery");
$rownew = $result->fetchArray();
$totaleview = $rownew['total'];
$total_pages = ceil($rownew['total'] / $results_per_page);


$res1 = $db1->query("SELECT * FROM rtxfeedback $searchQuery ORDER BY id ASC LIMIT $start_from, $results_per_page");

if (isset($_GET['delete'])) {
    $db1->exec('DELETE FROM rtxfeedback WHERE id=' . $_GET['delete']);
    header('Location: feedback.php');
}

include 'includes/header.php';
?>
<style>
  .pagination-gap {
  margin-left: 2px; 
  margin-right: 2px; 
  background-color: red; 
  color: white; 
  padding: 5px 10px;
}

.pagination-red {
  margin-left: 2px; 
  margin-right: 2px; 
  background-color: red; 
  color: white; 
  text-align: center; 
  padding: 5px 10px;
}
.text-color{
    color: white;
}

</style>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Confirm</h2>
            </div>
            <div class="modal-body">
                Do you really want to delete this User?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>
<main role="main" class="col-15 pt-4 px-5">
    <div class="">
        <div class="chartjs-size-monitor" style="position:absolute ; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
            <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
            </div>
            <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
            </div>
        </div>
        <div id="main">
    <!-- Content Row -->
    <div class="row">
        <!-- First Column -->
        <div class="col-lg-12">
            <!-- Custom codes -->
            <div class="card border-left-primary shadow h-100 card shadow mb-4 ctcard">
                <div class="card-header py-3 text-center">
                    <h3><i class="fa fa-commenting-o"></i> FEEDBACK</h3>
                </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead class="text-color">
                                <tr>
                                    <th>User</th>
                                    <th>Feedback</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row1 = $res1->fetchArray()) { ?>
                                    <tr>
                                        <?php
                                        $users_id = $row1['id'];
                                        $user_mac = $row1['username'];
                                        $user_expire_date = $row1['feedback'];
                                        ?>
                                        <td><?php echo "🧑" . $user_mac; ?></td>
                                        <td><?php echo "🔰" . $user_expire_date; ?></td>
                                        <td>
                                            <a class="btn btn-icon delete-btn" href="#" data-href="./feedback.php?delete=<?php echo $users_id; ?>" data-toggle="modal" data-target="#confirm-delete">
                                                    <span class="icon text-white-50"><i class="fa fa-ban" style="font-size:24px;color:red"></i></span>
                                                </a>
                                        </td>
                                    </tr>
                                <?php } 
                                
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if ($results_per_page < $totaleview) { ?>
    <div class="pagination">
        <?php if ($page > 1) { ?>
            <a class="pagination pagination-gap" href='feedback.php?view=<?php echo ($page - 1); ?>'>&lt; Previous</a>
        <?php } ?>
        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <?php if ($i == $page) { ?>
                <a class="active pagination pagination-red" href='feedback.php?view=<?php echo $i; ?>'>[<?php echo $i; ?>]</a>
            <?php } else { ?>
                <a class="pagination pagination-gap" href='feedback.php?view=<?php echo $i; ?>'><?php echo $i; ?></a>
            <?php } ?>
        <?php } ?>
        <?php if ($page < $total_pages) { ?>
            <a class="pagination pagination-gap" href='feedback.php?view=<?php echo ($page + 1); ?>'>Next &gt;</a>
        <?php } 
        
        ?>
    </div>
<?php }
include 'includes/footer.php';
?>








