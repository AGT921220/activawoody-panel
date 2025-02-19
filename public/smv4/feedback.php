<?php 
include ('includes/header.php');

//table name
$table_name = "feedback";

$res = $db->query("SELECT * FROM {$table_name}");

if(isset($_GET['deletetbl'])){
	$stmt = $db->prepare("DELETE FROM $table_name");
	$stmt->execute();
}
//delete row
if(isset($_GET['delete'])){
	$stmt = $db->prepare('DELETE FROM '.$table_name.' WHERE id=?');
	$stmt->bindParam(1, sanitize($_GET['delete']));
	$stmt->execute();
	echo "<script>window.location.href='". basename($_SERVER["SCRIPT_NAME"])."?status=2'</script>";
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
<div class="modal fade" id="deletetbl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="background-color: black;">
			<div class="modal-header">
				<h2 style="color: white;">Confirm</h2>
			</div>
			<div class="modal-body" style="color: white;">
				Do you really want to delete all the records???
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
				<a style="color: white;" href="./<?php echo $base_file ?>?deletetbl" class="btn btn-danger btn-ok">Delete</a>
			</div>
		</div>
	</div>
</div>
<div class="col-md-12 mx-auto">
    <div class="card-body">
        <div class="card bg-primary text-white">
            <div class="card-header card-header-warning">
                <center>
                    <h2><i class="icon icon-commenting"></i> Current Feedback</h2>
                </center>
            </div>

            <div class="card-body">
                <div class="col-12">
                	<center>
						
	        			<a class="btn btn-danger btn-ok" href="#" data-toggle="modal" data-target="#deletetbl"><i class="fa fa-trash-o"></i>&nbspDelete all records!!!</a>
	        		</center>
    			</div>
				<br>
				<div class="table-responsive">
					<table class="table table-striped table-sm">
					<thead style="color:white!important">
						<tr>
						<th>Username</th>
						<th>Macaddress</th>
						<th>Feedback</th>
						<th>Delete</th>
						</tr>
					</thead>
					<?php while ($row = $res->fetchArray()) {?>
					<tbody>
						<tr>
						<td><?=$row['username'] ?></td>
						<td><?=$row['macaddress'] ?></td>
						<td><?=$row['feedback_content']?></td>
						<td>
						<a class="btn btn-danger btn-ok" href="#" data-href="./<?php echo $base_file ?>?delete=<?=$row['id'] ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
						</td>
						</tr>
					</tbody>
					<?php }?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include ('includes/footer.php');?>

</body>
</html>