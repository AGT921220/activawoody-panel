<?php 
include ('includes/header.php');

//table name
$table_name = "sports";
$page = "sports";

$data = ['id' => '1', 'header_n' => 'Event', 'border_c' => '#000000', 'background_c' => '#000000', 'text_c' => '#ffffff', 'api' => '1',];
$db->insertIfEmpty($table_name, $data);
//table call
$res = $db->select($table_name, '*', '', '');

if(isset($_POST['submit'])){
	unset($_POST['submit']);
	$updateData = $_POST;
	$db->update($table_name, $updateData, 'id = :id',[':id' => 1]);
	echo "<script>window.location.href='".$page.".php?status=1'</script>";
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
									  <input class="form-control" name="api" value="<?=$res[0]['api']?>" type="text"/>
									</div>
								</div>


								<div class="form-group ">
									<div class="form-line">
										<label class="form-group form-float form-group-lg">Header Name</label>
										<input class="form-control" name="header_n" value="<?=$res[0]['header_n']?>" type="text"/>
									</div>
								</div>

								<div class="form-group ">
									<div class="form-line">
										<label class="form-group form-float form-group-lg">Border</label>
										<input class="form-control" name="border_c" value="<?=$res[0]['border_c']?>" type="color"/>
									</div>
								</div>

								<div class="form-group ">
									<div class="form-line">
										<label class="form-group form-float form-group-lg">Background Color</label>
										<input class="form-control" name="background_c" value="<?=$res[0]['background_c']?>" type="color"/>
									</div>
								</div>

								<div class="form-group ">
									<div class="form-line">
										<label class="form-group form-float form-group-lg">Text Color</label>
										<input class="form-control" name="text_c" value="<?=$res[0]['text_c']?>" type="color"/>
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