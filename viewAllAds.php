<?php
	session_start();
	if(isset($_SESSION['uname'])) {
		
		function forApproval_table_rows() {
		include "connect.php";
		$sql = "Select * from advertisements where status='no' order by ad_id desc";
		$result = mysqli_query($conn, $sql);
		$count = 0;
		$output = '';
		if(mysqli_num_rows($result)>0) {
			while($row=mysqli_fetch_array($result)) {
				$count = $count+1;
				$adID = $row['ad_id'];
				$caid = $row['coadmin_CAID'];

				$sql2 = "SELECT * from coadmin_reg where reg_id=(SELECT reg_id from approved_admins where CAID = '$caid')";
				$result2 = mysqli_query($conn, $sql2);
				while($row2=mysqli_fetch_array($result2)) {
					$name = $row2['firstname'].' '.$row2['lastname'];
					$reg_id = $row2['reg_id'];
				}
				
				$advertiser = $row['advertiser_name'];
				$place_name = $row['place_name'];
				$timeslot = $row['timeslot'];
				$timestamp = $row['timestamp'];
				$description = $row['description'];
				
				// $sql3 = "Select place_id from places where place_name='$place_name'";
				// $result3 = mysql_query($conn, $sql3);

				$sql4 = "Select id from timeslot_places where place_name='$place_name' and timeslot='$timeslot'"; 
				$result4 = mysqli_query($conn, $sql4);
				while ($row4 = mysqli_fetch_array($result4)) {
					$id = $row4['id'];
				}
				
				
				$output .= '<tr><td>'.$count.'</td>';
				$output .= '<td>'.$caid.'</td>';
				$output .= '<td>'.$name.'</td>';
				$output .= '<td><button type="button" class="btn more view_profile" name="associate-more" id="'.$reg_id.'">
								<img src="img/more.svg" width="30" height="30">
							</button></td>';
				$output .= '<td>'.$advertiser.'</td>';
				$output .= '<td>'.$place_name.'</td>';
				$output .= '<td>'.$timeslot.'-'.($timeslot+2).' mins</td>';
				$output .= '<td>'.$timestamp.'</td>';
				$output .= '<td><button type="button" class="btn more view_ads" name="advert-more" id="'.$adID.'">
								<img src="img/more.svg" width="30" height="30">
							</button></td>';
				$output .= '<td><button type="submit" class= "btnn approve" id='.$adID.'>Approve</button>
				<button type="submit" class= "btnn remove ml-1" id='.$adID.'>Reject</button>
								
							</td>';
				$output .= '<td><button type="submit" class= "btn more edit ml-1" id='.$adID.'><i class="fa fa-edit"></i></button></td></tr>';
			}
		}
		return $output;
	}


	function Active_table_rows() {
		include "connect.php";
		$sql = "Select * from advertisements where status='active' order by ad_id desc";
		$result = mysqli_query($conn, $sql);
		$count = 0;
		$output = '';
		if(mysqli_num_rows($result)>0) {
			while($row=mysqli_fetch_array($result)) {
				$count = $count+1;
				$adID = $row['ad_id'];
				$caid = $row['coadmin_CAID'];

				$sql2 = "SELECT * from coadmin_reg where reg_id=(SELECT reg_id from approved_admins where CAID = '$caid')";
				$result2 = mysqli_query($conn, $sql2);
				while($row2=mysqli_fetch_array($result2)) {
					$name = $row2['firstname'].' '.$row2['lastname'];
					$reg_id = $row2['reg_id'];
				}
				
				$advertiser = $row['advertiser_name'];
				$place_name = $row['place_name'];
				$timeslot = $row['timeslot'];
				$timestamp = $row['timestamp'];
				$description = $row['description'];
				
				// $sql3 = "Select place_id from places where place_name='$place_name'";
				// $result3 = mysql_query($conn, $sql3);

				$sql4 = "Select id from timeslot_places where place_name='$place_name' and timeslot='$timeslot'"; 
				$result4 = mysqli_query($conn, $sql4);
				while ($row4 = mysqli_fetch_array($result4)) {
					$id = $row4['id'];
				}
				
				
				$output .= '<tr><td>'.$count.'</td>';
				$output .= '<td>'.$caid.'</td>';
				$output .= '<td>'.$name.'</td>';
				$output .= '<td><button type="button" class="btn more view_profile" name="associate-more" id="'.$reg_id.'">
								<img src="img/more.svg" width="30" height="30">
							</button></td>';
				$output .= '<td>'.$advertiser.'</td>';
				$output .= '<td>'.$place_name.'</td>';
				$output .= '<td>'.$timeslot.'-'.($timeslot+2).' mins</td>';
				$output .= '<td>'.$timestamp.'</td>';
				$output .= '<td><button type="submit" class="btn more view_ads" name="advert-more" id="'.$adID.'">
								<img src="img/more.svg" width="30" height="30">
							</button></td>';
				$output .= '<td><button type="submit" class= "btnn inactive" id='.$adID.'>Inactive</button>
				
								
							</td></tr>';
			}
		}
		return $output;
	}

	function InActive_table_rows() {
		include "connect.php";
		$sql = "Select * from advertisements where status='inactive' order by ad_id desc";
		$result = mysqli_query($conn, $sql);
		$count = 0;
		$output = '';
		if(mysqli_num_rows($result)>0) {
			while($row=mysqli_fetch_array($result)) {
				$count = $count+1;
				$adID = $row['ad_id'];
				$caid = $row['coadmin_CAID'];

				$sql2 = "SELECT * from coadmin_reg where reg_id=(SELECT reg_id from approved_admins where CAID = '$caid')";
				$result2 = mysqli_query($conn, $sql2);
				while($row2=mysqli_fetch_array($result2)) {
					$name = $row2['firstname'].' '.$row2['lastname'];
					$reg_id = $row2['reg_id'];
				}
				
				$advertiser = $row['advertiser_name'];
				$place_name = $row['place_name'];
				$timeslot = $row['timeslot'];
				$timestamp = $row['timestamp'];
				$description = $row['description'];
				
				// $sql3 = "Select place_id from places where place_name='$place_name'";
				// $result3 = mysql_query($conn, $sql3);

				$sql4 = "Select id from timeslot_places where place_name='$place_name' and timeslot='$timeslot'"; 
				$result4 = mysqli_query($conn, $sql4);
				while ($row4 = mysqli_fetch_array($result4)) {
					$id = $row4['id'];
				}
				
				
				$output .= '<tr><td>'.$count.'</td>';
				$output .= '<td>'.$caid.'</td>';
				$output .= '<td>'.$name.'</td>';
				$output .= '<td><button type="button" class="btn more view_profile" name="associate-more" id="'.$reg_id.'">
								<img src="img/more.svg" width="30" height="30">
							</button></td>';
				$output .= '<td>'.$advertiser.'</td>';
				$output .= '<td>'.$place_name.'</td>';
				$output .= '<td>'.$timeslot.'-'.($timeslot+2).' mins</td>';
				$output .= '<td>'.$timestamp.'</td>';
				$output .= '<td><button type="submit" class="btn more view_ads" name="advert-more" id="'.$adID.'">
								<img src="img/more.svg" width="30" height="30">
							</button></td>';
				$output .= '<td><button type="submit" class= "btnn active" id='.$adID.'>Active</button>
				<button type="submit" class= "btnn delete ml-1" id='.$adID.'>Delete</button>
								
							</td></tr>';
			}
		}
		return $output;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include "header.php";?>
	<link rel="stylesheet" type="text/css" href="css/navbar.css">
	<link rel="stylesheet" type="text/css" href="css/viewAllAds.css">
	<script type="text/javascript" src="js/viewAllAds.js"></script>
</head>
<body>
	<?php $page="three"; include "navbar.php";?>
	<div class="row ml-4 mr-4 mb-4">
		<div class="div-inside-row mb-4">
			<div class="text">Approval <span>Request</span></div>
		</div>
		<div class="table-responsive text-center">
			<table class="table table-hover table-striped table-bordered">
				<thead>
					<tr>
						<th rowspan="2">SR.NO</th>
						<th colspan="3">Associate</th>
						<th colspan="5">Advertisement</th>
						<th rowspan="2">Status</th>
						<th rowspan="2">Edit</th>
					</tr>
					<tr>
						<th>CAID</th>
						<th>Name</th>
						<th>More</th>

						<th>Advertiser Name</th>
						<th>Place</th>
						<th>Timeslot</th>
						<th>Timestamp</th>
						<th>More</th>
						
						
					</tr>
				</thead>
				<tbody>
					<?php echo forApproval_table_rows();?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="row ml-4 mr-4 mb-4 pt-4">
		<div class="div-inside-row mb-4">
			<div class="text">Active <span>ADS</span></div>
		</div>
		<div class="table-responsive text-center">
			<table class="table table-hover table-striped table-bordered">
				<thead>
					<tr>
						<th rowspan="2">SR.NO</th>
						<th colspan="3">Associate</th>
						<th colspan="5">Advertisement</th>
						<th rowspan="2">Status</th>
					</tr>
					<tr>
						<th>CAID</th>
						<th>Name</th>
						<th>More</th>

						<th>Advertiser Name</th>
						<th>Place</th>
						<th>Timeslot</th>
						<th>Timestamp</th>
						<th>More</th>
						
						
					</tr>
				</thead>
				<tbody>
					<?php echo Active_table_rows();?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="row ml-4 mr-4 mb-4 pt-4">
		<div class="div-inside-row mb-4">
			<div class="text">Inactive <span>ADS</span></div>
		</div>
		<div class="table-responsive text-center">
			<table class="table table-hover table-striped table-bordered">
				<thead>
					<tr>
						<th rowspan="2">SR.NO</th>
						<th colspan="3">Associate</th>
						<th colspan="5">Advertisement</th>
						<th rowspan="2">Status</th>
					</tr>
					<tr>
						<th>CAID</th>
						<th>Name</th>
						<th>More</th>

						<th>Advertiser Name</th>
						<th>Place</th>
						<th>Timeslot</th>
						<th>Timestamp</th>
						<th>More</th>
						
						
					</tr>
				</thead>
				<tbody>
					<?php echo InActive_table_rows();?>
				</tbody>
			</table>
		</div>
	</div>


</body>
</html>

<?php

}
?>
<!-- 
<div class="modal" id="showAdModal">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<h4 class="modal-title" id="modal-head"></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
	
			<div class="modal-body">
				<div class="mb-3">
					<p id="desc"></p>
				</div>
				<div class="input-group mb-3">
	        		<div class="input-group-prepend">
	        			<span class="input-group-text"><b>Place</b></span>
	        		</div>
	        			<input type="text" class="form-control" id="place_name" disabled>
        		</div>

        		<div class="input-group mb-3">
	        		<div class="input-group-prepend">
	        			<span class="input-group-text"><b>Timeslot</b></span>
	        		</div>
	        			<input type="text" class="form-control" id="timeslot" disabled>
        		</div>
			<div class="row" id="image-div">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 col-6">
							<div class="m-3">
			        		<div class="">
			        			<span class=""><b>300*600</b></span>
			        		</div>
			        			<span id="300_600" class="half-width"></span>
		        			</div>
						</div>
						<div class="col-md-6 col-6">
							<div class="m-3">
			        		<div class="">
			        			<span><b>160*600</b></span>
			        		</div>
			        		<span id="160_600" class="half-width"></span>	
		        			</div>
						</div>
					</div>
				</div>

				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							<div class="m-3">
			        		<div class="">
			        			<span class=""><b>728*90</b></span>
			        		</div>
			        		<span id="728_90"></span>	
		        			</div>
						</div>
						<div class="col-md-12">
							<div class="m-3">
			        		<div class="">
			        			<span class=""><b>720*300</b></span>
			        		</div>
			        		<span id="720_300"></span>	
		        			</div>
						</div>
					</div>
				</div>
			</div>
			</div>

		</div>
	</div>
</div> -->
<!-- -------------------ASSOCIATE PROFILE---------------------- -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Profile</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="text-center">

        	
        	<h3 id="coadmin_name" class="mb-3"></h3>
			<form action="editAssociateProfile.php" method="POST" id="profileEdit">
			
			
			<div class="input-group mb-3">
        		<div class="input-group-prepend">
        			<span class="input-group-text"><b>Allocated Places</b></span>
        		</div>
        		<input type="text" class="form-control" id="alloted-places" name="alloted-places">
        		
        	</div>

        	<div class="input-group mb-3">
        		<div class="input-group-prepend">
        			<span class="input-group-text"><b>Mobile&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
        		</div>
        		<input type="text" class="form-control" id="mobile" name="mobile">
        		<div class="input-group-append">
        			<span class="input-group-text"><a class="btn" id="mobile-link"><i class="fa fa-phone logo"></i><!-- <img class="logo" alt="Logo" src="img/call.svg" width="20" height="15" title="call"> --></a></span>
        		</div>
        	</div>
			

			<div class="input-group mb-3">
        		<div class="input-group-prepend">
        			<span class="input-group-text"><b>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
        		</div>
        		<input type="text" class="form-control" id="email" name="email">
        		<div class="input-group-append">
        			<span class="input-group-text"><a class="btn" id="email-link"><i class="fa fa-envelope logo"></i><!-- <img class="logo" alt="Logo" src="img/mail.svg" width="15" height="15"> --></a></span>
        		</div>
        	</div>
			
        	<div class="input-group mb-3">
        		<div class="input-group-prepend">
        			<span class="input-group-text"><b>Ads Added&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
        		</div>
        		<input type="text" class="form-control" id="ads_added" name="ads_added">
        		
        	</div>

			</form>
        </div>
      </div>

    </div>
  </div>
</div>



<!-- -------------------ADVERTISEMENT MODAL-------------------------- -->
<div class="modal" id="AdModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Advertisements</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        	<div class="row">
        		<div class="col-md-6 col-12"><a href="" id="image1" target="_blank">Image1(300*600)</a><hr></div>
        		<div class="col-md-6 col-12"><a href="" id="image2" target="_blank">Image2(160*600)</a><hr></div>
        		<div class="col-md-6 col-12"><a href="" id="image3" target="_blank">Image3(728*90)</a><hr></div>
        		<div class="col-md-6 col-12"><a href="" id="image4" target="_blank">Image4(720*300)</a><hr></div>
        	</div>
      </div>

    </div>
  </div>
</div>

<!-- -------------------ADVERTISEMENT MODAL-------------------------- -->
<div class="modal" id="EditAdModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">EDIT</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <form action="edit_ad.php" method="POST" id="user_form" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="form-group mb-2">
								<input type="text" id="adName" name="name" class="form-control effect-1" required>
							</div>

							<div class="form-group" style="margin-bottom: 25px;">
								<textarea rows="8" id="desc" cols="50" name = "desc" placeholder="Enter Description" class="form-control effect-1" required></textarea>
							</div>
							

							<div class="file-group">Upload images as per the specified dimensions:<br><br>

							<label class="btn-file" id="upload_image">300*600
			   					<input type="file" name="user_image" id="user_image" required>
							</label><div id="">dhuj</div>
							
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