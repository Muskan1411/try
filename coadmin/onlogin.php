<?php
session_start();
if(isset($_SESSION['user'])) {
	function allocated_places() {
		$conn = mysqli_connect('localhost', 'root', 'muskan11', 'KSTask');

		$sql = "Select * from approved_admins where username='".$_SESSION['user']."'";
		$res = mysqli_query($conn, $sql);
		while($row=mysqli_fetch_array($res)) {
				$data = array();
				$list = '';
				if($row['allocated_places'] != '') {
					$data = unserialize($row['allocated_places']);
					for($i=0;$i<(sizeof($data) - 1);$i=$i+1) {
						// $list .= '<li class="dropdown-item">'.$data[$i].'</li>';
						$list .= $data[$i].',';
					}$list .= $data[$i];
				} else {
					$list .= 'No places yet';
				}
		}
		return $list;
	}

	function place_list() {
		$list = allocated_places();
		$list_arr = array();
		$list_arr = explode(',', $list);
		$option = '';
		foreach ($list_arr as $la) {
			$option .= '<option value="'.$la.'">'.$la.'</option>';
		}
		return $option;
	}

	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include "header.php";?>
	<link rel="stylesheet" type="text/css" href="css/navbar.css">
	<link rel="stylesheet" type="text/css" href="css/onlogin.css">

	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

	<script type="text/javascript" src="js/onlogin.js"></script>
</head>
<body>
	
	<div class="container-fluid">
		<div class="opaque-navbar">
			<nav class="navbar navbar-expand-lg navbar-fixed-top">
		        <a class="navbar-brand font-bold text animated rubberBand" href="#"><img id="logo" alt="Logo" src="../logo.png" width="55" height="55"> <span>ADSMania<b class="tagline">Know the things better</b></span></a>
		        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
		         	<span class="navbar-toggler-icon"><img id="logo" alt="Logo" src="navicon.svg" width="35" height="35"></span>
		        </button>
		        <div class="collapse navbar-collapse animated pulse" id="navbarSupportedContent-4">
		            <ul class="navbar-nav ml-auto">
		                <!-- <li class="nav-item">
		                    <a class="nav-link" href="onlogin.php"><i class="fa fa-plus fa-fw mx-1"></i>Add Ads<span class="sr-only">(current)</span></a>
		                </li>
 -->		             <!--    <div class="dropdown">
						<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Allocated Places
							<span class="caret"></span></button>
							<div class="dropdown-menu">
								<?php //echo allocated_places();?> 
							</div>
						</div> -->
		                <!-- <li class="nav-item active">

		                    <a class="nav-link" href="manage_coadmins.php"><i class="fa fa-user mx-1"></i>Allocated Places<span class="sr-only">(current)</span></a>
		                </li> -->
		                <!-- <li class="nav-item">
		                    <a class="nav-link" href="carousel.php"><i class="fa fa-eye mx-1"></i>Preview</a>
		                </li> -->
		                <li class="nav-item">
		                    <a class="nav-link" href="logout.php">Log Out</a>
		                </li>
		            </ul>
		        </div>        
		    </nav>
  	</div> 
	  	<div class="jumbotron text-center">
	  		<div class="container">
	  			<p>You have been allocated <span class="allocation"><?php echo allocated_places();?></span> </p>	
	  		</div>
	  	</div>
</div>

	<div class="container">
	  	<div class="row justify-content-center">
	  		<div class="col-lg-10 col-md-8 col-12">
	  			<ul class="nav nav-tabs">
	  					<?php echo nav_tabs();?>	
	  			</ul>

	  			<div class="tab-content">
	  				<!--------ADHUB--------->
	  				<div id="adhub" class="container tab-pane active">
	  				<section class="container mt-4 mb-4 pt-2 pb-2 post_ad">
						<form id="myForm" method="post">
						<div class="card mb-4">
						<div class="card-header">Post A free Ad</div>
						<div class="card-body">

							<div class="row justify-content-center catloc-div pt-4 pb-4">
								<div class="col-md-4 col-10">
									
				          				<select name="category" class="form-control" required>
				          					<option selected disabled>Select Category:</option>
				          					<optgroup label="Accomodation">
					          					<option>PG</option>
					            				<option>Hostels</option>
					            				<option>Rental Rooms</option>
					            				<option>Commercial Rentals</option>
											</optgroup>

											<optgroup label="Business">
				            				  <option>CA</option>
									          <option>Corporate Event Planners</option>
									          <option>Lawyers</option>
									          <option>Renovators</option>
									          <option>Vastu Shastra Consultant</option>
									          <option>Visa Agency</option>
									          <option>Renoators</option>
											</optgroup>

											<optgroup label="Clothing">
										        <option>Boutique</option>
										        <option>Casual Wears</option>
										        <option>Ethnic Wears</option>
										        <option>Uniform Stores</option> 
											</optgroup>

											<optgroup label="Education">
										        <option>Coaching Institutes</option>
									            <option>Cooking Classes</option>
									            <option>Language Classes</option>
									            <option>Libraries</option>
									            <option>Music/Dance CLasses</option>
									            <option>Playschools</option>
									            <option>Stationery</option>
											</optgroup>

											<optgroup label="Fitness">
									            <option>Ayurveda</option>
									            <option>Dietician/Nutritionist</option>
									            <option>Gym</option>
									            <option>Physiotherapy</option>
									            <option>Skin Treatment</option>
									            <option>Yoga Centers</option>
											</optgroup>

											<optgroup label="Food">
									            <option>Cafe</option>
									            <option>Dairies</option>
									            <option>Grocery Store</option>
									            <option>Juice Corners</option>
									            <option>Online Food Delievry</option>
									            <option>Restaurants</option>
									            <option>Street Food Corners</option>
											</optgroup>

											<optgroup label="Health">
									            <option>Clinics</option>
									            <option>Hospitals</option>
									            <option>Medical Stores</option>
									            <option>Optics/Eyewear</option>
									            <option>Veternaries</option>
											</optgroup>

											<optgroup label="Services">
									            <option>Appliance Repair</option>
									            <option>Carpenters</option>
									            <option>Electrician</option>
									            <option>Event Organisers</option>
									            <option>Furniture</option>
									            <option>Gym</option>
									            <option>Home Decor</option>
									            <option>Kitchen Cleaners</option>
									            <option>Laundry</option>
									            <option>Packers & Movers</option>
									            <option>Painters</option>
									            <option>Pest Control Services</option>
									            <option>Plumbers</option>            
									            <option>Spa/Saloon</option>
									        </optgroup>

											<optgroup label="Travel">
									            <option>Hotels/Resorts</option>
									            <option>Travel Agencies</option>
											</optgroup>

											<optgroup label="Utilities">
									            <option>Couriers</option>
									            <option>Dairies</option>
									            <option>Grocery Stores</option>
									            <option>Parking</option>
									            <option>Petrol Pumps</option>
											</optgroup>

											<optgroup label="Wedding">
									            <option>Astrologers</option>
									            <option>Beauticians</option>
									            <option>Catering</option>
									            <option>DJ</option>
									            <option>Event Managers</option>
									            <option>Marriage Gardens</option>
									            <option>Photography</option> 
									        </optgroup>   
				          				</select>
								</div>
								<div class="col-md-4 col-10">
									<input type="text" name="location" class="form-control" placeholder="Enter Location" required>
								</div>
								<div class="col-md-4 col-10">
									<input type="text" name="address" class="form-control"  placeholder="Enter Address" required>
								</div>
							</div>

							<div class="mt-3">
								<label for="" class="label-font">Title</label>
								<input type="text" name="ad_title" placeholder="Write a suitable title for your ad" class="form-control" >
							</div>

							<div class="mt-3">
								<label for="" class="label-font">Description</label>
								<input type="text" name="ad_desc" placeholder="Write a suitable description for your ad" class="form-control" >
							</div>

							<div class="mt-3">
								<h4 class="image-header">Add Images Of Ad</h4>
								 
								<div class="file-upload mb-2">
									<input type="file" name="chooseFile1" id="chooseFile" class="mr-auto">
								</div>
								<div class="file-upload mb-2">
									<input type="file" name="chooseFile2" id="chooseFile" class="mr-auto">
								</div>
								<div class="file-upload mb-2">
									<input type="file" name="chooseFile3" id="chooseFile" class="mr-auto">
								</div>
								<div class="file-upload mb-2">
									<input type="file" name="chooseFile4" id="chooseFile" class="mr-auto">
								</div>
								<div class="file-upload mb-2">
									<input type="file" name="chooseFile5" id="chooseFile" class="mr-auto">
								</div>
								<div class="file-upload mb-2">
									<input type="file" name="chooseFile6" id="chooseFile" class="mr-auto">
								</div>
								<div class="file-upload mb-2">
									<input type="file" name="chooseFile7" id="chooseFile" class="mr-auto">
								</div>
								<div class="file-upload mb-2">
									<input type="file" name="chooseFile8" id="chooseFile" class="mr-auto">
								</div>
								<div class="file-upload mb-2">
									<input type="file" name="chooseFile9" id="chooseFile" class="mr-auto">
								</div>
								<div class="file-upload mb-2">
									<input type="file" name="chooseFile10" id="chooseFile" class="mr-auto">
								</div>

							</div>
						</div>
					</div>

					<div class="card mb-4">
						<div class="card-header">Contact Information</div>
						<div class="card-body">
							
								<div class="mt-3">
								<label for="name" class="label-font">Name</label>
								<input type="text" name="name" placeholder="Your name" class="form-control" required>
							</div>

							<div class="mt-3">
								<label for="email" class="label-font">Email</label>
								<input type="email" name="email" placeholder="Your Email" class="form-control" required>
							</div>

							<div class="mt-3">
								<label for="mobile" class="label-font">Phone No</label>
								<input type="tel" name="mobile" placeholder="Your Phone Number" class="form-control" required>
							</div>
							

						</div>
					</div>

					<div class="card mb-4">
						
						<div class="card-body">
							<div class="mt-3">
								<input type="checkbox" name="" required>&nbsp;I agree to Terms of Use
							</div>

							<div class="mt-3">
								<input type="hidden" name="ad_added_by_user">
								<button class="SubmitForReview" name="submit-for-review">Submit for Review</button>
							</div>

						</div>
					</div>

					</form>
				</section>
			</div>
	  				<!-------ADSMANIA------->
	  				<div id="adsmania" class="container tab-pane fade">
		  				<div class="card  mt-4 mb-4 pt-2 pb-2 ">
			  				<div class="card-body">
			  					<div class="card-heading mb-4"><h3 class="card-head">Add <span class="card-head-part">ADS</span></h3></div>
								<form action="add_ad.php" method="POST" id="user_form" enctype="multipart/form-data">

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

									<div class="file-group" ng-app="myApp2" ng-controller="myController2">Upload images as per the specified dimensions:<br><br>
									
									<label class="btn-file" id="upload_image">300*600
					   					<input type="file" ng-model="fields.one" name="user_image" id="user_image" ng-required="!(fields.one.length || fields.two.length || fields.three.length || fields.four.length)">
									</label>
									
								    <label class="btn-file" id="upload_image1">160*600
					   					 <input type="file" ng-model="fields.two" name="user_image1" id="user_image1" ng-required="!(fields.one.length || fields.two.length || fields.three.length || fields.four.length)">
									</label>
									
									<label class="btn-file" id="upload_image2">728*90
					   					 <input type="file" ng-model="fields.three" name="user_image2" id="user_image2" ng-required="!(fields.one.length || fields.two.length || fields.three.length || fields.four.length)">
									</label>
									
									
									<label class="btn-file" id="upload_image3">720*300
					   					 <input type="file" ng-model="fields.four" name="user_image3" id="user_image3" ng-required="!(fields.one.length || fields.two.length || fields.three.length || fields.four.length)">
									</label>
									
									</div>
									<input type="hidden" name="user_id" id="user_id" />
					     			<input type="hidden" name="operation" id="operation" />
					     			<input type="submit" name="action" id="action" class="btn-upload" value="Add" />
			  					</form>
			  				</div>
			  			</div>
					</div>
	  			</div>
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
				$scope.timeslots = response.data;
			})
		}
	})

	var app2 = angular.module("myApp2", []);
	app2.controller("myController2", ['$scope', function ($scope) {
    $scope.fields = {
        one: '',
        two: '',
        three: '',
        four: ''
    };
    }]);

    angular.bootstrap(document.getElementById("app2"), ['myApp2']);
</script>

</body>
</html>
<?php
}
?>


