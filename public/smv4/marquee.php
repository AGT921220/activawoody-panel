<?php
include ('includes/header.php');

$table_name = 'advertisement';

$res = $db->query("SELECT * FROM {$table_name} WHERE id='1'");
$rowU=$res->fetchArray();

if(isset($_POST['submit'])){
	$stmt = $db->prepare('UPDATE '.$table_name.' SET title=?, text=? WHERE id=1');
	$stmt->bindParam(1, $_POST['title']);
	$stmt->bindParam(2, $_POST['text']);
	$stmt->execute();
	echo "<script>window.location.href='". basename($_SERVER["SCRIPT_NAME"])."?status=1'</script>";
}

?>

        <div class="col-md-6 mx-auto">
            <div class="card-body">
                <div class="card bg-primary text-white">
                    <div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-bullhorn"></i> Scrolling Marquee</h2>
                        </center>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <h3>Scrolling Marquee Details</h3>
                        </div>
                            <form method="post">

                                <div class="form-group">
                                    <label class="form-label " for="version">Title</label>
                                        <input class="form-control" name="title" value="<?=$rowU['title'] ?>" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label " for="package">Message</label>
                                        <textarea rows="6" class="form-control"  name="text"" type="text"/><?=$rowU['text'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <center>
                                        <button class="btn btn-info " name="submit" type="submit">
                                            <i class="icon icon-check"></i> Submit
                                        </button>
                                    </center>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>

<?php include ('includes/footer.php');?>
</body>
</html>