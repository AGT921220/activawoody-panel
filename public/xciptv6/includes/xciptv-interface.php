<div class="row mb-4">
	<div class="col-lg-12 col-md-12 mb-md-0">
		<div class="card">
			<div class="card-header pb-0">
				<div class="row">
					<div class="col-lg-6 col-7">
						<h6>XCIPTV Interface Settings</h6>
					</div>
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

										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_live" name="show_live" <?php echo $xciptvInfo['show_live'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_live">Show Live TV (Portal 1)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_live2" name="show_live2" <?php echo $xciptvInfo['show_live2'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_live2">Show Live TV (Portal 2)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_live3" name="show_live3" <?php echo $xciptvInfo['show_live3'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_live3">Show Live TV (Portal 3)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_live4" name="show_live4" <?php echo $xciptvInfo['show_live4'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_live4">Show Live TV (Portal 4)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_live5" name="show_live5" <?php echo $xciptvInfo['show_live5'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_live5">Show Live TV (Portal 5)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_epg" name="show_epg" <?php echo $xciptvInfo['show_epg'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_epg">Show EPG (Portal 1)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_epg2" name="show_epg2" <?php echo $xciptvInfo['show_epg2'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_epg2">Show EPG (Portal 2)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_epg3" name="show_epg3" <?php echo $xciptvInfo['show_epg3'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_epg3">Show EPG (Portal 3)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_epg4" name="show_epg4" <?php echo $xciptvInfo['show_epg4'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_epg4">Show EPG (Portal 4)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_epg5" name="show_epg5" <?php echo $xciptvInfo['show_epg5'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_epg5">Show EPG (Portal 5)</label>
										</div>

										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_vod" name="show_vod" <?php echo $xciptvInfo['show_vod'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_vod">Show VOD (Portal 1)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_vod2" name="show_vod2" <?php echo $xciptvInfo['show_vod2'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_vod2">Show VOD (Portal 2)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_vod3" name="show_vod3" <?php echo $xciptvInfo['show_vod3'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_vod3">Show VOD (Portal 3)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_vod4" name="show_vod4" <?php echo $xciptvInfo['show_vod4'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_vod4">Show VOD (Portal 4)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_vod5" name="show_vod5" <?php echo $xciptvInfo['show_vod5'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_vod5">Show VOD (Portal 5)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_series" name="show_series" <?php echo $xciptvInfo['show_series'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_series">Show Series (Portal 1)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_series2" name="show_series2" <?php echo $xciptvInfo['show_series2'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_series2">Show Series (Portal 2)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_series3" name="show_series3" <?php echo $xciptvInfo['show_series3'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_series3">Show Series (Portal 3)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_series4" name="show_series4" <?php echo $xciptvInfo['show_series4'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_series4">Show Series (Portal 4)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_series5" name="show_series5" <?php echo $xciptvInfo['show_series5'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_series5">Show Series (Portal 5)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_catchup" name="show_catchup" <?php echo $xciptvInfo['show_catchup'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_catchup">Show Catchup (Portal 1)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_catchup2" name="show_catchup2" <?php echo $xciptvInfo['show_catchup2'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_catchup2">Show Catchup (Portal 2)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_catchup3" name="show_catchup3" <?php echo $xciptvInfo['show_catchup3'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_catchup3">Show Catchup (Portal 3)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_catchup4" name="show_catchup4" <?php echo $xciptvInfo['show_catchup4'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_catchup4">Show Catchup (Portal 4)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_catchup5" name="show_catchup5" <?php echo $xciptvInfo['show_catchup5'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_catchup5">Show Catchup (Portal 5)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_radio" name="show_radio" <?php echo $xciptvInfo['show_radio'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_radio">Show Radio (Portal 1)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_radio2" name="show_radio2" <?php echo $xciptvInfo['show_radio2'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_radio2">Show Radio (Portal 2)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_radio3" name="show_radio3" <?php echo $xciptvInfo['show_radio3'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_radio3">Show Radio (Portal 3)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_radio4" name="show_radio4" <?php echo $xciptvInfo['show_radio4'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_radio4">Show Radio (Portal 4)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_radio5" name="show_radio5" <?php echo $xciptvInfo['show_radio5'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_radio5">Show Radio (Portal 5)</label>
										</div>

										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_multi" name="show_multi" <?php echo $xciptvInfo['show_multi'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_multi">Show Multi-Screen (Portal 1)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_multi2" name="show_multi2" <?php echo $xciptvInfo['show_multi2'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_multi2">Show Multi-Screen (Portal 2)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_multi3" name="show_multi3" <?php echo $xciptvInfo['show_multi3'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_multi3">Show Multi-Screen (Portal 3)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_multi4" name="show_multi4" <?php echo $xciptvInfo['show_multi4'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_multi4">Show Multi-Screen (Portal 4)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_multi5" name="show_multi5" <?php echo $xciptvInfo['show_multi5'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_multi5">Show Multi-Screen (Portal 5)</label>
										</div>

										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_favorite" name="show_favorite" <?php echo $xciptvInfo['show_favorite'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_favorite">Show Favourites (Portal 1)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_favorite2" name="show_favorite2" <?php echo $xciptvInfo['show_favorite2'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_favorite2">Show Favourites (Portal 2)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_favorite3" name="show_favorite3" <?php echo $xciptvInfo['show_favorite3'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_favorite3">Show Favourites (Portal 3)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_favorite4" name="show_favorite4" <?php echo $xciptvInfo['show_favorite4'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_favorite4">Show Favourites (Portal 4)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_favorite5" name="show_favorite5" <?php echo $xciptvInfo['show_favorite5'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_favorite5">Show Favourites (Portal 5)</label>
										</div>

										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_account" name="show_account" <?php echo $xciptvInfo['show_account'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_account">Show Account Info (Portal 1)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_account2" name="show_account2" <?php echo $xciptvInfo['show_account2'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_account2">Show Account Info (Portal 2)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_account3" name="show_account3" <?php echo $xciptvInfo['show_account3'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_account3">Show Account Info (Portal 3)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_account4" name="show_account4" <?php echo $xciptvInfo['show_account4'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_account4">Show Account Info (Portal 4)</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_account5" name="show_account5" <?php echo $xciptvInfo['show_account5'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_account5">Show Account Info (Portal 5)</label>
										</div>

										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_record" name="show_record" <?php echo $xciptvInfo['show_record'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_record">Show Recording</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_vpn" name="show_vpn" <?php echo $xciptvInfo['show_vpn'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_vpn">Show VPN</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_message" name="show_message" <?php echo $xciptvInfo['show_message'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_message">Show Messages</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_update" name="show_update" <?php echo $xciptvInfo['show_update'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_update">Show Content Update</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="show_expiry" name="show_expiry" <?php echo $xciptvInfo['show_expiry'] ? "Checked" : ""; ?>>
											<label class="form-check-label mb-0 ms-3" for="show_expiry">Show Sub Expiry Date</label>
										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">Theme</label>
											<select class="form-control" id="select" name="theme">
												<option value="d" <?php echo $xciptvInfo['theme'] == "d" ? "selected" : ""; ?>>Standard</option>
												<option value="1" <?php echo $xciptvInfo['theme'] == "1" ? "selected" : ""; ?>>Theme 1</option>
												<option value="2" <?php echo $xciptvInfo['theme'] == "2" ? "selected" : ""; ?>>Theme 2</option>
												<option value="3" <?php echo $xciptvInfo['theme'] == "3" ? "selected" : ""; ?>>Theme 3</option>
											</select>
										</div>
										<div class="text-center">
											<button name="updatexciptvinterface" type="submit" class="btn btn-lg bg-gradient-secondary btn-lg w-100 mt-4 mb-0">Update</button>
										</div>
									</form>
									<hr />
									<ul class="list-group">
										<li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
											<div class="d-flex flex-column">
												<h6 class="mb-3 ">Standard Theme</h6>
												<img style="width:100%;" src="assets/img/theme-s.jpg" />
											</div>
										</li>
										<li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
											<div class="d-flex flex-column">
												<h6 class="mb-3 ">Theme 1</h6>
												<img style="width:100%;" src="assets/img/theme-1.jpg" />
											</div>
										</li>
										<li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
											<div class="d-flex flex-column">
												<h6 class="mb-3 ">Theme 2</h6>
												<img style="width:100%;" src="assets/img/theme-2.jpg" />
											</div>
										</li>
										<li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
											<div class="d-flex flex-column">
												<h6 class="mb-3 ">Theme 3</h6>
												<img style="width:100%;" src="assets/img/theme-3.jpg" />
											</div>
										</li>

									</ul>
								</div>

							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>