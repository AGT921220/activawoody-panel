<?php
include ('includes/header.php');

$res = $db->query("SELECT * FROM users WHERE id='1'");
$row = $res->fetchArray();

if (isset($_POST['submit'])){
	$db->exec("UPDATE users SET	username='{$_POST['username']}', password='{$_POST['password']}' WHERE id='1' ");
	session_start();
	session_regenerate_id();
	$_SESSION['loggedin'] = true;
	$_SESSION['name'] = $_POST['username'];
	echo "<script>window.location.href='". basename($_SERVER["SCRIPT_NAME"])."'</script>";
}

?>

    	<div class="col-md-6 mx-auto">
			<div class="card-body">
				<div class="card bg-primary text-white">
					<div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-user"></i> Update Credentials</h2>
                        </center>
                    </div>
					<div class="alert alert-info alert-dismissible" role="alert">
						<center>
							<h3 style="color:black!important">Do <strong style="color:black!important">not</strong> use <em>admin</em> for username or password!</h3>
						</center>
					</div>

					<div class="card-body">
						<form  method="post">

							<div class="form-group">
								<div class="form-group form-float form-group-lg">
                                    <div class="form-line">
                                        <label class="form-label">Username</label>
										<input type="text" class="form-control" name="username" value="<?=$row['username'] ?>">
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="form-group form-float form-group-lg">
                                    <div class="form-line">
                                        <label class="form-label">Password</label>
										<input type="text" class="form-control" name="password" value="<?=$row['password'] ?>">
									</div>
								</div>
							</div>

							<hr>

							<center>
								<button type="submit" name="submit" class="btn btn-info">
									<i class="icon icon-check"></i>Update Credentials
								</button>
							</center>
						</form>
					</div>
				</div>
			</div>
		</div>


<?php include ('includes/footer.php'); ?>

</body>
</html>