<?php
	session_start();

	if(isset($_SESSION['uname'])) {
		include "connect.php";
		function adminsToApprove() {
			
		include "connect.php";
		$sql1 = "Select * from coadmin_reg where status='no'";
		$res1 = mysqli_query($conn, $sql1);
		$output = '';
		$count=0;
		//mysqli_num_rows($res1);
		if(mysqli_num_rows($res1) > 0) {
		while($row=mysqli_fetch_array($res1)) {
			$count = $count+1;
			$output .= '<tr>';
			$output .= '<td>'.$count.'</td>';
			$output .= '<td>'.$row['firstname'].' '.$row['lastname'].'</td>';
			
			$output .= '<td><button class="btn approve" name="approve" id="'.$row['reg_id'].'">Approve</button>&nbsp;';
			$output .= '<button class="btn reject" name="reject" id="'.$row['reg_id'].'">Reject</button></td>';
			$output .= '<td><button class="btn view yetToApprove" name="view" id="'.$row['reg_id'].'"><img src="img/associates/profile.svg"></button></td>';
			$output .= '</tr>';
		}
	}	
	return $output;
}

	function adminsApproved() {
		include "connect.php";
		$sql1 = "Select * from approved_admins";
		$res1 = mysqli_query($conn, $sql1);
		$output = '';
		
		if(mysqli_num_rows($res1) > 0) {
		while($row=mysqli_fetch_array($res1)) {

			$autoapproval = $row['auto_approval'];
			$carousel = $row['carousel'];
			$display = $row['display'];

			if($autoapproval=='yes') {
				$autoapproval = 'checked';
			} else {
				$autoapproval = '';
			}

			if($carousel=='yes') {
				$carousel = 'checked';
			} else {
				$carousel = '';
			}

			if($display=='yes') {
				$display = 'checked';
			} else {
				$display = '';
			}

			$data = array();
			$list = '';
			if($row['allocated_places'] != '') {
				$data = unserialize($row['allocated_places']);
				for($i=0;$i<(sizeof($data)-1);$i=$i+1) {
					$list .= $data[$i].', ';
				} $list .= $data[$i];
			} else {
				$list .= 'Not Allocated any place yet';
			}
			
			$sql2 = "Select * from coadmin_reg where reg_id=".$row['reg_id'];
			$res2 = mysqli_query($conn, $sql2);
			while($row1=mysqli_fetch_array($res2)) {

			$output .= '<tr>';
			$output .= '<td>'.$row['CAID'].'</td>';
			$output .= '<td>'.$row1['firstname'].' '.$row1['lastname'].'</td>';
			$output .= '<td>'.$row1['contact'].'</td>';
			$output .= '<td>'.$row1['email'].'</td>';
			}
			// $output .= '<td><div class="dropdown">
			// 			  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			// 			    Show
			// 			  </button>
			// 			  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">'
			// 			  . $list.
			// 			  '</div>
			// 			</div></td>';
			$output .= '<td>'.$list.'</td>';
			$output .= '<td><form method="POST" action="allocate_place.php">
						<input type="hidden" name="reg_id" value="'.$row['reg_id'].'">
						<button type="submit" class="btn allocate" name="allocate_place" id="'.$row['reg_id'].'">Allocate</button></form></td>';
			$output .= '<td><button class="btn view alreadyApproved" name="view" id="'.$row['reg_id'].'"><img src="img/associates/profile.svg"></button></td>';
			$output .= '<td><input type="checkbox" name="autoapproval" class="form-check-input" id="'.$row['reg_id'].'" '.
			$autoapproval.'> 
   							 <label class="form-check-label" for="autoapproval">Auto-Approve</label><br>

   							 <input type="checkbox" name="carousel" class="form-check-input" id="'.$row['reg_id'].'" '.$carousel.'>
   							 <label class="form-check-label" for="carousel">Carousel</label><br>

   							 <input type="checkbox" name="display" class="form-check-input" id="'.$row['reg_id'].'" '.$display.'>
   							 <label class="form-check-label" for="display">Display</label>
   							 </td>';
			$output .= '</tr>';
		}
	}	
	return $output;
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include "header.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/navbar.css">

	<link rel="stylesheet" href="css/manage_associates.css">
</head>
<body>
	<?php $page='two'; include "navbar.php";?>
	<div class="container-fluid">
		
		<div>
			<div class="pagination-div">
				<ul class="pagination">
					<li class="page-item"><a class="page-link" href="#" id="allocate-admin-link">Admins
						<span class="timer ml-2">
							<?php 
								include "connect.php";
									$sql1 = "Select * from coadmin_reg where status='yes'";
									$res1 = mysqli_query($conn, $sql1);
									echo mysqli_num_rows($res1);
							?>
						</span></a></li>
	   				 <li class="page-item"><a class="page-link active" href="#" id="pending-request-link">Pending Requests
	   				 	<span class="timer ml-2">
	   				 		<?php 
								include "connect.php";
									$sql1 = "Select * from coadmin_reg where status='no'";
									$res1 = mysqli_query($conn, $sql1);
									echo mysqli_num_rows($res1);
							?>
	   				 	</span></a></li>
	   				 
	  			</ul>
			</div>

			<div class="table-responsive" id="pending-request-table">
				<table class="table table-hover table-striped text-center" >
					<thead style="background-color: #303030; color:#fff;">
						<tr>
							<th>SR.NO.</th>
							<th>NAME</th>
							<th>STATUS</th>
							
							<th>PROFILE</th>
						</tr>
					</thead>
						<?php echo adminsToApprove();?>
					
				</table>
			</div>

			<div class="table-responsive" id="allocate-admin-table">
				<table class="table table-hover table-striped">
					<thead style="background-color: #303030; color:#fff;">
						<tr>
							<th>CAID</th>
							<th>NAME</th>
							<th>CONTACT</th>
							<th>EMAIL</th>
							
							<th>ALLOCATED PLACES</th>
							<th>ALLOCATE</th>
							<th>PROFILE</th>
							<th>STATUS</th>
						</tr>
					</thead>	
							<?php echo adminsApproved();?>
						
					
				</table>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="js/manage_coadmins.js"></script>	
</body>
</html>


<!-----------------------------------------------------
					PROFILE MODAL
------------------------------------------------------->


<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Profile</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="text-center">

        	<div id="profile_img" class="mb-3"></div>
        	<h1 id="coadmin_name" class="mb-3"></h1>

			<form action="editAssociateProfile.php" method="POST" id="profileEdit">
				<div id="stats-info-div">
					<div class="input-group mb-3">
		        		<div class="input-group-prepend">
		        			<span class="input-group-text"><b>Ads Added&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
		        		</div>
		        		<input type="text" class="form-control" id="ads_added" name="ads_added" disabled>
		        	</div>

		        	<div class="input-group mb-3">
		        		<div class="input-group-prepend">
		        			<span class="input-group-text"><b>Ads Approved</b></span>
		        		</div>
		        		<input type="text" class="form-control" id="ads_approved" name="ads_approved" disabled>
		        	</div>

		            <div class="input-group mb-3">
		        		<div class="input-group-prepend">
		        			<span class="input-group-text"><b>Standing&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
		        		</div>
		        		<input type="text" class="form-control" id="standing" name="standing" disabled>
		        	</div><hr>
					<h4 style="text-align: left;" class="mb-2">Personal Info</h4>
				</div>


			<div class="input-group mb-3">
        		<div class="input-group-prepend">
        			<span class="input-group-text"><b>Father's Name</b></span>
        		</div>
        		<input type="text" class="form-control" id="faname" name="faname">
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
        			<span class="input-group-text"><b>Date Of Birth&nbsp;</b></span>
        		</div>
        		<input type="text" class="form-control" id="dob" name="dob">
        	</div>

			<div class="input-group mb-3">
        		<div class="input-group-prepend">
        			<span class="input-group-text"><b>Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
        		</div>
        		<input type="text" class="form-control" id="address" name="address">
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
					
        	<div class="float-right edit-button">
				<input type="hidden" name="editId" id="editId">
        		<button type="submit" class="btn edit" name="editProfile" id="editProfile">Edit</button>	
        	</div>
			</form>
        </div>
      </div>

    </div>
  </div>
</div>
<?php
}
?>
