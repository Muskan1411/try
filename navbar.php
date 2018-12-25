<!-- <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
font-family: 'Poppins', sans-serif; -->

<div class="opaque-navbar">
			<nav class="mb-4 navbar navbar-expand-lg navbar-fixed-top">

		        <a class="navbar-brand  text animated rubberBand" href="#"><img id="logo" alt="Logo" src="logo.png" width="55" height="55"> 
		        	<span class="font-bold">ADSMania<b class="tagline"><!--TAGLINE--></b></span>
		        </a>

		        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
		         	<span class="navbar-toggler-icon"><img id="logo" alt="Logo" src="navicon.svg" width="35" height="35"></span>
		        </button>

		        <div class="collapse navbar-collapse animated pulse" id="navbarSupportedContent-4">
		            <ul class="navbar-nav ml-auto">
		                <li class="nav-item">
		                    <a <?php echo ($page=='one')?'class="nav-link active"':'class="nav-link"';?> href="#"  data-toggle="modal" data-target="#newAdModal"><i class="fa fa-plus fa-fw mx-1"></i>Add Ads<span class="sr-only">(current)</span></a>
		                </li>
		                 <li class="nav-item">
		                    <a <?php echo ($page=='two')?'class="nav-link active"':'class="nav-link"';?> href="manage_coadmins.php"><i class="fa fa-user mx-1"></i>Manage Associates<span class="sr-only">(current)</span></a>
		                </li>
		                <li class="nav-item">
		                    <a <?php echo ($page=='three')?'class="nav-link active"':'class="nav-link"';?> href="view_ads.php"><i class="fa fa-eye mx-1"></i>View Ads</a>
		                </li>
		                 <li class="nav-item">
		                    <a <?php echo ($page=='four')?'class="nav-link active"':'class="nav-link"';?> href="viewAllAds.php"><i class=""></i>Manage Ads</a>
		                </li>
		                 <li class="nav-item">
		                    <a <?php echo ($page=='five')?'class="nav-link active"':'class="nav-link"';?> href="#" data-toggle="modal" data-target="#newPlaceModal"><i class="fa fa-plus fa-fw mx-1"></i>New Place<span class="sr-only">(current)</span></a>
		                </li>
		                <li class="nav-item">
		                    <a class="nav-link" href="logout.php">Log Out</a>
		                </li>
		            </ul>
		        </div>  

		    </nav>
  		</div> 

<script type="text/javascript" src="js/script.js"></script>

 <div id="newPlaceModal" class="modal fade">
	<div class="modal-dialog">
		
			<div class="modal-content">
				<!--Header of Modal-->
				<div class="modal-header">
					<h4 class="modal-title" style="color: #901108;">Add New Place</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>	
				</div>
				<!--Body of Modal -->
				<form id="addPlaceForm" method="POST">
				<div class="modal-body">
					<label for="place">Place Name</label>
					<input type="text" name="place" id="place" class="form-control" placeholder="Add the place">
				</div>

				<div class="modal-footer">
					<button type="submit" name="addPlace" class="addPlace" style="border: none; background-color: #901108;color:#fff; padding: 6px 16px;">Add</button>
				</div>
				</form>
			</div>
		
	</div>
</div>
<style type="text/css">
	#upload_image, #upload_image1 , #upload_image2, #upload_image3 {
	position: relative;
	left: -75px;
		color: #303030;
		padding: 13px 20px;
		border-radius: 200px;
	  	cursor: pointer;
	  	z-index:1;
	  	border: 1px solid #901108;
	  	transform: scale(0.6);
		background-color: transparent;
		outline: 0;
		&:hover {
			background: lighten(transparent, 5%);
			color: $color1;
			transform: scale(0.7);
			transition: all 0.4s ease-in;
		} 
	
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
 <div id="newAdModal" class="modal fade">
	<div class="modal-dialog">
		
			<div class="modal-content">
				<!--Header of Modal-->
				<div class="modal-header">
					<h4 class="modal-title" style="color: #901108;">Add ADS</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>	
				</div>
						<form action="add_ad.php" method="POST" id="user_form" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="form-group mb-2">
								<input type="text" id="adName" name="name" placeholder="Enter Advertiser Name" class="form-control effect-1" required>
							</div>

							<div class="form-group" style="margin-bottom: 25px;">
								<textarea rows="8" id="desc" cols="50" name = "desc" placeholder="Enter Description" class="form-control effect-1" required></textarea>
							</div>
							
							
							<div ng-app="myApp" ng-controller="myController" ng-init="loadPlaces()">
								<div class="form-group places" id="places">
								<!-- <select multiple class="form-control selectpicker" ng-model="place" id="place" name="place[]" multiple data-live-search="true" ng-change="loadTimeslots()" required> -->
									<label for="place">Select Place:</label>
									<select class="form-control mb-2" ng-model="place" id="place" name="place" ng-change="loadTimeslots()" required>
										<option disabled selected>Select the Place</option>
									<option ng-repeat="place in places" value="{{place.place_name}}">{{place.place_name}}</option>
									<!-- <?php
										//echo place_list();
									?> -->
								</select>
								</div>
							
								<div class="form-group" id="selopt">	
									<label for="timeslot">Select Time Slot:</label>
									<select class="form-control" id="sel" name="timeslot" ng-model="time">
										<option disabled selected value="x">Select Time Slot</option>
										<option ng-repeat="time in timeslots" value="{{time.timeslot}}">{{time.timeslot}}</option>
										 	<!-- ?php echo dynamic_list();?> -->
									</select>
								</div>
							</div>

							<div class="file-group">Upload images as per the specified dimensions:<br><br>

							<label class="btn-file" id="upload_image">300*600
			   					<input type="file" name="user_image" id="user_image" required>
							</label>
							
						    <label class="btn-file" id="upload_image1">160*600
			   					 <input type="file" name="user_image1" id="user_image1">
							</label>
							
							<label class="btn-file" id="upload_image2">728*90
			   					 <input type="file" name="user_image2" id="user_image2">
							</label>
							
							
							<label class="btn-file" id="upload_image3">720*300
			   					 <input type="file" name="user_image3" id="user_image3">
							</label>
							
							</div>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="user_id" id="user_id" />
			     			<input type="hidden" name="operation" id="operation" />
			     			<input type="submit" name="action" id="action" class="btn-upload" value="Add" style="border: none; background-color: #901108;color:#fff; padding: 6px 16px;"/>
			     		</div>
	  					</form>
	  				</div>
	  			</div>
	  		</div>
<script type="text/javascript">

	var app = angular.module("myApp", []);
	app.controller("myController", function($scope, $http) {

		$scope.loadPlaces = function () {
			$http.get("loadPlaces.php")
			.then(function(response) {
				$scope.places = response.data;
			})
		}

		$scope.loadTimeslots = function() {
			$http.post("loadTimeslots.php", {"place_name":$scope.place})
			.then(function(response) {
				console.log(response.data);
				$scope.timeslots = response.data;
			})
		}
	})
</script>
	  	