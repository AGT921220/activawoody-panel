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

function Submit($sub_type, $db, $table_name)
{
	if ($sub_type == 'sub_up') {

		$dns_new = $_POST['dns'];
		$feedback_new = $_POST['feedback'];
		$messages_new = $_POST['messages'];
		$vpn_new = $_POST['vpn'];
		$adverts_new = $_POST['adverts'];
		$sports_new = $_POST['sports'];
		$update_new = $_POST['update'];
		$rate_new = $_POST['rate'];
		$intro_new = $_POST['intro'];
		$debug_new = $_POST['debug'];
		$logo_new = $_POST['logo'];
		$backg_new = $_POST['backg'];
		$adss_new = $_POST['adss'];
		$panel_name = $_POST['panel_name'];
		$brand_name = $_POST['brand_name'];
		$contact = $_POST['contact'];
		
		// open file
		$config_file = fopen("config.ini", "w") or die("Unable to open file!");


		$file_new_text = 
		'		
		[Show]
		dns = '.$dns_new.'
		feedback = '.$feedback_new.'
		messages = '.$messages_new.'
		vpn = '.$vpn_new.'
		adverts = '.$adverts_new.'
		sports = '.$sports_new.'
		update = '.$update_new.'
		rate = '.$rate_new.'
		intro = '.$intro_new.'
		debug = '.$debug_new.'
		logo = '.$logo_new.'
		backg = '.$backg_new.'
		adss = '.$adss_new.'

		[titles]
		panel_name = '.$panel_name.'
		brand_name = '.$brand_name.'
		contact = '.$contact.'
		';

		echo fwrite($config_file, $file_new_text);
		fclose($myfile);
	}
  
	$db->close();

	if ($sub_type == 'sub_up') {
		echo "<script type='text/javascript'>
			  window.location.href='".$base_file."?status=2';
			</script>";
	}
	//header('Location: ' . $base_file . '?status=1'); //added by aleem
}

include 'includes/header.php';
$table_name = 'dns';
$db->exec('CREATE TABLE IF NOT EXISTS ' . $table_name . '(id INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL, title TEXT, url TEXT)');
$res = $db->query('SELECT * FROM ' . $table_name);
@$resU = $db->query('SELECT * FROM ' . $table_name . ' WHERE id=\'' . sanitize($_GET['update']) . '\'');
@$rowU = $resU->fetchArray();


if (isset($_POST['submit'])) {
	submit('sub_up', $db, $table_name);
	// header('Location: ' . $base_file . '?status=2');
}
?>

