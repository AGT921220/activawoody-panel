<div class="row mb-4">
	<div class="col-lg-12 col-md-12 mb-md-0">
		<div class="card">
			<div class="card-header pb-0">
				<div class="row">
					<div class="col-lg-6 col-7">
						<h6>Settings</h6>
					</div>
				</div>
			</div>
			<div class="card-body px-0 pb-2">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-12">
							<div class="card card-plain">
								<div class="card-body">
									<form action="action.php" method="post" role="form">
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">Userame</label>
											<input name="username" type="text" value="<?php echo $userInfo['username']; ?>" class="form-control">
										</div>
										<hr />
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">New Password</label>
											<input name="password" type="text" value="" class="form-control">
										</div>
										<div class="text-center">
											<button name="updateprofile" type="submit" class="btn btn-lg bg-gradient-secondary btn-lg w-100 mt-4 mb-0">Update Username/Password</button>
										</div>
									</form>
									<hr>
									<hr>
									<form action="action.php" method="post" role="form">
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">Panel Root URL (This is usually what is in your browser address bar now without&nbsp;&nbsp;<b>dashboard.php?profile</b>&nbsp;&nbsp;on the end</label>
											<input name="panel_root" type="text" value="<?php echo $panelRoot; ?>" class="form-control">
										</div>
										<p>You will need to log in again after changing root URL</p>
										<div class="text-center">
											<button name="updatepanelroot" type="submit" class="btn btn-lg bg-gradient-secondary btn-lg w-100 mt-4 mb-0">Update Panel Root URL</button>
										</div>
									</form>
								</div>

							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-12">
							<div class="card card-plain">
								<div class="card-body">
									<form action="action.php" method="post" role="form">
										<div class="text-center">
											<?php
											if (isset($_SESSION['rewrite_results'])) {
												$results = $_SESSION['rewrite_results'];
												if (count($results) == 0) {
											?>
													<span class="text-success">All rewrites seem to be working fine</span>

												<?php
												} else {
												?>
													<span class="text-danger">Something is wrong, please see the following error messages:<br>
														<?php
														foreach ($results as $result) {
															echo  $result . "<br>";
														}
														?>
													</span>

												<?php
												}
												?>
												<br>
												<span class="text-info">Please check the following URLs look correct and adjust the root URL above if they do not.</span><br>
												<span class="text-info">Forwarded request URL: <?php echo $GLOBALS['panelroot']; ?>forward/</span><br>
												<span class="text-info">Proxied request URL: <?php echo $GLOBALS['panelroot']; ?>proxy/</span>
											<?php
												unset($_SESSION['rewrite_results']);
											}
											?>

										</div>
										<div class="text-center">
											<button name="checkrewrites" type="submit" class="btn btn-lg bg-gradient-secondary btn-lg w-100 mt-4 mb-0">Check Forwarding/Proxying Config</button>
										</div>
									</form>
								</div>

							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>