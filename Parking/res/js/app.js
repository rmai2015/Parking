var app = angular.module('app', ['ngRoute']);

app.config( function ( $routeProvider ) {
	$routeProvider
	.when('/', 						{templateUrl: 	'main/parkings'})
	.when('/parking/:parkingID', 	{templateUrl: 	'main/places'})
	.when('/user_config', 			{templateUrl: 	'main/user_config'})
	.otherwise(						{redirectTo:	'/'});
});

app.controller('parking', function($scope, $location, $http, $routeParams, $interval) {
	$scope.canReserv = true;
	$scope.reservation = {};
	
	$scope.getParkings = function(){
		$http.get('main/getParkings').success(function(data){
			$scope.parkings = data;
		});
		$http.get('main/getUsers').success(function(data){
			$scope.users = data;
		});
	};
	
	$scope.setParkingPage = function(page) {
		if (!($scope.isMainPage = angular.isUndefined(page))) {
			$scope.isPlacesPage = true;
			$location.path('/parking/' + page).replace();
			$scope.parkingID = page - 1;
			$scope.checkReserv(page);
		} else $location.path('/').replace();
	};
	
	$scope.setPage = function(page){
		if (!($scope.isMainPage = angular.isUndefined(page))) {
			$scope.isPlacesPage = false;
			$location.path('/' + page).replace();
		} else $location.path('/').replace();
	};
	
	$interval(function(){
		$scope.checkReserv($routeParams.parkingID);
	}, 1000);
	
	$scope.getPlace = function(id) {
		$http.get('main/getPlaces/' + id).success(function(data){
			$scope.places = data;
		});
	};
	
	$scope.getUserDelail = function(){
		$http.get('user/getUserDelail').success(function(data){
			if (data[0] != '"')
				$scope.user = data[0];
		});
	};
	
	$scope.getUserDelail();
	
	$scope.reserv = function(place, selectPlate){
		$scope.checkReserv($routeParams.parkingID);
		$http.get('main/setReservation/' + $scope.user.id + '/' + place.id + '/' + selectPlate.id).success(function(){
			$scope.checkReserv($routeParams.parkingID);
		});
	};
	
	$scope.checkReserv = function(parking){
		$http.get('main/getPlaces/' + (parking - 1)).success(function(data){
				$scope.places = data;
				$scope.canReserv = true;
				$scope.places.forEach(function(place){
					if ($scope.canReserv)
						if (place.user_id == $scope.user.id && place.id_parking == parking)
							$scope.canReserv = false;
				});
			});
	};
	
	$scope.occupy = function(place){
		$scope.checkReserv($routeParams.parkingID);
		$http.get('main/occupyPlace/' + $scope.user.id + '/' + place.id).success(function(){
			$scope.checkReserv($routeParams.parkingID);
		});
	};
	
	$scope.release = function(place){
		$scope.checkReserv($routeParams.parkingID);
		$http.get('main/releasePlace/' + $scope.user.id + '/' + place.id).success(function(){
			$scope.checkReserv($routeParams.parkingID);
		});
	};
	
	$scope.logout = function(){
		$http.get('user/logout');
		$scope.user = null;
	};
	
	$scope.isAdmin = function(){
		return $scope.user && $scope.user.id == 14;
	};
	
	$scope.getUser = function(id){
		var u;
		$scope.users.forEach(function(user){
			if (user.id == id)
				u = user;
		});
		return u;
	};
	
	$scope.changePassword = function(pass){
		$http.get('user/SetPassword/' + $scope.user.id + '/' + pass);
		alert('Twoje hasło zostało zmienione.');
	};
	
	$scope.changePlate = function(plate){
		$http.get('main/ChangePlate/' + plate.id + '/' + plate.number);
		alert('Numer został zmieniony.');
	};
	
	$scope.addPlate = function(plate){
		$http.get('main/AddPlate/' + $scope.user.id + '/' + plate).success(function(){
			alert('Numer został dodany.');
			$scope.getUserDelail();
		});
	};
	
	$scope.getPlate = function(place){
		var p;
		$scope.users.forEach(function(user){
			if (user.id = place.user_id)
				user.plates.forEach(function(plate){
					if (plate.id == place.number_id)
						p = plate;
				});
		});
		return p;
	};
	
	$scope.removePlate = function(plate){
		$http.get('main/RemovePlate/' + plate.id);
		alert('Numer został usunięty.');
		$scope.getUserDelail();
		$scope.selectPlate = $scope.user.plates[0];
	};
	
	$scope.getParkings();
	$scope.setParkingPage();
});