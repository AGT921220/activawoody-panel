<div class="row mb-4">
    <div class="col-lg-12 col-md-12 mb-md-0">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Purple Interface Settings</h6>
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
                                            <span style="vertical-align:middle;"><i class="material-icons opacity-10" style="font-size:40px;vertical-align:middle;">info</i>&nbsp;APK should be modified to point to <?php echo $GLOBALS['panelroot']; ?>purple/12/</span>
                                        </div>
                                    </div>
                                    <form action="action.php" method="post" role="form">
                                        <div class="form-check form-switch d-flex align-items-center mb-3">
                                            <input class="form-check-input" type="checkbox" id="app_img" name="app_img" <?php echo $purpleInfo['app_img'] ? "Checked" : ""; ?>>
                                            <label class="form-check-label mb-0 ms-3" for="app_img">Custom App Images (Add URLs below if checked)</label>
                                        </div>
                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">App Logo</label>
                                            <input name="app_logo" type="text" class="form-control" value="<?php echo $purpleInfo['app_logo'] ?>">
                                        </div>
                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Mobile Icon</label>
                                            <input name="app_mobile_icon" type="text" class="form-control" value="<?php echo $purpleInfo['app_mobile_icon'] ?>">
                                        </div>
                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">TV Banner</label>
                                            <input name="app_tv_banner" type="text" class="form-control" value="<?php echo $purpleInfo['app_tv_banner'] ?>">
                                        </div>
                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Splash Image</label>
                                            <input name="splash_image" type="text" class="form-control" value="<?php echo $purpleInfo['splash_image'] ?>">
                                        </div>
                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Background Image</label>
                                            <input name="back_image" type="text" class="form-control" value="<?php echo $purpleInfo['back_image'] ?>">
                                        </div>
                                        <hr/>
                                        ---------------------------------------------------------------------
                                        <hr/>
        
                                        <div class="form-check form-switch d-flex align-items-center mb-3">
                                            <input class="form-check-input" type="checkbox" id="background_auto_change" name="background_auto_change" <?php echo $purpleInfo['background_auto_change'] ? "Checked" : ""; ?>>
                                            <label class="form-check-label mb-0 ms-3" for="background_auto_change">Background Auto Change</label>
                                        </div>
                                        <div class="form-check form-switch d-flex align-items-center mb-3">
                                            <input class="form-check-input" type="checkbox" id="background_mannual_change" name="background_mannual_change" <?php echo $purpleInfo['background_mannual_change'] ? "Checked" : ""; ?>>
                                            <label class="form-check-label mb-0 ms-3" for="background_mannual_change">Background Manual Change</label>
                                        </div>
										 <div class="form-check form-switch d-flex align-items-center mb-3">
                                            <input class="form-check-input" type="checkbox" id="background_orverlay_enable" name="background_orverlay_enable" <?php echo $purpleInfo['background_orverlay_color_code'] ? "Checked" : ""; ?>>
                                            <label class="form-check-label mb-0 ms-3" for="background_orverlay_enable">Enable Background Overlay</label>
                                        </div>
                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Background Overlay Colour</label>
                                            <input name="background_orverlay_color_code" type="color" class="form-control" value="<?php echo $purpleInfo['background_orverlay_color_code'] ?>">
                                        </div>
                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Background Image 1</label>
                                            <input name="background_url1" type="text" class="form-control" value="<?php echo $purpleInfo['background_url1'] ?>">
                                        </div>
                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Background Image 2</label>
                                            <input name="background_url2" type="text" class="form-control" value="<?php echo $purpleInfo['background_url2'] ?>">
                                        </div>
                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Background Image 3</label>
                                            <input name="background_url3" type="text" class="form-control" value="<?php echo $purpleInfo['background_url3'] ?>">
                                        </div>
                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Background Image 4</label>
                                            <input name="background_url4" type="text" class="form-control" value="<?php echo $purpleInfo['background_url4'] ?>">
                                        </div>
                                    
                                        <hr />
                                        <div class="text-center">
                                            <button name="updatepurpleinterface" type="submit" class="btn btn-lg bg-gradient-secondary btn-lg w-100 mt-4 mb-0">Update</button>
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