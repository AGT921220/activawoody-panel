<div class="row mb-4">
  <div class="col-lg-12 col-md-12 mb-md-0">
    <div class="card">
      <div class="card-header pb-0">
        <div class="row">
          <div class="col-lg-6 col-7">
            <h6>VPN</h6>
          </div>
          <div class="col-6 text-end">
            <a href="dashboard.php?vpn-add">
              <button class="btn btn-success btn-sm mb-0">Add New</button>
            </a>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pb-2">
        <div class="container">
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-12">
              <div class="card card-plain">
                <div class="card-body">
                  <div class="table-responsive p-0">
                    <table class="table align-items-center justify-content-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Location</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Country</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Path</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Auth Type</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Password</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                          <th style="width:50px;"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($vpnInfo as $thisVpn) {
                        ?>
                          <tr>
                            <td>
                              <div class="d-flex px-2">
                                <div class="my-auto">
                                  <h6 class="mb-0 text-sm"><?php echo $thisVpn['location']; ?></h6>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex px-2">
                                <div class="my-auto">
                                  <h6 class="mb-0 text-sm"><?php echo $thisVpn['country']; ?></h6>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex px-2">
                                <div class="my-auto">
                                  <h6 class="mb-0 text-sm"><?php echo $thisVpn['path']; ?></h6>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex px-2">
                                <div class="my-auto">
                                  <h6 class="mb-0 text-sm"><?php echo $thisVpn['auth_type']; ?></h6>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex px-2">
                                <div class="my-auto">
                                  <h6 class="mb-0 text-sm"><?php echo $thisVpn['username']; ?></h6>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex px-2">
                                <div class="my-auto">
                                  <h6 class="mb-0 text-sm"><?php echo $thisVpn['password']; ?></h6>
                                </div>
                              </div>
                            </td>
                            <?php
                            if ($thisVpn['active'] == "1") {
                              $statusString = "Active";
                              $statusClass = "text-success";
                            } else {
                              $statusString = "Disabled";
                              $statusClass = "text-danger";
                            }
                            ?>
                            <td>
                              <span class="text-xs font-weight-bold <?php echo $statusClass; ?>"><?php echo $statusString; ?></span>
                            </td>

                            <td class="align-right">
                              <a href="dashboard.php?vpn-edit&id=<?php echo $thisVpn['id']; ?>">
                                <button title="Edit" class="btn btn-link text-secondary mb-0">
                                  <i class="fa fa-ellipsis-v text-xs"></i>
                                </button>
                              </a>
                              <a onclick="return confirm('Are you sure?');" href="action.php?vpn-delete&id=<?php echo $thisVpn['id']; ?>">
                                <button title="Delete" class="btn btn-link text-secondary mb-0">
                                  <i class="fa fa-times text-xs text-danger"></i>
                                </button>
                              </a>
                            </td>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>