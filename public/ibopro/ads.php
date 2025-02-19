<?php 
include ('includes/header.php');

//table name
$table_name = "ads";

//current file var
$base_file = basename($_SERVER["SCRIPT_NAME"]);

//create if not
$adb->exec("CREATE TABLE IF NOT EXISTS {$table_name}(id INTEGER PRIMARY KEY	AUTOINCREMENT  NOT NULL, title VARCHAR(100), url TEXT)");

//table call
$res = $adb->query("SELECT * FROM {$table_name}");

//update call
@$resU = $adb->query("SELECT * FROM {$table_name} WHERE id='{$_GET['update']}'");
@$rowU=$resU->fetchArray();
if(isset($_POST['submitU'])){
	$adb->exec("UPDATE {$table_name} SET title='{$_POST['title']}',url='{$_POST['url']}' WHERE  id='{$_POST['id']}'");
	$adb->close();
	//header("Location: {$base_file}");
	echo "<script>window.location.href='mRTXBGads.php';</script>";
    exit;
}

//submit new
if (isset($_POST['submit'])){
	$adb->exec("INSERT INTO {$table_name}(title, url) VALUES('{$_POST['title']}', '{$_POST['url']}')");
	//header("Location: {$base_file}");
	echo "<script>window.location.href='mRTXBGads.php';</script>";
    exit;
}

//delete row
if(isset($_GET['delete'])){
	$adb->exec("DELETE FROM {$table_name} WHERE id={$_GET['delete']}");
	//header("Location: {$base_file}");
	echo "<script>window.location.href='mRTXBGads.php';</script>";
    exit;
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
                <center>
		        <h1 class="colorboard"></i>New Advertisement</h1>
	            </center>
				<div class="card bg-primary text-white">
					<div class="card-header">
						<center>
							<h2><i class="fa fa-eye"></i> Add new advertisement</h2>
						</center>
					</div>
					<div class="card-body">
        				<form method="post">
                            <div class="form-group">
                              <input class="form-control" type="text" name="title">
                              <label>Tile</label>
                            </div>
                            <div class="form-group">
                              <input class="form-control" type="text" name="url">
                              <label>Ad Url ( GIF,PNG,JPG,SVG )</label>
                            </div>  
                            <div class="col-12"> <button type="submit" name="submit" class="btn btn-info ">Submit</button> </div>
                          </form>
					</div>
					</div>
				</div>

<?php 
}else if (isset($_GET['update'])){ 

//update form
?>
            <div class="col-md-8 mx-auto">
                <center>
		        <h1 class="colorboard"></i>Edit Advertisement</h1>
	            </center>
				<div class="card bg-primary text-white">
					<div class="card-header">
						<center>
							<h2><i class="fa fa-file-image-o"></i> Edit Ad</h2>
						</center>
					</div>
					<div class="card-body">
                            <form method="post">
                                  <input type="hidden" class="form-control" name="id" value="<?=$_GET['update'] ?>">
                                <div class="user-box">
                                  <input type="text" name="title" class="form-control" value="<?=$rowU['title'] ?>">
                                  <label>Tile</label>
                                </div>
                                <div class="user-box">
                                  <input type="text" class="form-control" name="url" value="<?=$rowU['url'] ?>">
                                  <label>Ad Url ( GIF,PNG,JPG,SVG )</label>
                                </div>  
                                <div class="col-12"> <button type="submit" name="submitU" class="btn btn-info ">Submit</button> </div>
                              </form>
					</div>
					</div>
				</div>
<?php
 }else{
//main table/form
	 ?>

	<div class="col-md-12 mx-auto">
	<center>
		<h1 class="colorboard"></i> Advertisement</h1>
		<a id="button" href="./<?php echo $base_file ?>?create" class="btn btn-primary">New Ad</a>
	</center>
	<br>
	<div class="table-responsive">
		<table class="table table-striped table-sm">
			<thead style="color:white!important">
				<tr>
					<th>Index</th>
					<th>Title</th>
					<th>Ad Url</th>
					<th>Preview</th>
					<th>Edit&nbsp;&nbsp;&nbsp;Delete</th>
				</tr>
			</thead>
			<?php while ($row = $res->fetchArray()) {?>
			<tbody>
				<tr>
					<td><?=$row['id'] ?></td>
					<td <?php if (strpos($row['url'], '.mp4') !== false || strpos($row['url'], '.webm') !== false || strpos($row['url'], '.gif') !== false || strpos($row['url'], '.ogg') !== false) {echo 'style="color: red;"';} ?>><?=$row['title'] ?></a></td>
					<td><?=$row['url'] ?></td>
					<td>
						<?php if (strpos($row['url'], '.mp4') !== false || strpos($row['url'], '.webm') !== false || strpos($row['url'], '.ogg') !== false) {?>
							<video src="<?=$row['url']?>" controls width="100px" autoplay = true controls = false muted = true loop = false></video>
						<?php } else if (strpos($row['url'], '.jpg') !== false || strpos($row['url'], '.jpeg') !== false || strpos($row['url'], '.png') !== false|| strpos($row['url'], '.gif') !== false) {?>
							<img src="<?=$row['url']?>" width="100px"/>
						<?php }?>
					</td>
					<td>
						<a class="btn btn-info btn-ok" href="<?php echo $base_file ?>?update=<?=$row['id'] ?>"><i class="fa fa-pencil-square-o"></i></a>
						&nbsp;&nbsp;&nbsp;
						<a class="btn btn-danger btn-ok" href="#" data-href="<?php echo $base_file ?>?delete=<?=$row['id'] ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
					</td>
				</tr>
			</tbody>
			<?php }?>
		</table>
	</div>
</div>

<?php }?>

<?php include ('includes/footer.php');?>
<script type="text/javascript">
//updtae alert
$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").alert('close');
});


//delete modal
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

</script>
</body>
</html>