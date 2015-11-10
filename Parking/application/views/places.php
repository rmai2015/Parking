<div>
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Nr miejsca</td>
				<th>Stan</td>
				<th ng-show="user && !isAdmin()">Rezerwacja</th>
				<th ng-show="isAdmin()">Opcje</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-class="{danger: place.state == 1, success: place.state == 0, warning: place.state == 2}" ng-repeat="place in places">
				<td ng-bind="place.place"></td>
				<td ng-show="place.state == 1">Zajęte</td>
				<td ng-show="place.state == 0">Wolne</td>
				<td ng-show="place.state == 2">Zarezerwowane <span ng-show="isAdmin()">przez {{getPlate(place).number}}<span></td>
				<td ng-show="user">
					<button class="btn btn-success" ng-click="release(place)" ng-show="isAdmin()">Zwolnij</button>
					<button class="btn btn-warning" ng-click="reserv(place, selectPlate)" ng-disabled="!canReserv">Zarezerwuj</button>
					<button class="btn btn-danger" ng-click="occupy(place)" ng-show="isAdmin()">Zajmij</button>
				</td>
			</tr>
		</tbody>
	</table>
	<div ng-show="canReserv && user" style="font-size: 1.5em;">
		Rezerwuj jako: <select ng-model="selectPlate" ng-options="plate as plate.number for plate in user.plates" style="color: black; font-weight: bold;" ng-init="selectPlate = user.plates[0];"></select>
	</div>
</div>