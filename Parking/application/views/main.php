<div class="text-center" ng-controller="parking">
	<div class="row">
		<div class="col-lg-4 text-left">
			<div ng-hide="isMainPage">
				<img ng-src="{{parkings[parkingID].image}}" alt="" title="" class="img-rounded" height="100px" ng-show="isPlacesPage" />
				<a class="btn btn-default" ng-click="setPage()">Powrót</a>
			</div>
		</div>
		<div class="col-lg-4">
			<h1>System rezerwacji<br />miejsc parkingowych</h1>
		</div>
		<div class="col-lg-4 text-right">
			<div ng-show="user.id > 0">
				Witaj {{user.email}}
				<a class="btn btn-primary" style="margin-left: 10px;" ng-click="setPage('user_config');"><i class="fa fa-cog"></i> Ustawienia</a>
				<a class="btn btn-info" style="margin-left: 10px;" ng-click="logout();">Wyloguj</a>
			</div>
			<a class="btn btn-info" ng-hide="user" ng-href="user">Zaloguj</a>
		</div>
	</div>
	<ng-view></ng-view>
</div>