<div style="margin-top: 30px;">
	<div class="col col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading" style="padding: 5px;">Zmiana hasła</div>
			<div class="panel-body">
				<form class="form-inline">
					<div class="form-group">
						<label for="password">Nowe hasło:</label>
						<input type="password" ng-model="password" class="form-control" />
					</div>
					<button class="btn btn-default" ng-click="changePassword(password)">Zmień hasło</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading" style="padding: 5px;">Numery rejestracyjne</div>
			<div class="panel-body">
				<form class="form-inline">
					<div class="form-group">
						<select class="form-control" name="numbers" ng-model="selectPlate" ng-options="plate as plate.number for plate in user.plates" ng-init="selectPlate = user.plates[0]" style="color: black; font-weight: bold;"></select>
					</div><br /><br />
					<input type="text" name="text" class="form-control" ng-model="selectPlate.number" maxlength="8" style="color: black; font-weight: bold;" />
					<br /><br />
					<button type="submit" class="btn btn-info" ng-click="changePlate(selectPlate)">Zmień</button>
					<button type="submit" class="btn btn-success" ng-click="addPlate(selectPlate.number)">Dodaj</button>
					<button type="submit" class="btn btn-danger" ng-click="removePlate(selectPlate)">Usuń</button>
				</form>
			</div>
		</div>
	</div>
</div>