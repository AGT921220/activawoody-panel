  <div class="row mb-4">
  	<div class="col-lg-12 col-md-12 mb-md-0">
  		<div class="card">
  			<div class="card-header pb-0">
  				<div class="row">
  					<div class="col-lg-6 col-7">
  						<h6>XCIPTV Player Settings</h6>
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
  										<div class="input-group input-group-outline mb-3 is-filled">
  											<label class="form-label">EXO - Set Buffer Size</label>
  											<select class="form-control" id="select" name="exo_buffer">
  												<option value="10000" <?php echo $xciptvInfo['exo_buffer'] == "10000" ? "selected" : ""; ?>>10 Seconds</option>
  												<option value="20000" <?php echo $xciptvInfo['exo_buffer'] == "20000" ? "selected" : ""; ?>>20 Seconds</option>
  												<option value="30000" <?php echo $xciptvInfo['exo_buffer'] == "30000" ? "selected" : ""; ?>>30 Seconds</option>
  												<option value="40000" <?php echo $xciptvInfo['exo_buffer'] == "40000" ? "selected" : ""; ?>>40 Seconds</option>
  												<option value="50000" <?php echo $xciptvInfo['exo_buffer'] == "50000" ? "selected" : ""; ?>>50 Seconds</option>
  											</select>
  										</div>
  										<div class="input-group input-group-outline mb-3 is-filled">
  											<label class="form-label">EXO - Set Zoom Level</label>
  											<select class="form-control" id="select" name="exo_zoom">
  												<option value="0" <?php echo $xciptvInfo['exo_zoom'] == "0" ? "selected" : ""; ?>>Best Fit</option>
  												<option value="1" <?php echo $xciptvInfo['exo_zoom'] == "1" ? "selected" : ""; ?>>Fixed Height</option>
  												<option value="2" <?php echo $xciptvInfo['exo_zoom'] == "2" ? "selected" : ""; ?>>Fixed Width</option>
  												<option value="3" <?php echo $xciptvInfo['exo_zoom'] == "3" ? "selected" : ""; ?>>Fill</option>
  												<option value="4" <?php echo $xciptvInfo['exo_zoom'] == "4" ? "selected" : ""; ?>>Zoom</option>
  											</select>
  										</div>
  										<div class="input-group input-group-outline mb-3 is-filled">
  											<label class="form-label">EXO - Set Default Volume</label>
  											<select class="form-control" id="select" name="exo_volume">
  												<option value="60" <?php echo $xciptvInfo['exo_volume'] == "60" ? "selected" : ""; ?>>60%</option>
  												<option value="70" <?php echo $xciptvInfo['exo_volume'] == "70" ? "selected" : ""; ?>>70%</option>
  												<option value="80" <?php echo $xciptvInfo['exo_volume'] == "80" ? "selected" : ""; ?>>80%</option>
  												<option value="90" <?php echo $xciptvInfo['exo_volume'] == "90" ? "selected" : ""; ?>>90%</option>
  												<option value="100" <?php echo $xciptvInfo['exo_volume'] == "100" ? "selected" : ""; ?>>100%</option>
  											</select>
  										</div>
  										<div class="form-check form-switch d-flex align-items-center mb-3">
  											<input class="form-check-input" type="checkbox" id="exo_hw" name="exo_hw" <?php echo $xciptvInfo['exo_hw'] ? "Checked" : ""; ?>>
  											<label class="form-check-label mb-0 ms-3" for="exo_hw">EXO - Hardware Decoder Enabled</label>
  										</div>
  										<div class="form-check form-switch d-flex align-items-center mb-3">
  											<input class="form-check-input" type="checkbox" id="exo_subtitles" name="exo_subtitles" <?php echo $xciptvInfo['exo_subtitles'] ? "Checked" : ""; ?>>
  											<label class="form-check-label mb-0 ms-3" for="exo_subtitles">EXO - Enable Subtitles</label>
  										</div>
  										<hr />
  										<div class="input-group input-group-outline mb-3 is-filled">
  											<label class="form-label">VLC - Set Buffer Size</label>
  											<select class="form-control" id="select" name="vlc_buffer">
  												<option value="300" <?php echo $xciptvInfo['vlc_buffer'] == "300" ? "selected" : ""; ?>>300 Miliseconds</option>
  												<option value="1000" <?php echo $xciptvInfo['vlc_buffer'] == "1000" ? "selected" : ""; ?>>1 Second</option>
  												<option value="2000" <?php echo $xciptvInfo['vlc_buffer'] == "2000" ? "selected" : ""; ?>>2 Seconds</option>
  												<option value="3000" <?php echo $xciptvInfo['vlc_buffer'] == "3000" ? "selected" : ""; ?>>3 Seconds</option>
  												<option value="5000" <?php echo $xciptvInfo['vlc_buffer'] == "5000" ? "selected" : ""; ?>>5 Seconds</option>
  											</select>
  										</div>
  										<div class="input-group input-group-outline mb-3 is-filled">
  											<label class="form-label">VLC - Set Zoom Level</label>
  											<select class="form-control" id="select" name="vlc_zoom">
  												<option value="0" <?php echo $xciptvInfo['vlc_zoom'] == "0" ? "selected" : ""; ?>>Best Fit</option>
  												<option value="1" <?php echo $xciptvInfo['vlc_zoom'] == "1" ? "selected" : ""; ?>>Fixed Height</option>
  												<option value="2" <?php echo $xciptvInfo['vlc_zoom'] == "2" ? "selected" : ""; ?>>Fixed Width</option>
  												<option value="3" <?php echo $xciptvInfo['vlc_zoom'] == "3" ? "selected" : ""; ?>>Fill</option>
  												<option value="4" <?php echo $xciptvInfo['vlc_zoom'] == "4" ? "selected" : ""; ?>>Zoom</option>
  											</select>
  										</div>
  										<div class="input-group input-group-outline mb-3 is-filled">
  											<label class="form-label">VLC - Set Default Volume</label>
  											<select class="form-control" id="select" name="vlc_volume">
  												<option value="60" <?php echo $xciptvInfo['vlc_volume'] == "60" ? "selected" : ""; ?>>60%</option>
  												<option value="70" <?php echo $xciptvInfo['vlc_volume'] == "70" ? "selected" : ""; ?>>70%</option>
  												<option value="80" <?php echo $xciptvInfo['vlc_volume'] == "80" ? "selected" : ""; ?>>80%</option>
  												<option value="90" <?php echo $xciptvInfo['vlc_volume'] == "90" ? "selected" : ""; ?>>90%</option>
  												<option value="100" <?php echo $xciptvInfo['vlc_volume'] == "100" ? "selected" : ""; ?>>100%</option>
  											</select>
  										</div>
  										<div class="form-check form-switch d-flex align-items-center mb-3">
  											<input class="form-check-input" type="checkbox" id="vlc_hw" name="vlc_hw" <?php echo $xciptvInfo['vlc_hw'] ? "Checked" : ""; ?>>
  											<label class="form-check-label mb-0 ms-3" for="vlc_hw">VLC - Hardware Decoder Enabled</label>
  										</div>
  										<div class="form-check form-switch d-flex align-items-center mb-3">
  											<input class="form-check-input" type="checkbox" id="vlc_subtitles" name="vlc_subtitles" <?php echo $xciptvInfo['vlc_subtitles'] ? "Checked" : ""; ?>>
  											<label class="form-check-label mb-0 ms-3" for="vlc_subtitles">VLC - Enable Subtitles</label>
  										</div>
  										<hr />

  										<div class="input-group input-group-outline mb-3 is-filled">
  											<label class="form-label">Live video player</label>
  											<select class="form-control" id="select" name="player_live">
  												<option value="EXO" <?php echo $xciptvInfo['player_live'] == "EXO" ? "selected" : ""; ?>>EXO Player</option>
  												<option value="VLC" <?php echo $xciptvInfo['player_live'] == "VLC" ? "selected" : ""; ?>>VLC Player</option>
  											</select>
  										</div>

  										<div class="input-group input-group-outline mb-3 is-filled">
  											<label class="form-label">EPG video player</label>
  											<select class="form-control" id="select" name="player_epg">
  												<option value="EXO" <?php echo $xciptvInfo['player_epg'] == "EXO" ? "selected" : ""; ?>>EXO Player</option>
  												<option value="VLC" <?php echo $xciptvInfo['player_epg'] == "VLC" ? "selected" : ""; ?>>VLC Player</option>
  											</select>
  										</div>

  										<div class="input-group input-group-outline mb-3 is-filled">
  											<label class="form-label">VOD video player</label>
  											<select class="form-control" id="select" name="player_vod">
  												<option value="EXO" <?php echo $xciptvInfo['player_vod'] == "EXO" ? "selected" : ""; ?>>EXO Player</option>
  												<option value="VLC" <?php echo $xciptvInfo['player_vod'] == "VLC" ? "selected" : ""; ?>>VLC Player</option>
  											</select>
  										</div>
  										<div class="input-group input-group-outline mb-3 is-filled">
  											<label class="form-label">Series video player</label>
  											<select class="form-control" id="select" name="player_series">
  												<option value="EXO" <?php echo $xciptvInfo['player_series'] == "EXO" ? "selected" : ""; ?>>EXO Player</option>
  												<option value="VLC" <?php echo $xciptvInfo['player_series'] == "VLC" ? "selected" : ""; ?>>VLC Player</option>
  											</select>
  										</div>

  										<hr />
  										<div class="text-center">
  											<button name="updatexciptvplayer" type="submit" class="btn btn-lg bg-gradient-secondary btn-lg w-100 mt-4 mb-0">Update</button>
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