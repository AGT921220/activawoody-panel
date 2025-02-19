<?php
/**
*
* @ This file is created by http://DeZender.Net
* @ deZender (PHP7 Decoder for ionCube Encoder)
*
* @ Version			:	4.1.0.1
* @ Author			:	DeZender
* @ Release on		:	29.08.2020
* @ Official site	:	http://DeZender.Net
*
*/

//db call
$db = new SQLite3('./api/smartsport.db');

//table name
$table_name = "sports";

//current file var
$base_file = basename($_SERVER["SCRIPT_NAME"]);

//create if not
$db->exec("CREATE TABLE IF NOT EXISTS {$table_name}(id INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL, header_n TEXT, border_c TEXT, background_c TEXT, text_c TEXT, days TEXT, auto_s TEXT)");

$rows = $db->query("SELECT COUNT(*) as count FROM {$table_name}");
$row = $rows->fetchArray();
$numRows = $row['count'];
if ($numRows == 0)
{
	$db->exec("INSERT INTO {$table_name}(id, header_n, border_c, background_c, text_c, days, auto_s) VALUES('1', 'Event', '#000000', '#000000', '#ffffff', '7', '1')");
}

//update call
@$resU = $db->query("SELECT * FROM {$table_name} WHERE id='1'");
@$rowU=$resU->fetchArray();
if(isset($_POST['submit'])){
	$db->exec("UPDATE {$table_name} SET header_n='".$_POST['header_n']."',
										border_c='".$_POST['border_c']."', 
										background_c='".$_POST['background_c']."', 
										text_c='".$_POST['text_c']."',
										auto_s='".$_POST['auto_s']."'
									WHERE 
										id='1'");
	$db->close();
	header("Location: {$base_file}");
}

include ('includes/header.php');
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
				<div class="card ctcard">
					<div class="card-header">
						<center>
							<h2><i class="fa fa-futbol-o"></i> Sports Events</h2>
						</center>
					</div>
					<div class="card-body">
							<form method="post">

								<div class="form-group ctinput">
									<div class="form-line">
									  <label class="form-group form-float form-group-lg">API Key</label><br>
									  <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#how2">How to get the API Key</button><br><br>
									  <input class="form-control" name="auto_s" value="<?=$rowU['auto_s']?>" type="text"/>
									</div>
								</div>


								<div class="form-group ctinput">
									<div class="form-line">
										<label class="form-group form-float form-group-lg">Header Name</label>
										<input class="form-control" name="header_n" value="<?=$rowU['header_n']?>" type="text"/>
									</div>
								</div>

								<div class="form-group ctinput">
									<div class="form-line">
										<label class="form-group form-float form-group-lg">Border</label>
										<input class="form-control" name="border_c" value="<?=$rowU['border_c']?>" type="color"/>
									</div>
								</div>

								<div class="form-group ctinput">
									<div class="form-line">
										<label class="form-group form-float form-group-lg">Background Color</label>
										<input class="form-control" name="background_c" value="<?=$rowU['background_c']?>" type="color"/>
									</div>
								</div>

								<div class="form-group ctinput">
									<div class="form-line">
										<label class="form-group form-float form-group-lg">Text Color</label>
										<input class="form-control" name="text_c" value="<?=$rowU['text_c']?>" type="color"/>
									</div>
								</div>

								<!--<div class="form-group ctinput">
									<div class="form-line">
									  <label class="form-group form-float form-group-lg">Days</label>
									  <select class="form-control" id="select" name="days">
										  <option value="1" <?//=$rowU['days']=='1'?'selected':'' ?>>1</option>
										  <option value="3" <?//=$rowU['days']=='3'?'selected':'' ?>>3</option>
										  <option value="7" <?//=$rowU['days']=='7'?'selected':'' ?>>7</option>
									  </select>
									</div>
								</div>-->

								<div class="form-group ctinput">
									<center>
										<button class="btn btn-info ctbtn ctuserbtn" name="submit" type="submit">
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

</body>
</html>