<?php 
include ('includes/header.php');

//table name
$table_name = "vpn";

//table call
$res = $db->query("SELECT * FROM {$table_name}");

//submit new
if (!file_exists('vpn')) {
	mkdir('vpn', 511, true);
}

if (isset($_POST['submit'])) {
	Submit('sub_new', $db, $table_name);
	echo "<script>window.location.href='vpn.php?status=1'</script>";
}

//delete row
if (isset($_GET['delete'])) {
	Submit('sub_del', $db, $table_name);
	echo "<script>window.location.href='vpn.php?status=2'</script>";
}

function Submit($sub_type, $db, $table_name){
	if ($sub_type == 'sub_new') {
		$target_dir = 'vpn/';
		$target_file =  basename($_FILES['fileToUpload']['name']);
		$gtg = 1;
		$ft = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$file_path = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] !== 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/vpn/';
		if (file_exists($target_dir .$target_file)) {
			unlink($target_dir .$target_file);
		}

		if ($_POST['type'] == 'file') {
			if ($_FILES["fileToUpload"]["size"] > 500000) {
				echo '<div class="alert alert-danger" id="success-alert1"><h4><i class="icon fa fa-times"></i>Sorry, your file is too large.</h4></div>';
				$gtg = 0;
			}
			if ($ft != 'ovpn') {
				echo '<div class="alert alert-danger" id="success-alert"><h4><i class="icon fa fa-times"></i>Sorry, only OVPN files are allowed.</h4></div>';
				$gtg = 0;
			}
			if ($gtg != 0) {
				if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_dir .$target_file)) {
				$file_name = htmlspecialchars(basename($_FILES['fileToUpload']['name']));
				}
				$stmt = $db->prepare("INSERT INTO $table_name (vpn_country, vpn_file_name, username, password) VALUES (?,?,?,?)");
				$stmt->bindParam(1, $_POST['vpn_country']);
				$stmt->bindParam(2, $file_name);
				$stmt->bindParam(3, $_POST['username']);
				$stmt->bindParam(4, $_POST['password']);
				$stmt->execute();
			}
		}
		if ($_POST['type'] == 'url') {
			$path = pathinfo($_POST['ovpn_url']);
			$ovpn_in = file_get_contents($_POST['ovpn_url']);
			file_put_contents($target_dir.'/'.$path['basename'], $ovpn_in);
			$file_name = $path['basename'];
			$stmt = $db->prepare("INSERT INTO $table_name (vpn_country, vpn_file_name, username, password) VALUES (?,?,?,?)");
			$stmt->bindParam(1, $_POST['vpn_country']);
			$stmt->bindParam(2, $file_name);
			$stmt->bindParam(3, $_POST['username']);
			$stmt->bindParam(4, $_POST['password']);
			$stmt->execute();
		}
	}else if ($sub_type == 'sub_del') {
		$arr = $db->query("SELECT * FROM {$table_name} WHERE id=".sanitize($_GET['delete']));
		$del = $arr->fetchArray();
		$ftd = $del['vpn_file_name'];
		$ftd = 'vpn/' . $ftd;
		unlink($ftd);
		$stmt = $db->prepare('DELETE FROM '.$table_name.' WHERE id=?');
		$stmt->bindParam(1, sanitize($_GET['delete']));
		$stmt->execute();
	}
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


        <div class="col-md-6 mx-auto">
            <div class="card-body">
                <div class="card bg-primary text-white">
                    <div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-bullhorn"></i> OVPN</h2>
                        </center>
                    </div>
                    
                    <div class="card-body">

                        <div class="col-12">
                            <h3>Upload OVPN</h3>
                        </div>
                            <form action="" method="post" enctype="multipart/form-data">
				                <div class="form-group">
				                	<div class="form-group form-float form-group-lg">
                                        <div class="form-line">
                                            <label class="form-label"><strong>Location</strong></label>
				                			<input type="text" class="form-control" name="vpn_country" placeholder="Country / State">
				                		</div>
				                	</div>
				                </div>
                               <br>
                               <div>
                                   <label for="selector">Select OVPN Source</label>
                                   <select class="form-control"  style="width:auto;" name = "type" onchange="yesnoCheck(this);">
                                       <option value="url">URL</option>
                                       <option value="file">FILE</option>
                                   </select>
                               </div>
                               <br>
                               
                               
                               <div id="loc" class="form-group form-float form-group-lg">
                                   <div class="form-line">
                                       <label class="form-label"><strong>OVPN URL</strong></label>
                               		<input type="text" class="form-control" name="ovpn_url" placeholder="http://host.com/folder/poland.ovpn">
                               	</div>
                               </div>
                               
                               <div id="ftu" class="form-group"  style="display: none;">
                                   <label class="control-label " for="vpn_config">
                                       <strong>OVPN File</strong>
                                   </label>
                                   <div class="input-group">
                                       <input type="file" name="fileToUpload" id="fileToUpload" >
                                   </div>
                               </div>
							   <hr>
							   <strong>Only input user/pass if your App has the VPN mod otherwire it wont work</strong>
                                <div class="form-group ">
                                    <label class="control-label " for="username">
                                        Embedded Username
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" id="username" name="username" placeholder="Enter Username" value='' type="text"/>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label " for="password">
                                        Embedded Password 
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" id="password" name="password" placeholder="Enter Password" value='' type="text"/>
                                    </div>
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
 }else{
//main table/form
	 ?>

        <div class="col-md-12 mx-auto">
            <div class="card-body">
                <div class="card bg-primary text-white">
                    <div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-commenting"></i> OVPN's</h2>
                        </center>
                    </div>

                    <div class="card-body">
                        <div class="col-12">
                        	<center>
	        					<a id="button" href="./<?php echo $base_file ?>?create" class="btn btn-info">New OVPN</a>
	        				</center>
    					</div>
						<br>
						<div class="table-responsive">
							<table class="table table-striped table-sm">
							<thead style="color:white!important">
								<tr>
								<th>Index</th>
								<th>Location</th>
								<th>File Name</th>
								<th>Username</th>
								<th>Password</th>
								<th>Delete</th>
								</tr>
							</thead>
							<?php while ($row = $res->fetchArray()) {?>
							<tbody>
								<tr>
								<td><?=$row['id'] ?></td>
								<td><?=$row['vpn_country'] ?></td>
								<td><?=$row['vpn_file_name'] ?></td>
								<td><?=$row['username'] ?></td>
								<td><?=$row['password'] ?></td>
								<td>
								<a class="btn btn-danger btn-ok" href="#" data-href="./<?=$base_file ?>?delete=<?=$row['id'] ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
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
<script>

function yesnoCheck(that){
    if (that.value == "url"){
        document.getElementById("loc").style.display = "block";
    }else{
        document.getElementById("loc").style.display = "none";
    }
    if (that.value == "file"){
        document.getElementById("ftu").style.display = "block";
    }else{
        document.getElementById("ftu").style.display = "none";
    }
}
</script>
</body>
</html>