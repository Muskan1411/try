<?php
if(isset($_SESSION['user'])) {
	function allocated_places_list() {
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
		$list = allocated_places_list();
		$list_arr = array();
		$list_arr = explode(',', $list);
		$option = '';
		foreach ($list_arr as $la) {
			$option .= '<option value="'.$la.'">'.$la.'</option>';
		}
		return $option;
	}

	function get_table() {
		include "conn.php";
		$sql1 = "Select * from advertisements where coadmin_CAID=(Select CAID from approved_admins where username='".$_SESSION['user']."') order by ad_id desc";
		$res1 = mysqli_query($conn, $sql1);
		$output = '';
		$count = 0;
		while($row = mysqli_fetch_array($res1)) {
			$count = $count+1;
			$output .= '<tr>';
			$output .= '<td>'.$count.'</td>';
			$output .= '<td>'.$row['advertiser_name'].'</td>';
			$output .= '<td>'.$row['description'].'</td>';
			$output .= '<td>'.$row['place_name'].'</td>';
			$output .= '<td>'.$row['timeslot'].'</td>';
			$output .= '<td>'.$row['timestamp'].'</td>';
			$output .= '<td><a href="img/advertisements/'.$row['300*600'].'" target="_blank">Image1</a></td>';
			$output .= '<td><a href="img/advertisements/'.$row['160*600'].'" target="_blank">Image2</a></td>';
			$output .= '<td><a href="img/advertisements/'.$row['728*90'].'" target="_blank">Image3</a></td>';
			$output .= '<td><a href="img/advertisements/'.$row['720*300'].'" target="_blank">Image4</a></td>';
			$output .= '</tr>';
		}
		return $output;

	}

	function get_stats() {
		include "conn.php";
		$sql1 = "Select * from approved_admins where username='".$_SESSION['user']."' LIMIT 1";
		$result1 = mysqli_query($conn, $sql1);
		$output = '<div class="col-md-5 col-10">';
		while($row = mysqli_fetch_array($result1)) {

			$output .= '<hr><br><p class="stats-font">ADS ADDED : '.$row['ads_added'].'</p><br><hr><br>';

			$output .= '<p class="stats-font">ADS APPROVED : '.$row['ads_approved'].'</p><br><hr>';
			$output .= '</div>';
			$output .= '<div class="col-md-5 col-10">';

			if($row['ads_approved'] != 0) {
				$standing = ($row['ads_approved']/$row['ads_added'])*100;
				
			} else {
				$standing = 0;
			}
			$output .= '<p class="stats-font">PROGRESS</p>';
			$output .= '<div class="progress--circle progress--'.$standing.'">
  							<div class="progress__number">'.$standing.'%</div>
						</div>';
			$output .= '</div>';
 		}
 		return $output;	
	}	
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/onlogin.css">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	<script type="text/javascript" src="js/onlogin.js"></script>
</head>
<body>

<!------------------ADD ADS ADMANIA FORM--------------------------->

<div class="container tab-pane active" id="addinadmania">
    <div class="card mt-4 mb-4 pt-2 pb-2 ">
        <div class="card-body">
            <div class="card-heading mb-4">
                <h3 class="card-head">
                    Add
                    <span class="card-head-part">
                        ADS
                    </span>
                </h3>
            </div>
            <form action="add_ad.php" enctype="multipart/form-data" id="user_form" method="POST">
                <div class="form-group mb-2">
                    <input class="form-control effect-1" id="adName" name="name" placeholder="Enter Advertiser Name" required="" type="text">
                    
                </div>
                <div class="form-group" style="margin-bottom: 25px;"><label for="desc">
                            Enter Description:
                        </label>
                    <textarea class="form-control effect-1" cols="50" id="desc" name="desc" placeholder="Enter Description" required="" rows="8">
                    </textarea>
                </div>
                <div ng-app="myApp" ng-controller="myController" ng-init="loadPlaces()">
                    <div class="form-group places" id="places">
                        <!-- <select multiple class="form-control selectpicker" ng-model="place" id="place" name="place[]" multiple data-live-search="true" ng-change="loadTimeslots()" required> -->
                        <label for="place">
                            Select Place:
                        </label>
                        <select class="form-control mb-2" id="place" name="place" ng-change="loadTimeslots()" ng-model="place" required="">
                            <option disabled="" selected="">
                                Select the Place
                            </option>
                            <option ng-repeat="place in places" value="{{place.place_name}}">
                                {{place.place_name}}
                            </option>
                            <!-- <?php
												//echo place_list();
											?> -->
                        </select>
                    </div>
                    <div class="form-group" id="selopt">
                        <label for="timeslot">
                            Select Time Slot:
                        </label>
                        <select class="form-control" id="sel" name="timeslot" ng-model="time">
                            <option disabled="" selected="" value="x">
                                Select Time Slot
                            </option>
                            <option ng-repeat="time in timeslots" value="{{time.timeslot}}">
                                {{time.timeslot}}
                            </option>
                            <!-- ?php echo dynamic_list();?> -->
                        </select>
                    </div>
                </div>
                <div class="file-group" ng-app="myApp2" ng-controller="myController2">
                    Upload images as per the specified dimensions:
                    <br>
                            <label class="btn-file" id="upload_image">
                                300*600
                                <input id="user_image" name="user_image" ng-model="fields.one" ng-required="!(fields.one.length || fields.two.length || fields.three.length || fields.four.length)" type="file">
                    <br>           
                            </label>
                            <label class="btn-file" id="upload_image1">
                                160*600
                                <input id="user_image1" name="user_image1" ng-model="fields.two" ng-required="!(fields.one.length || fields.two.length || fields.three.length || fields.four.length)" type="file">
                    <br>            
                            </label>
                            <label class="btn-file" id="upload_image2">
                                728*90
                                <input id="user_image2" name="user_image2" ng-model="fields.three" ng-required="!(fields.one.length || fields.two.length || fields.three.length || fields.four.length)" type="file">
                    <br>            
                            </label>
                            <label class="btn-file" id="upload_image3">
                                720*300
                                <input id="user_image3" name="user_image3" ng-model="fields.four" ng-required="!(fields.one.length || fields.two.length || fields.three.length || fields.four.length)" type="file">
                                
                            </label>
                      
                </div>
                <input id="user_id" name="user_id" type="hidden"/>
                <input id="operation" name="operation" type="hidden"/>
                <input class="btn-upload" id="action" name="action" type="submit" value="Add"/>
            </form>
        </div>
    </div>
</div>

<!------------------YOUR ADS TABLE--------------------------->
<div class="tab-pane fade table-responsive mt-4" id="your-ads-admania">
	<table class="table table-striped table-hover text-center">
		<thead>
			<th>SR.NO.</th>
			<th>Advertiser Name</th>
			<th>Description</th>
			<th>Place</th>
			<th>Timeslot</th>
			<th>Timestamp</th>
			<th>Img1(300*600)</th>
			<th>Img2(160*600)</th>
			<th>Img3(728*90)</th>
			<th>Img4(720*300)</th>
		</thead>
		<tbody>
			<?php echo get_table();?>
		</tbody>
	</table>
</div>

<!------------------STATS--------------------------->
<div class="tab-pane fade mt-4" id="stats-admania">
	<div class="row justify-content-center text-center">
		<?php echo get_stats();?>
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
</script>
</body>
</html>
<?php
}
?>