<div class="col-lg-8 mx-auto ctmain-form">
	<div class="card-body">
		<div class="card ctcard">
			<div class="card-header card-header-warning">
				<center><h2><i class="fa fa-bullhorn"></i> CONFIGURATIONS\'s</h2></center>
			</div>
			<div class="card-body">
				<div class="col-12"><h3>Update Config</h3></div>
				<form method="post">
					<div class="row">
						<div class="col-6 form-group ctinput">
							<label class="form-label " for="title">DNS</label>
							<select class="form-control" id="dns" name="dns">
								<option value="true" <?php echo ($config_ini['dns'] == 1)?'selected':'';?>>True</option>
								<option value="false" <?php echo ($config_ini['dns'] == 0)?'selected':'';?>>False</option>
							</select>
						</div>

						<div class="col-6 form-group ctinput">
							<label class="form-label " for="feedback">Feedback</label>
							<select class="form-control" id="feedback" name="feedback">
								<option value="true" <?php echo ($config_ini['feedback'] == 1)?'selected' : '';?>>True</option>
								<option value="false" <?php echo ($config_ini['feedback'] == 0) ? 'selected' : '';?>>False</option>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-6 form-group ctinput">
							<label class="form-label " for="messages">Messages</label>
							<select class="form-control" id="messages" name="messages">
								<option value="true" <?php echo ($config_ini['messages'] == 1) ? 'selected' : '';?>>True</option>
								<option value="false" <?php echo ($config_ini['messages'] == 0) ? 'selected' : '';?>>False</option>
							</select>
						</div>

						<div class="col-6 form-group ctinput">
							<label class="form-label " for="vpn">VPN</label>
							<select class="form-control" id="vpn" name="vpn">
								<option value="true" <?php echo ($config_ini['vpn'] == 1) ? 'selected' : '';?>>True</option>
								<option value="false" <?php echo ($config_ini['vpn'] == 0) ? 'selected' : '';?>>False</option>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-6 form-group ctinput">
							<label class="form-label " for="adverts">Adverts</label>
							<select class="form-control" id="adverts" name="adverts">
								<option value="true" <?php echo ($config_ini['adverts'] == 1) ? 'selected' : '';?>>True</option>
								<option value="false" <?php echo ($config_ini['adverts'] == 0) ? 'selected' : '';?>>False</option>
							</select>
						</div>

						<div class="col-6 form-group ctinput">
							<label class="form-label " for="sports">Sports</label>
							<select class="form-control" id="sports" name="sports">
								<option value="true" <?php echo ($config_ini['sports'] == 1) ? 'selected' : '';?>>True</option>
								<option value="false" <?php echo ($config_ini['sports'] == 0) ? 'selected' : '';?>>False</option>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-6 form-group ctinput">
							<label class="form-label " for="update">Update</label>
							<select class="form-control" id="update" name="update">
								<option value="true" <?php echo ($config_ini['update'] == 1) ? 'selected' : '';?>>True</option>
								<option value="false" <?php echo ($config_ini['update'] == 0) ? 'selected' : '';?>>False</option>
							</select>
						</div>
						
						<div class="col-6 form-group ctinput">
							<label class="form-label " for="rate">Rate</label>
							<select class="form-control" id="rate" name="rate">
								<option value="true" <?php echo ($config_ini['rate'] == 1) ? 'selected' : '';?>>True</option>
								<option value="false" <?php echo ($config_ini['rate'] == 0) ? 'selected' : '';?>>False</option>
							</select>
						</div>
					</div>
					
					<div class="row">
						<div class="col-6 form-group ctinput">
							<label class="form-label " for="debug">Debug</label>
							<select class="form-control" id="debug" name="debug">
								<option value="true" <?php echo ($config_ini['debug'] == 1) ? 'selected' : '';?>>True</option>
								<option value="false" <?php echo ($config_ini['debug'] == 0) ? 'selected' : '';?>>False</option>
							</select>
						</div>

						<div class="col-6 form-group ctinput">
							<label class="form-label " for="logo">Logo</label>
							<select class="form-control" id="logo" name="logo">
								<option value="true" <?php echo ($config_ini['logo'] == 1) ? 'selected' : '';?>>True</option>
								<option value="false" <?php echo ($config_ini['logo'] == 0) ? 'selected' : '';?>>False</option>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-6 form-group ctinput">
							<label class="form-label " for="backg">Backg</label>
							<select class="form-control" id="backg" name="backg">
								<option value="true" <?php echo ($config_ini['backg'] == 1) ? 'selected' : '';?>>True</option>
								<option value="false" <?php echo ($config_ini['backg'] == 0) ? 'selected' : '';?>>False</option>
							</select>
						</div>
						
						<div class="col-6 form-group ctinput">
							<label class="form-label " for="adss">Adss</label>
							<select class="form-control" id="adss" name="adss">
								<option value="true" <?php echo ($config_ini['adss'] == 1) ? 'selected' : '';?>>True</option>
								<option value="false" <?php echo ($config_ini['adss'] == 0) ? 'selected' : '';?>>False</option>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-6 form-group ctinput">
							<label class="form-label " for="intro">Intro</label>
							<select class="form-control" id="intro" name="intro">
								<option value="true" <?php echo ($config_ini['intro'] == 1) ? 'selected' : '';?>>True</option>
								<option value="false" <?php echo ($config_ini['intro'] == 0) ? 'selected' : '';?>>False</option>
							</select>
						</div>

						<div class="col-6 form-group ctinput">
							<label class="form-label " for="panel_name">Panel Name</label>
							<input class="form-control" id="panel_name" name="panel_name" placeholder="Panel Name" type="text" value='<?php echo $config_ini['panel_name']; ?>' />
						</div>
					</div>

					<div class="row">
						<div class="col-6 form-group ctinput">
							<label class="form-label " for="brand_name">Brand Name</label>
							<input class="form-control" id="brand_name" name="brand_name" placeholder="Brand Name" type="text" value='<?php echo $config_ini['brand_name']; ?>'/>
						</div>

						<div class="col-6 form-group ctinput">
							<label class="form-label " for="contact">Contact</label>
							<input class="form-control" id="contact" name="contact" placeholder="Contact" type="text" value='<?php echo $config_ini['contact']; ?>'/>
						</div> 
					</div>

					<div class="form-group ctinput">
						<center>
							<button class="btn btn-info ctbtn ctuserbtn" name="submit" type="submit">
								<i class="fa fa-check"></i> Submit
							</button>
						</center>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
echo "\r\n\r\n";

echo "\r\n";
include 'includes/footer.php';
echo "\r\n" . '</body>' . "\r\n" . '</html>';
?>