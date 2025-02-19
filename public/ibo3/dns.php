<?php

include ('includes/header.php');

//table name
$table_name = "dns";

//table call
$res = $db->select($table_name, '*', '', '');

//update call
@$resU = $db->select($table_name, '*', 'id = :id', '', [':id' => $_GET['update']]);

if(isset($_POST['submitU'])){
	unset($_POST['submitU']);
	$updateData = $_POST;
	$db->update($table_name, $updateData, 'id = :id',[':id' => $_GET['update']]);
	echo "<script>window.location.href='". basename($_SERVER["SCRIPT_NAME"])."?status=1'</script>";
}

//submit new
if (isset($_POST['submit'])){
	unset($_POST['submit']);
	$db->insert($table_name, $_POST);
	$db->close();
	echo "<script>window.location.href='". basename($_SERVER["SCRIPT_NAME"])."?status=1'</script>";
}

//delete row
if(isset($_GET['delete'])){
	$db->delete($table_name, 'id = :id',[':id' => $_GET['delete']]);
	echo "<script>window.location.href='". basename($_SERVER["SCRIPT_NAME"])."?status=2'</script>";
}

//delete modal
?>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Confirm</h2>
            </div>
            <div class="modal-body">
                Do you really want to delete?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
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
                            <h2><i class="icon icon-bullhorn"></i> DNS's</h2>
                        </center>
                    </div>
                    
                    <div class="card-body">
                        <div class="col-12">
                            <h3>Create DNS</h3>
                        </div>
                            <form method="post">
                                <div class="form-group">
                                    <label class="form-label " for="title">Title</label>
                                        <input class="form-control" id="description" name="title" placeholder="Title" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label " for="dns">DNS</label>
                                        <input class="form-control" id="description" name="url" placeholder="DNS" type="text"/>
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

<?php 
}else if (isset($_GET['update'])){ 

//update form
?>
        <div class="col-md-8 mx-auto">
            <div class="card-body">
                <div class="card bg-primary text-white">
                    <div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-bullhorn"></i> DNS's</h2>
                        </center>
                    </div>
                    
                    <div class="card-body">
                        <div class="col-12">
                            <h3>Edit DNS</h3>
                        </div>
                            <form method="post">
                                <div class="form-group">
                                    <label class="form-label " for="title">Title</label>
                                        <input class="form-control" id="description" name="title" placeholder="Title" value="<?=$resU[0]['title'] ?>" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label " for="dns">DNS</label>
                                        <input class="form-control" id="description" name="url" placeholder="DNS" value="<?=$resU[0]['url'] ?>" type="text"/>
                                </div>
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
                            <h2><i class="icon icon-commenting"></i> DNS's</h2>
                        </center>
                    </div>

                    <div class="card-body">
                        <div class="col-12">
                        	<center>
	        					<a id="button" href="./<?=basename($_SERVER["SCRIPT_NAME"]) ?>?create" class="btn btn-info">New DNS</a>
	        				</center>
    					</div>
						<br>
						<div class="table-responsive">
							<table class="table table-striped table-sm">
							<thead style="color:white!important">
								<tr>
								<th>Index</th>
								<th>Title</th>
								<th>DNS</th>
								<th>Edit&nbsp&nbsp&nbspDelete</th>
								</tr>
							</thead>
							<?php foreach ($res as $row) {?>
							<tbody>
								<tr>
								<td><?=$row['id'] ?></td>
								<td><?=$row['title'] ?></a></td>
								<td><?=$row['url'] ?></td>
								<td>
								<a class="btn btn-info btn-ok" href="./<?=basename($_SERVER["SCRIPT_NAME"]) ?>?update=<?=$row['id'] ?>"><i class="fa fa-pencil-square-o"></i></a>
								&nbsp&nbsp&nbsp
								<a class="btn btn-danger btn-ok" href="#" data-href="./<?=basename($_SERVER["SCRIPT_NAME"]) ?>?delete=<?=$row['id'] ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
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