<div class="row mb-4">
	<div class="col-lg-12 col-md-12 mb-md-0">
		<div class="card">
			<div class="card-header pb-0">
				<div class="row">
					<div class="col-lg-6 col-7">
						<h6>XCIPTV App Settings</h6>
					</div>

					<?php
					$loginAccountButtonChecked = "";
					if ($xciptvInfo['login_accounts_button'] == "1") {
						$loginAccountButtonChecked = "checked";
					}
					$loginSettingsButtonChecked = "";
					if ($xciptvInfo['log_settings_button'] == "1") {
						$loginSettingsButtonChecked = "checked";
					}
					$announcementsChecked = "";
					if ($xciptvInfo['announcements'] == "1") {
						$announcementsChecked = "checked";
					}
					$messagesChecked = "";
					if ($xciptvInfo['messages'] == "1") {
						$messagesChecked = "checked";
					}

					$update_user_infoChecked = "";
					if ($xciptvInfo['update_user_info'] == "1") {
						$update_user_infoChecked = "checked";
					}
					$login_logoChecked = $xciptvInfo['update_user_info'] ? "Checked" : "";
					$app_logsChecked = $xciptvInfo['app_logs'] ? "Checked" : "";
					$category_countChecked = $xciptvInfo['category_count'] ? "Checked" : "";
					$load_last_channelChecked = $xciptvInfo['load_last_channel'] ? "Checked" : "";
					?>
				</div>
			</div>
			<div class="card-body px-0 pb-2">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-12">
							<div class="card card-plain">
								<div class="card-body">
								<div class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg" style=" align-items: center;justify-content: center;">
										<div class="d-flex flex-column">
											<span style="vertical-align:middle;"><i class="material-icons opacity-10" style="font-size:40px;vertical-align:middle;">info</i>&nbsp;APK should be modified to point to <?php echo $GLOBALS['panelroot']; ?>xciptv/</span>
										</div>
									</div>
									<form action="action.php" method="post" role="form">
										<div class="input-group input-group-outline mb-3 is-filled">
  											<label class="form-label">DNS Setting</label>
  											<select class="form-control" id="select" name="proxy_traffic">
  												<option value="0" <?php echo $xciptvInfo['proxy_traffic'] == "0" ? "selected" : ""; ?>>Send DNS directly to app</option>
  												<option value="1" <?php echo $xciptvInfo['proxy_traffic'] == "1" ? "selected" : ""; ?>>Proxy DNS through panel</option>
  											</select>
  										</div>
										  <div class="input-group input-group-outline mb-3 is-filled">
  											<label class="form-label">LicV4 Setting (Try all options if your LicV4 XCIPTV is crashing when opening or will not log in)</label>
  											<select class="form-control" id="select" name="licv4_method">
  												<option value="1" <?php echo $xciptvInfo['licv4_method'] == "1" ? "selected" : ""; ?>>Object</option>
  												<option value="2" <?php echo $xciptvInfo['licv4_method'] == "2" ? "selected" : ""; ?>>String</option>
  												<option value="3" <?php echo $xciptvInfo['licv4_method'] == "3" ? "selected" : ""; ?>>Encrypted String</option>
  											</select>
  										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">App Name</label>
											<input name="app_name" type="text" class="form-control" value="<?php echo $xciptvInfo['app_name'] ?>">
										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">App Build</label>
											<input name="app_build" type="text" class="form-control" value="<?php echo $xciptvInfo['app_build'] ?>">
										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">App Identifier</label>
											<input name="app_identifier" type="text" class="form-control" value="<?php echo $xciptvInfo['app_identifier'] ?>">
										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">Support Phone No</label>
											<input name="support_phone" type="text" class="form-control" value="<?php echo $xciptvInfo['support_phone'] ?>">
										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">Support Email</label>
											<input name="support_email" type="text" class="form-control" value="<?php echo $xciptvInfo['support_email'] ?>">
										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">Login Type</label>
											<select name="login_type" class="form-control">
												<option value="login" selected="">XC Login</option>
												<option value="mac">MAC Address</option>
												<option value="activation">Activiation Code</option>
											</select>
										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">Language</label>
										<select class="form-control" id="select" name="app_language">
											<option value="en" <?=$xciptvInfo['app_language']=='en'?'selected':'' ?>>English</option>
											<option value="ar" <?=$xciptvInfo['app_language']=='ar'?'selected':'' ?>>Arabic</option>
											<option value="bn" <?=$xciptvInfo['app_language']=='bn'?'selected':'' ?>>Bengali</option>
											<option value="zh" <?=$xciptvInfo['app_language']=='zh'?'selected':'' ?>>Chinese</option>
											<option value="fr" <?=$xciptvInfo['app_language']=='fr'?'selected':'' ?>>French</option>
											<option value="hi" <?=$xciptvInfo['app_language']=='hi'?'selected':'' ?>>Hindi</option>
											<option value="it" <?=$xciptvInfo['app_language']=='it'?'selected':'' ?>>Italian</option>
											<option value="ml" <?=$xciptvInfo['app_language']=='ml'?'selected':'' ?>>Malayalam</option>
											<option value="pt" <?=$xciptvInfo['app_language']=='pt'?'selected':'' ?>>Portugese</option>
											<option value="es" <?=$xciptvInfo['app_language']=='es'?'selected':'' ?>>Spanish</option>
											<option value="ru" <?=$xciptvInfo['app_language']=='ru'?'selected':'' ?>>Russian</option>
											<option value="sv" <?=$xciptvInfo['app_language']=='sv'?'selected':'' ?>>Swedish</option>
										</select>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="login_accounts_button" name="login_accounts_button" <?php echo $loginAccountButtonChecked; ?>>
											<label class="form-check-label mb-0 ms-3" for="login_accounts_button">Show Account Button At Login</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="log_settings_button" name="log_settings_button" <?php echo $loginSettingsButtonChecked; ?>>
											<label class="form-check-label mb-0 ms-3" for="log_settings_button">Show Settings Button At Login</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="announcements" name="announcements" <?php echo $announcementsChecked; ?>>
											<label class="form-check-label mb-0 ms-3" for="announcements">Announcements Enabled</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="messages" name="messages" <?php echo $messagesChecked; ?>>
											<label class="form-check-label mb-0 ms-3" for="messages">Messages Enabled</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="update_user_info" name="update_user_info" <?php echo $update_user_infoChecked; ?>>
											<label class="form-check-label mb-0 ms-3" for="update_user_info">Update User Info Enabled</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="login_logo" name="login_logo" <?php echo $login_logoChecked; ?>>
											<label class="form-check-label mb-0 ms-3" for="login_logo">Enable Login Logo EPG</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="app_logs" name="app_logs" <?php echo $app_logsChecked; ?>>
											<label class="form-check-label mb-0 ms-3" for="app_logs">Enable Logs</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="category_count" name="category_count" <?php echo $category_countChecked; ?>>
											<label class="form-check-label mb-0 ms-3" for="category_count">Show Category Count</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="load_last_channel" name="load_last_channel" <?php echo $load_last_channelChecked; ?>>
											<label class="form-check-label mb-0 ms-3" for="load_last_channel">Load Last channel</label>
										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">Developer Name</label>
											<input name="developer_name" type="text" class="form-control" value="<?php echo $xciptvInfo['developer_name'] ?>">
										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">Developer Contact</label>
											<input name="developer_contact" type="text" class="form-control" value="<?php echo $xciptvInfo['developer_contact'] ?>">
										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">Sign-up URL</label>
											<input name="signup_url" type="text" class="form-control" value="<?php echo $xciptvInfo['signup_url'] ?>">
										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">User-Agent</label>
											<input name="user_agent" type="text" class="form-control" value="<?php echo $xciptvInfo['user_agent'] ?>">
										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">LicV3 Key</label>
											<input name="licv3_key" type="text" class="form-control" value="<?php echo $xciptvInfo['licv3_key'] ?>">
										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">LicV3 IV</label>
											<input name="licv3_iv" type="text" class="form-control" value="<?php echo $xciptvInfo['licv3_iv'] ?>">
										</div>
										<div class="text-center">
											<button name="updatexciptvapp" type="submit" class="btn btn-lg bg-gradient-secondary btn-lg w-100 mt-4 mb-0">Update</button>
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