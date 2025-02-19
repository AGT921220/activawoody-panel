<div class="row mb-4">
    <div class="col-lg-12 col-md-12 mb-md-0">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Sports Guide Settings</h6>
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
                                        <div class="d-flex flex-column" style="text-align:center;">
                                            <span style="vertical-align:middle;"><i class="material-icons opacity-10" style="font-size:40px;vertical-align:middle;">info</i>&nbsp;Register at https://www.tvsportguide.com/page/widget/ and get your Widget URL. The API Key is the key embedded in your URL.<br>e.g. https://www.tvsportguide.com/widget/<b>1a2b3c4567890</b>?filter_mode=all&filter_value</span>
                                        </div>
                                    </div>
                                    <form action="action.php" method="post" role="form">
                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">API Key</label>
                                            <input name="api_key" type="text" class="form-control" value="<?php echo $sportsInfo['api_key'] ?>">
                                        </div>
                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Header Name</label>
                                            <input name="header_name" type="text" class="form-control" value="<?php echo $sportsInfo['header_name'] ?>">
                                        </div>
                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Border Colour</label>
                                            <input name="border_colour" type="color" class="form-control" value="<?php echo $sportsInfo['border_colour'] ?>">
                                        </div>
                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Background Colour</label>
                                            <input name="background_colour" type="color" class="form-control" value="<?php echo $sportsInfo['background_colour'] ?>">
                                        </div>
                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Text Colour</label>
                                            <input name="text_colour" type="color" class="form-control" value="<?php echo $sportsInfo['text_colour'] ?>">
                                        </div>
                                        <div class="text-center">
                                            <button name="updatesports" type="submit" class="btn btn-lg bg-gradient-secondary btn-lg w-100 mt-4 mb-0">Update</button>
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