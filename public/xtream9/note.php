<?php 
include ('includes/header.php');

//table name
$table_name = "note";
$page = "note.php";

//table call
$res = $db->select($table_name, '*', '', '');

//update call
@$resU = $db->select($table_name, '*', 'id = :id', '', [':id' => $_GET['update']]);

if(isset($_POST['submitU'])){
	unset($_POST['submitU']);
	$updateData = $_POST;
	$db->update($table_name, $updateData, 'id = :id',[':id' => $_GET['update']]);
	echo "<script>window.location.href='".$page."?status=1'</script>";
}

//submit new
if (isset($_POST['submit'])){
	unset($_POST['submit']);
	$db->insert($table_name, $_POST);
	$db->close();
	echo "<script>window.location.href='".$page."?status=1'</script>";
}

//delete row
if(isset($_GET['delete'])){
	$db->delete($table_name, 'id = :id',[':id' => $_GET['delete']]);
	echo "<script>window.location.href='".$page."?status=2'</script>";
}

?>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="background-color: black;">
			<div class="modal-header">
				<h2 style="color: white;">Confirm</h2>
			</div>
			<div class="modal-body" style="color: white;">
				Do you really want to delete?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
				<a style="color: white;" class="btn btn-danger btn-ok">Delete</a>
			</div>
		</div>
	</div>
</div>
<?php
if (isset($_GET['create'])){

//create form
?>

		<div class="col-md-8 mx-auto ctmain-table">
			<div class="card-body">
				<div class="card ctcard">
					<div class="card-header card-header-warning">
						<center>
							<h2><i class="icon icon-bullhorn"></i> Announcements </h2>
						</center>
					</div>
					
					<div class="card-body">
						<div class="col-12">
							<h3>Add Announcement</h3>
						</div>
							<form method="post">
								<div class="form-group ctinput">
									<label class="form-label " for="note_title">Title</label>
										<input class="form-control" name="note_title" placeholder="Title" type="text"/>
								</div>
								<div class="form-group ctinput">
									<label class="form-label " for="dns">Note</label>
										<textarea class="form-control" name="note_content" rows="5" cols="50"></textarea>
										<input type="hidden" name="createdate" value="<?=date('Y-m-d h:i:s')?>">
								</div>
								<div class="form-group ctinput">
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
<?php 
}else if (isset($_GET['update'])){ 

//update form
?>
		<div class="col-md-12 mx-auto ctmain-table">
			<div class="card-body">
				<div class="card ctcard">
					<div class="card-header card-header-warning">
						<center>
							<h2><i class="icon icon-bullhorn"></i> Announcement</h2>
						</center>
					</div>
					
					<div class="card-body">
						<div class="col-12">
							<h3>Edit Announcement</h3>
						</div>
							<form method="post">
								<input type="hidden" name="id" value="<?=$_GET['update'] ?>">
								<div class="form-group ctinput">
									<label class="form-label " for="title">Title</label>
										<input class="form-control" id="description" name="note_content" placeholder="Title" value="<?=$resU[0]['note_title'] ?>" type="text"/>
								</div>
								<div class="form-group ctinput">
									<label class="form-label " for="note">Note</label>
										<textarea class="form-control" name="note_content" rows="5" cols="50"><?=$resU[0]['note_content'] ?></textarea>
										<input type="hidden" name="createdate" value="<?=date('Y-m-d h:i:s')?>">
								</div>
								<div class="form-group ctinput">
									<center>
										<button class="btn btn-info " name="submitU" type="submit">
											<i class="icon icon-check"></i> Submit
										</button>
									</center>
								</div>
							</form>
					</div>
				</div>
			</div>
		</div>
<?php
 }else{
//main table/form
	 ?>

		<div class="col-md-12 mx-auto ctmain-table">
			<div class="card-body">
				<div class="card ctcard">
					<div class="card-header card-header-warning">
						<center>
							<h2><i class="icon icon-commenting"></i> Current Announcements</h2>
						</center>
					</div>
					<div class="card-body" >
						<div class="col-12">
							<center>
								<a id="button" href="./<?=$page ?>?create" class="btn btn-info">New Announcement</a>
							</center>
						</div>
						<br>
						<div class="table-responsive">
							<table class="table table-striped table-sm">
							<thead style="color:white!important">
								<tr>
									<th>Title</th>
									<th>Note</th>
									<th>Create Date</th>
									<th>Edit&nbsp&nbsp&nbspDelete</th>
								</tr>
							</thead>
							<?php foreach ($res as $row) {
							?>
							<tbody>
								<tr>
									<td><?=$row['note_title'] ?></a></td>
									<td><?=$row['note_content'] ?></td>
									<td><?=$row['createdate'] ?></td>
									<td>
									<a class="btn btn-info btn-ok" href="<?=$page ?>?update=<?=$row['id'] ?>"><i class="fa fa-pencil-square-o"></i></a>
									&nbsp&nbsp&nbsp
									<a class="btn btn-danger btn-ok" href="#" data-href="<?=$page ?>?delete=<?=$row['id'] ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
									</td>
								</tr>
							</tbody>
							<?php
							}?>
							</table>
						</div>
						</div>
					</div>
				</div>


	</div>
<?php }?>

<?php include ('includes/footer.php');?>

</body>
</html>