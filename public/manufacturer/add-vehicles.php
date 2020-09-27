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
						<div class="form-group col-md-6"><input type="number" step="0.01" class="form-control" id="power"
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
					</div>
					<div id="row-7" class="form-row">
						<div class="form-group col-md-6">
							<div class="form-check text-left">
								<input type="checkbox" class="form-check-input" id="insurance" name="insurance" value=1 />
								<label class="form-check-label" for="insurance">Insurance</label>
							</div>
						</div>
						<div class="form-group col-md-6">
							<div class="form-check text-left">
								<input type="checkbox" class="form-check-input" id="emiAvailable" name="emiAvailable" value=1 />
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
						</tr>
						</thead>
						<tbody>
						<?php if (isset($vehicleResults)) : ?>
						<?php $i = 0;
						foreach ($vehicleResults

						as $vehicle) : ?>
						<tr>
							<td><?= ++$i ?></td>
							<td><?= $vehicle->manufacturerName ?></td>
							<td><?= $vehicle->vehicleName ?></td>
							<td><?= $vehicle->vehicleModel ?></td>
							<td><?= $vehicle->onRoadPrice ?></td>
							<td><?= $vehicle->mileage ?></td>
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
