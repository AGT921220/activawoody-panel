<div class="row mb-4">
	<div class="col-lg-12 col-md-12 mb-md-0">
		<div class="card">
			<div class="card-header pb-0">
				<div class="row">
					<div class="col-lg-6 col-7">
						<h6>Messages</h6>
					</div>
					<div class="col-6 text-end">
						<a href="dashboard.php?message-add">
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
													<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Text</th>
													<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
													<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
													<th style="width:50px;"></th>
												</tr>
											</thead>
											<tbody>
												<?php
												foreach ($messageInfo as $thisMessage) {
												?>
													<tr>
														<td>
															<div class="d-flex px-2">
																<div class="my-auto">
																	<h6 class="mb-0 text-sm"><?php echo $thisMessage['text']; ?></h6>
																</div>
															</div>
														</td>
														<td>
															<div class="d-flex px-2">
																<div class="my-auto">
																	<h6 class="mb-0 text-sm"><?php echo $thisMessage['user']; ?></h6>
																</div>
															</div>
														</td>
														<?php
														if ($thisMessage['active'] == "1") {
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
															<a href="dashboard.php?message-edit&id=<?php echo $thisMessage['id']; ?>">
																<button title="Edit" class="btn btn-link text-secondary mb-0">
																	<i class="fa fa-ellipsis-v text-xs"></i>
																</button>
															</a>
															<a onclick="return confirm('Are you sure?');" href="action.php?message-delete&id=<?php echo $thisMessage['id']; ?>">
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