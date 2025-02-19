<?php
$jsonFilePath = 'includes/ad_type.json';
$jsonData = json_decode(file_get_contents($jsonFilePath), true);
$currentAdType = $jsonData['adType'] ?? 'manual'; 
include ('includes/header.php');

//table name
$table_name = "ads";

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
                            <h2><i class="icon icon-bullhorn"></i> AD's</h2>
                        </center>
                    </div>
                    
                    <div class="card-body">
                        <div class="col-12">
                            <h3>Create Advert</h3>
                        </div>
                            <form method="post">
                                <div class="form-group">
                                    <label class="form-label " for="description">description</label>
                                        <input class="form-control" id="description" name="description" placeholder="Description" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label " for="image_url">image_url</label>
                                        <input class="form-control" id="description" name="image_url" placeholder="Image Url" type="text"/>
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
                <div id="slider-container">
    <label class="switch">
        <input type="checkbox" id="pageSlider" onchange="toggleAdType()">
        <span class="slider round"></span>
    </label>
</div>
                <div class="card bg-primary text-white">
                    <div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-bullhorn"></i> Advert's</h2>
                        </center>
                    </div>
                    
                    <div class="card-body">
                        <div class="col-12">
                            <h3>Edit Advert</h3>
                        </div>
                            <form method="post">
                                <div class="form-group">
                                    <label class="form-label " for="description">description</label>
                                        <input class="form-control" id="description" name="description" placeholder=Description" value="<?=$resU[0]['description'] ?>" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label " for="image_url">image_url</label>
                                        <input class="form-control" id="description" name="image_url" placeholder="Image Url" value="<?=$resU[0]['image_url'] ?>" type="text"/>
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
<link rel="stylesheet" href="css/slider.css">

        <div class="col-md-12 mx-auto">
            <div class="card-body">
                
                <div class="card bg-primary text-white">
                    <div class="card-header card-header-warning">
                        <center>
                            <div id="slider-container" style="display: flex; align-items: center; justify-content: center;">
    <span style="margin-right: 20px; font-size: 24px;">Manual Ads</span> <!-- Increased font size here -->
    <label class="switch">
        <input type="checkbox" id="pageSlider" onchange="toggleAdType()">
        <span class="slider round"></span>
    </label>
    <span style="margin-left: 20px; font-size: 24px;">tMDB Ads</span> <!-- And here -->
</div>

                            <h5> Advert Type Selector</h5>
                        </center>
                    </div>

                    <div class="card-body">
                        <div class="col-12">
                        	<center>
	        					<a id="button" href="./<?=basename($_SERVER["SCRIPT_NAME"]) ?>?create" class="btn btn-info">New Advert</a>
	        				</center>
    					</div>
						<br>
						<div class="table-responsive">
							<table class="table table-striped table-sm">
							<thead style="color:white!important">
								<tr>
								<th>Index</th>
								<th>Description</th>
								<th>Image Url</th>
								<th>Edit&nbsp&nbsp&nbspDelete</th>
								</tr>
							</thead>
							<?php foreach ($res as $row) {?>
							<tbody>
								<tr>
								<td><?=$row['id'] ?></td>
								<td><?=$row['description'] ?></a></td>
                                <td>
                        <img src="<?=$row['image_url'] ?>" alt="Image" style="width:200px; height:auto;"> <!-- Display image only -->
                    </td> <!-- Display image -->
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    var slider = document.getElementById('pageSlider');
    slider.checked = window.location.href.includes('tmdb_api.php');

    slider.addEventListener('change', function() {
        var adType = this.checked ? 'tmdb' : 'manual';
        updateAdType(adType, this.checked);
    });
});

function updateAdType(adType, isChecked) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ad_type.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        // Redirect to the appropriate page based on the slider's position
        window.location.href = isChecked ? 'tmdb_api.php' : 'ads.php';
    };
    xhr.send('adType=' + adType);
}
</script>

</body>
</html>