<div class="row mb-4">
	<div class="col-lg-12 col-md-12 mb-md-0">
		<div class="card">
			<div class="card-header pb-0">
				<div class="row">
					<div class="col-lg-6 col-7">
						<h6>Manage Messages</h6>
					</div>
					<?php
					$activeChecked = "";
					if ($messageEditInfo['active'] == "1") {
						$activeChecked = "checked";
					}

					?>
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
											<label class="form-label">Text</label>
											<input name="id" type="hidden" value="<?php echo $messageEditInfo['id'] ?>" />
											<input name="text" type="text" class="form-control" value="<?php echo $messageEditInfo['text'] ?>">
										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">User (Leave blank for all users)</label>
											<input name="user" type="text" class="form-control" value="<?php echo $messageEditInfo['user'] ?>">
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="active" name="active" <?php echo $activeChecked; ?>>
											<label class="form-check-label mb-0 ms-3" for="active">Active</label>
										</div>
										<div class="text-center">
											<button name="updatemessage" type="submit" class="btn btn-lg bg-gradient-secondary btn-lg w-100 mt-4 mb-0">Update</button>
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