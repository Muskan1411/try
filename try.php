<!--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script type="text/javascript">

	var app = angular.module("myApp",[]);
	app.controller("myCtrl", function($scope) {
		$scope.getLocation = function() {
			if (navigator.geolocation) {
		        navigator.geolocation.watchPosition(function(position){
		        	return position.coords.latitude + "&"+ position.coords.longitude;
		        });
		    } else { 
		        return "Geolocation is not supported by this browser.";
		    }
    	}
	});
</script>
<body ng-app="myApp">
	<div ng-controller="myCtrl">
		<a class="btn" style="background-color: #303030; border-radius: 5px 20px 5px;"  href="https://www.google.com/maps/search/?api=1&query={{getLocation()}}" target="_blank"><img id="logo" alt="Logo" src="img/location.svg" width="25" height="25"></a>
		
	</div>
</body>-->
<!--<?php
//date_default_timezone_set('Asia/Kolkata');
//echo date('i');
?>-->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script type="text/javascript">
		var d = new Date();
		var min = d.getMinutes();
		var slot = min%4;
	var app = angular.module("myApp",[]);
	app.controller("myCtrl", function($scope) {
		$scope.time = slot*60*1000;
	});
</script>
<body ng-app="myApp">
	<div ng-controller="myCtrl">
		<p>{{time}}</p>
	</div>
</body>
