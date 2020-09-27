<?php include SITE_ROOT . 'public/default/header.php'; ?>
<?php

$vehicleCategories = array(
	'LUV' => 'LUV',
	'MUV' => 'MUV',
	'SUV' => 'SUV',
	'HUV' => 'HUV'
);

$vehicleClasses = array(
	'sedan' => 'sedan',
	'hatchback' => 'hatchback',
	'crossover' => 'crossover',
	'coupe' => 'coupe'
);

$fuelTypes = array(
	'petrol' => 'petrol',
	'diesel' => 'diesel',
	'CNG - Electric' => 'CNG - Electric',
	'LPG - Hybrid' => 'LPG - Hybrid',
	'Gas Turbine' => 'Gas Turbine'
);

$transmissionTypes = array(
	'CVT' => 'CVT',
	'AMT' => 'AMT',
	'DCT' => 'DCT',
	'DSG' => 'DSG'
);

?>
<div class="container fluid">
	<div class="accordion" id="accordionExample">
		<div class="card">
			<div class="card-header" id="headingOne">
				<h2 class="mb-0">
					<button class="btn btn-block text-left" type="button" data-toggle="collapse"
							data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						<h3>Add Vehicle</h3>
					</button>
				</h2>
			</div>

			<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
				<form class="form-margin" action="<?= SITE_URL ?>lib/scripts/create-vehicle.php" method="post">
					<h4 class="text-center">Enter Details</h4>
					<div id="row-1" class="form-row">
						<div class="form-group col-md-6">
							<input type="text" class="form-control" id="vehicleName" name="vehicleName"
								   placeholder="Vehicle Name"
								   autofocus required/>
						</div>
						<div class="form-group col-md-6">
							<input type="text" class="form-control" id="vehicleModel"
								   name="vehicleModel" placeholder="Vehicle Model"
								   autofocus required/>
						</div>
					</div>
					<div id="row-2" class="form-row">
						<div class="form-group col-md-6">
							<select class="form-control" id="vehicleCategory"
									name="vehicleCategory"
									required>
								<optgroup label="This is a group">
									<option selected>Select Category</option>
									<?php foreach ($vehicleCategories as $key => $value) : ?>
										<option value="<?= $key ?>"><?= $value ?></option>
									<?php endforeach ?>
								</optgroup>
							</select>
						</div>
						<div class="form-group col-md-6">
							<select class="form-control" id="vehicleClass"
									name="vehicleClass"
									required>
								<optgroup label="This is a group">
									<option selected>Select Class</option>
									<?php foreach ($vehicleClasses as $key => $value) : ?>
										<option value="<?= $key ?>"><?= $value ?></option>
									<?php endforeach ?>
								</optgroup>
							</select>
						</div>
					</div>
					<div id="row-3" class="form-row">
						<div class="form-group col-md-6">
							<input type="number" step="0.01" class="form-control" id="onRoadPrice"
								   name="onRoadPrice" placeholder="On Road Price"
								   required/></div>
						<div class="form-group col-md-6">
							<select class="form-control" id="fuelType" name="fuelType"
									required>
								<optgroup label="This is a group">
									<option selected>Select Fuel Type</option>
									<?php foreach ($fuelTypes as $key => $value) : ?>
										<option value="<?= $key ?>"><?= $value ?></option>
									<?php endforeach ?>
								</optgroup>
							</select>
						</div>
					</div>
					<div id="row-4" class="form-row">
						<div class="form-group col-md-6">
							<input type="number" step="0.01" class="form-control" id="engineCC"
								   name="engineCC"
								   placeholder="Engine CC" required/>
						</div>
						<div class="form-group col-md-6">
							<input type="number" step="0.01" class="form-control" id="mileage"
								   name="mileage"
								   placeholder="Mileage" required/>
						</div>
					</div>
					<div id="row-5" class="form-row">
						<div class="form-group col-md-6"><input type="number" step="0.01" class="form-control"
																id="power"
																name="power"
																placeholder="Power" required/>
						</div>
						<div class="form-group col-md-6">
							<input type="number" step="0.01" class="form-control"
								   id="maintenanceCost"
								   name="maintenanceCost" placeholder="Maintenance Cost"
								   required/>
						</div>
					</div>
					<div id="row-6" class="form-row">
						<div class="form-group col-md-6">
							<input type="number" step="0.01" class="form-control" id="fuelTankCapacity"
								   name="fuelTankCapacity" placeholder="Fuel Tank Capacity"
								   required/>
						</div>
						<div class="form-group col-md-6">
							<input type="number" class="form-control" id="seatingCapacity"
								   name="seatingCapacity" placeholder="Seating Capacity"
								   required/>
						</div>
					</div>
					<div class="text-center form-row" id="row-8">
						<div class="form-group col-md">
							<select class="form-control" id="transmissionType"
									name="transmissionType"
									required>
								<optgroup label="This is a group">
									<option selected>Select Transmission Type</option>
									<?php foreach ($transmissionTypes as $key => $value) : ?>
										<option value="<?= $key ?>"><?= $value ?></option>
									<?php endforeach ?>
								</optgroup>
							</select>
						</div>
						<div class="form-group col-md">
							<button type="button" class="btn btn-dark btn-block" data-toggle="modal"
									data-target="#chooseColor">
								Choose Colors
							</button>

							<!-- Modal -->
							<div class="modal fade" id="chooseColor" data-backdrop="static"
								 data-keyboard="false" tabindex="-1" aria-labelledby="chooseColorLabel"
								 aria-hidden="true">
								<div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="chooseColorTitle">Choose Colors</h5>
											<button type="button" class="close" data-dismiss="modal"
													aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<?php if (isset($availableColors)) : ?>
												<?php foreach ($availableColors as $color): ?>
													<label for="<?= $color->colorID ?>"><?php echo ucfirst($color->color); ?></label>
													<input type="checkbox"
														   name="colors[]"
														   id="<?= $color->colorID ?>"
														   value=<?= $color->colorID ?>><br>
												<?php endforeach ?>
											<?php endif ?>
										</div>
										<div class="modal-body">
											If not not listed, update after adding Vehicle
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary" data-dismiss="modal">Okay
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="row-7" class="form-row">
						<div class="form-group col-md-6">
							<div class="form-check text-left">
								<input type="checkbox" class="form-check-input" value=1 id="insurance"
									   name="insurance"/>
								<label class="form-check-label" for="insurance">Insurance</label>
							</div>
						</div>
						<div class="form-group col-md-6">
							<div class="form-check text-left">
								<input type="checkbox" class="form-check-input" value=1 id="emiAvailable"
									   name="emiAvailable"/>
								<label class="form-check-label" for="emiAvailable">EMI Available</label>
							</div>
						</div>
					</div>
					<div class="text-center">
						<button class="btn btn-primary" type="submit">Add Vehicle</button>
					</div>
				</form>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingTwo">
				<h2 class="mb-0">
					<button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
							data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						<h3>List Vehicles</h3>
					</button>
				</h2>
			</div>
			<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
				<div class="table-responsive">
					<table class="table">
						<thead>
						<tr>
							<th>SL No.</th>
							<th>Manufacturer Name</th>
							<th>Vehicle Name</th>
							<th>Model</th>
							<th>Price</th>
							<th>Mileage</th>
							<th>Color Variants</th>
						</tr>
						</thead>
						<tbody>
						<?php if (isset($vehicleResults)) : ?>
							<?php $i = 0;
							$dbV = new Database();
							foreach ($vehicleResults as $vehicle) : ?>
								<tr>
									<td><?= ++$i ?></td>
									<td><?= $vehicle->manufacturerName ?></td>
									<td><?= $vehicle->vehicleName ?></td>
									<td><?= $vehicle->vehicleModel ?></td>
									<td><?= $vehicle->onRoadPrice ?></td>
									<td><?= $vehicle->mileage ?></td>
									<td>
										<?php
										$dbV->query("SELECT cr.color from tb_colors as cr INNER JOIN tbr_colorVariants as crv ON cr.colorID = crv.colorID INNER JOIN tb_vehicles tv on crv.vehicleID = tv.vehicleID");
										$vehicleColors = $dbV->fetchMultipleResults();
										?>
										<?php foreach ($vehicleColors as $color) : ?>
											<?= $color->color ?><br>
										<?php endforeach ?>
										<br>
										<button type="button" class="btn btn-dark btn-block" data-toggle="modal"
												data-target="#addColor">
											Add Colors
										</button>

										<!-- Modal -->
										<div class="modal fade" id="addColor" data-backdrop="static"
											 data-keyboard="false" tabindex="-1" aria-labelledby="addColorLabel"
											 aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="addColorTitle">Add Colors</h5>
														<button type="button" class="close" data-dismiss="modal"
																aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<form method="post"
														  action="<?= SITE_URL . 'lib/scripts/add-color.php' ?>">
														<div class="modal-body">
															<div class="form-group col-md-6">
																<label for="vehicleColor">Color Name:</label>
																<input
																		type="text" class="form-control"
																		id="vehicleColor"
																		name="vehicleColor"
																		autofocus required
																/>
															</div>
														</div>

														<div class="modal-footer">
															<button type="submit" name="vehicleID"
																	value="<?= $vehicle->vehicleID ?>"
																	class="btn btn-primary">Add
															</button>
															<button type="button" class="btn btn-danger"
																	data-dismiss="modal">Cancel
															</button>
														</div>
													</form>
												</div>
											</div>
										</div>
									</td>
								</tr>
							<?php endforeach ?>
						<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include SITE_ROOT . 'public/default/footer.php'; ?>
