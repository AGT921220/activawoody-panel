<?php 
include ('includes/header.php');

//db call
$db = new SQLite3('./api/sports.db');

//table name
$table_name = "sports";

//current file var
$base_file = basename($_SERVER["SCRIPT_NAME"]);

//create if not
$db->exec("CREATE TABLE IF NOT EXISTS {$table_name}(id INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL, header_n TEXT, border_c TEXT, background_c TEXT, text_c TEXT, days TEXT, api TEXT)");

$rows = $db->query("SELECT COUNT(*) as count FROM {$table_name}");
$row = $rows->fetchArray();
$numRows = $row['count'];
if ($numRows == 0)
{
	$db->exec("INSERT INTO {$table_name}(id, header_n, border_c, background_c, text_c, days, api) VALUES('1', 'Event', '#000000', '#000000', '#ffffff', '7', '1')");
}

$res = $db->query("SELECT * FROM {$table_name} WHERE id='1'");
$rowU=$res->fetchArray();

//update call
$stmt = $db->prepare("SELECT * FROM {$table_name} WHERE id=?");
$stmt->bindValue(1, "1");
$resU = $stmt->execute();
$rowU = $resU->fetchArray();

function Submit($sub_type, $db, $table_name){
	if ($sub_type == 'sub_new') {
		$stmt = $db->prepare("UPDATE {$table_name} SET header_n=?,border_c=?, background_c=?, text_c=?, api=? WHERE id=?");
		$stmt->bindValue(1, sanitize($_POST['header_n']));
		$stmt->bindValue(2, sanitize($_POST['border_c']));
		$stmt->bindValue(3, sanitize($_POST['background_c']));
		$stmt->bindValue(4, sanitize($_POST['text_c']));
		$stmt->bindValue(5, sanitize($_POST['api']));
		$stmt->bindValue(6, "1");
		$stmt->execute();
	}
	$db->close();
}

if (isset($_POST['submit'])){
	Submit('sub_new',$db, $table_name);
	echo "<script>window.location.href='sports.php?status=1'</script>";
	}


?>

		<div class="col-md-6 mx-auto">
			<div class="modal fade" id="how2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">How to Get the API Key</h5>
				</div>
				<div class="modal-body">
					<p>Go to the website https://www.tvsportguide.com/page/widget/ , scroll to the bottom enter some BS info and it will give you url like below. The portion in red is what you need.
					<p><small>https://www.tvsportguide.com/widget/<em style="color:red;">5cc316f797659</em>?filter_mode=all&filter_value</small></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<a href="https://www.tvsportguide.com/page/widget/"><button  type="button" class="btn btn-primary">Go to webpage</button></a>
				</div>
				</div>
			</div>
			</div>
			<div class="card-body">
				<div class="card bg-primary text-white">
					<div class="card-header">
						<center>
							<h2></i> Sports Events</h2>
						</center>
					</div>
					<div class="card-body">
							<form method="post">

								<div class="form-group ">
									<div class="form-line">
									  <label class="form-group form-float form-group-lg">API Key</label><br>
									  <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#how2">How to get the API Key</button><br><br>
									  <input class="form-control" name="api" value="<?=$rowU['api']?>" type="text"/>
									</div>
								</div>


								<div class="form-group ">
									<div class="form-line">
										<label class="form-group form-float form-group-lg">Header Name</label>
										<input class="form-control" name="header_n" value="<?=$rowU['header_n']?>" type="text"/>
									</div>
								</div>

								<div class="form-group ">
									<div class="form-line">
										<label class="form-group form-float form-group-lg">Border</label>
										<input class="form-control" name="border_c" value="<?=$rowU['border_c']?>" type="color"/>
									</div>
								</div>

								<div class="form-group ">
									<div class="form-line">
										<label class="form-group form-float form-group-lg">Background Color</label>
										<input class="form-control" name="background_c" value="<?=$rowU['background_c']?>" type="color"/>
									</div>
								</div>

								<div class="form-group ">
									<div class="form-line">
										<label class="form-group form-float form-group-lg">Text Color</label>
										<input class="form-control" name="text_c" value="<?=$rowU['text_c']?>" type="color"/>
									</div>
								</div>

								<hr>

								<div class="form-group">
									<center>
										<button class="btn btn-info" name="submit" type="submit">
											<i class="fa fa-check"></i> Update Status
										</button>
									</center>
								</div>
							</form>	 
						</div>
					</div>
				</div>
		</div>

<?php include ('includes/footer.php');?>