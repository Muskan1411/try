<?php
session_start();
	if(isset($_SESSION['uname'])) {
		$conn = mysqli_connect('localhost','root','muskan11','kstask');
		function dynamic_list() {
						$conn = mysqli_connect('localhost','root','muskan11','kstask');
						$query = "Select timeslot from carouselImages order by timeslot asc";
						$result = mysqli_query($conn, $query);
						$slot = array(0,3,6,9,12,15,18,21,24,27,30,33,36,39,42,45,48,52,55,58);
						$timeslot = array();
						$list = '';
						$i=0;
						$j=0;
						if(mysqli_num_rows($result) > 0) {
						while($row = mysqli_fetch_array($result)) {
							$timeslot[] = $row['timeslot'];
						}
						 
						$size = sizeof($timeslot); 
						while($i<20) {
							if($slot[$i] <= $timeslot[$j]) {
								 if($slot[$i] == $timeslot[$j]) {
								 	if( $j<$size-1) {
										$j = $j + 1; 
								 	}
								 } else {
									$list .= '<option value="'.$slot[$i].'">'. $slot[$i].'-'.($slot[$i]+2) .' min</option>';
								 }
							} else {
								$list .= '<option value="'.$slot[$i].'">'. $slot[$i].'-'.($slot[$i]+2) .' min</option>';
							}
							$i = $i + 1;
						}
						} else {
							while($i<20) {
								$list .= '<option value="'.$slot[$i].'">'. $slot[$i].'-'.($slot[$i]+2) .' min</option>';
								$i = $i + 1;
							}
						}
						return $list;
					}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include "header.php" ?>
	<link rel="stylesheet" type="text/css" href="css/onlogin.css">
	<link rel="stylesheet" type="text/css" href="css/navbar.css">
	
	<script type="text/javascript" src="js/script.js">
	</script>
	
</head>
<body>
	<?php $page='one'; include_once "navbar.php";?>
	<!-- *********Navbar & Add button ********** -->
	<div class="wrapper">
		<!------****NAVBAR****------->
		
		<!------****Add Button****------->
	  	<div class="container-fluid text-center" id="section-add" style="position: relative;">
	  		<!-- <div class="row">
	  			<div class="col-md-4 col-12"> --><button type="button" id="add_btn" data-toggle="modal" data-target="#adModal" class="btn-file">Add the Advertisements</button></div>
	  			<!-- <div class="col-md-8 col-12">
	  				<div class="row" style="position: absolute;background-color: white; z-index: 20; padding: 50px; top: 60px; left: 25%;">
	   			<div class="col-md-3 col-3"><a href="">All <br/>ADs</a></div>
	   			<div class="col-md-3 col-3"><a href="">Active <br/>ADs</a></div>
	   			<div class="col-md-3 col-3"><a href="">Inactive <br/>ADs</a></div>
	   			<div class="col-md-3 col-3"><a href="">Remove <br/>ADs</a></div>
	   		</div>
	  			</div> -->
	  	<!-- 	</div> -->
	   		
	   		
		<!-- </div> -->
	 </div>

	<!------****Table****--------->
	<div class="table-responsive" style="clear: both; position: relative; top: 40px;">
		<table class="table table-hover table-striped" id="result">
			<thead class="table-header">
			<tr width="100%">
				<th>Time Slot</th>
				<th>Image</th>
				<th>Update</th>
				<th>Remove</th>
				<th>Timestamp</th>
			</tr>
			</thead>
		</table>
	</div>

</body>
</html>

<!--************* Add Ads Modal ***************-->
<div id="adModal" class="modal fade">
	<div class="modal-dialog">
		<form method="POST" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<!--Header of Modal-->
				<div class="modal-header">
					<h4 class="modal-title" style="color: #901108;">Add Ads</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>	
				</div>
				<!--Body of Modal -->
				<div class="modal-body">
					
					<div class="form-group" id="time-div" style="margin-bottom: 25px;">
						<input type="text" id="time" name="time" class="form-control effect-1" required style="border: none; font-weight:bold;">
						<span class="focus-border"></span>
					</div>

					<div class="form-group" style="margin-bottom: 25px;">
						<input type="text" id="adName" name="name" placeholder="Enter Advertiser Name" class="form-control effect-1" required>
						<span class="focus-border"></span>
					</div>

					<div class="form-group" style="margin-bottom: 25px;">
						<textarea rows="8" id="desc" cols="50" name = "desc" placeholder="Enter Description" class="form-control effect-1" required></textarea>
						<span class="focus-border"></span>
					</div>

					<div class="form-group" id="selopt">	
						<select class="form-control" id="sel" name="timeslot">
							<option disabled selected value="x">Select Time Slot</option>
							 	<?php echo dynamic_list();?>
						</select>
					</div>

					<div class="file-group">Upload images as per the specified dimensions:
						<div>
						<span><label class="btn-file">300*600
			   				 <input type="file" name="user_image" id="user_image" required>
							</label></span>
							<span id="ad_uploaded" style="width: 50px; height: 60px;"></span>
							</div>
							<span>
								<div class="input-group copy">
									<input type="text" value='<iframe src="#" scrolling="no" frameborder="0" height="600px" width="300px"></iframe>' class="form-control" id="input-copy1" readonly>
									<div class="input-group-append">
										<span class="input-group-text"><button id="copyIcon1" onclick="copyText(this)"><i class="fa fa-clipboard"></i></button></span>
									</div>
								</div>
							</span>
						    <label class="btn-file" id="upload_image1">160*600
			   					 <input type="file" name="user_image1" id="user_image1" required>
							</label>
							<span id="ad_uploaded1"></span>
							<span>
								<div class="input-group copy">
									<input type="text" value='<iframe src="#" scrolling="no" frameborder="0" height="600px" width="160px"></iframe>' class="form-control" id="input-copy2" readonly>
									<div class="input-group-append">
										<span class="input-group-text"><button id="copyIcon2" onclick="copyText(this)"><i class="fa fa-clipboard"></i></button></span>
									</div>
								</div>
							</span>
							<label class="btn-file" id="upload_image2">728*90
			   					 <input type="file" name="user_image2" id="user_image2" required>
							</label>
							<span id="ad_uploaded2"></span>
							<span>
								<div class="input-group copy">
									<input type="text" value='<iframe src="#" scrolling="no" frameborder="0" height="90px" width="728px"></iframe>' class="form-control" id="input-copy3" readonly>
									<div class="input-group-append">
										<span class="input-group-text"><button id="copyIcon3" onclick="copyText(this)"><i class="fa fa-clipboard"></i></button></span>
									</div>
								</div>
							</span>
							<label class="btn-file" id="upload_image3">720*300
			   					 <input type="file" name="user_image3" id="user_image3" required>
							</label>
							<span id="ad_uploaded3"></span>
							<span>
								<div class="input-group copy">
									<input type="text" value='<iframe src="#" scrolling="no" frameborder="0" height="300px" width="720px"></iframe>' class="form-control" id="input-copy4" readonly>
									<div class="input-group-append">
										<span class="input-group-text"><button id="copyIcon4" onclick="copyText(this)"><i  class="fa fa-clipboard"></i></button></span>
									</div>
								</div>
							</span>
							</div>
							
							<div class="form-group places row" id="places">
								<div class="col-md-4">
									<input type="text" name="add" id="addPlace" class="form-control" placeholder="Add the place">
								</div>
								<div class="col-md-8">
									<select multiple class="form-control selectpicker" id="place" name="place[]" multiple data-live-search="true" required>
									<option disabled>Select the places where to show:</option>
									<?php
										$query = "Select * from places order by place_name asc";
										$result = mysqli_query($conn, $query);
										
										while($row=mysqli_fetch_array($result)) {
											echo '<option value="'.$row['place_name'].'">'.$row['place_name'].'</option>';
										}	
									?>
									</select>
								</div>
							</div>
							<div>

							<a class="btn" id="call" style="background-color: #303030; border-radius: 5px 20px 5px;" href="tel:46682736"><img id="logo" alt="Logo" src="img/call.svg" width="25" height="25" title="call"></a>
							<a class="btn" style="background-color: #303030; border-radius: 5px 20px 5px;" href="mailTo:https://mail.google.com/mail/?view=cm&fs=1&to=techpratikriya@kstechsolns.co.in"><img id="logo" alt="Logo" src="img/mail.svg" width="25" height="25"></a>
							<a class="btn" style="background-color: #303030; border-radius: 5px 20px 5px;"  href="https://www.google.com/maps/search/?api=1&query=26.8863968&75.80973469999999
							" target="_blank"><img id="logo" alt="Logo" src="img/location.svg" width="25" height="25"></a>
							<div id="mapholder"></div>
							</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="user_id" id="user_id" />
			     	<input type="hidden" name="operation" id="operation" />
			     	<input type="submit" name="action" id="action" class="btn-upload" value="Add" />
			    </div>
			</div>
		</form>	
	</div>
</div>
<?php
}
?>
<script type="text/javascript" src="js/onlogin.js"></script>


