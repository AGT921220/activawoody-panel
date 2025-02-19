<?php 
include ('includes/header.php');

//table name
$table_name = "announcements";

//table call
$res = $db->query("SELECT * FROM {$table_name}");

//update call
@$resU = $db->query("SELECT * FROM {$table_name} WHERE id='".sanitize($_GET['update'])."'");
@$rowU=$resU->fetchArray();
if(isset($_POST['submitU'])){
	$stmt = $db->prepare('UPDATE '.$table_name.' SET title=?, message=?, created_on=? WHERE id=?');
	$stmt->bindParam(1, $_POST['title']);
	$stmt->bindParam(2, $_POST['message']);
	$stmt->bindParam(3, $_POST['created_on']);
	$stmt->bindParam(4, sanitize($_GET['update']));
	$stmt->execute();
	echo "<script>window.location.href='". basename($_SERVER["SCRIPT_NAME"])."?status=1'</script>";
}

//submit new
if (isset($_POST['submit'])){
	$stmt = $db->prepare("INSERT INTO $table_name (title, message, created_on) VALUES (?, ?,?)");
	$stmt->bindParam(1, $_POST['title']);
	$stmt->bindParam(2, $_POST['message']);
	$stmt->bindParam(3, $_POST['created_on']);
	$stmt->execute();
	echo "<script>window.location.href='". basename($_SERVER["SCRIPT_NAME"])."?status=1'</script>";
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
<?php
if (isset($_GET['create'])){

//create form
?>

        <div class="col-md-8 mx-auto">
            <div class="card-body">
                <div class="card bg-primary text-white">
                    <div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-bullhorn"></i> Add Note</h2>
                        </center>
                    </div>
                    
                    <div class="card-body">
                        <div class="col-12">
                            <h3>Create Note</h3>
                        </div>
                            <form method="post">
                                <div class="form-group">
                                    <label class="form-label " for="Title">Title</label>
                                        <input class="form-control" name="title" placeholder="Title" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label " for="Description">Message</label>
                                        <input class="form-control" name="message" placeholder="Message" type="text"/>
                                </div>
                                <input type="hidden" name="created_on" value="<?php echo date("Y-m-d h:i:s")?>">
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


<?php 
}else if (isset($_GET['update'])){ 

//update form
?>

        <div class="col-md-8 mx-auto">
            <div class="card-body">
                <div class="card bg-primary text-white">
                    <div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-bullhorn"></i> Add Note</h2>
                        </center>
                    </div>
                    
                    <div class="card-body">
                        <div class="col-12">
                            <h3>Create Note</h3>
                        </div>
                            <form method="post">
                                <div class="form-group">
                                    <label class="form-label " for="Title">Title</label>
                                        <input class="form-control" name="title" placeholder="Title" value="<?=$rowU['Title'] ?>" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label " for="Description">Description</label>
                                        <input class="form-control" name="message" placeholder="DNS" value="<?=$rowU['Description'] ?>" type="text"/>
                                </div>
                                <input type="hidden" name="id" value="<?=$_GET['update'] ?>">
                                <input type="hidden" name="created_on"	value="<?php echo date("Y-m-d h:i:s")?>">
                                <div class="form-group">
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

        <div class="col-md-12 mx-auto">
            <div class="card-body">
                <div class="card bg-primary text-white">
                    <div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-commenting"></i> Current Notes</h2>
                        </center>
                    </div>

                    <div class="card-body">
                        <div class="col-12">
                        	<center>
	        					<a id="button" href="./<?php echo $base_file ?>?create" class="btn btn-info">New Note</a>
	        				</center>
    					</div>
						<br>
						<div class="table-responsive">
							<table class="table table-striped table-sm">
							<thead style="color:white!important">
								<tr>
								<th>Index</th>
								<th>Title</th>
								<th>Message</th>
								<th>CreateDate</th>
								<th>Edit&nbsp&nbsp&nbspDelete</th>
								</tr>
							</thead>
							<?php while ($row = $res->fetchArray()) {?>
							<tbody>
								<tr>
								<td><?=$row['id'] ?></td>
								<td><?=$row['title'] ?></td>
								<td><?=$row['message'] ?></td>
								<td><?=$row['created_on'] ?></td>
								<td>
								<a class="btn btn-info btn-ok" href="./<?php echo $base_file ?>?update=<?=$row['id'] ?>"><i class="fa fa-pencil-square-o"></i></a>
								&nbsp&nbsp&nbsp
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
<?php }?>

<?php include ('includes/footer.php');?>

</body>
</html>