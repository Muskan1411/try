<?php
function owl_carousel1() {
		include "connect.php";
		$sql = "Select * from advertisements where status='no'";
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
				
				$output .= '<div class="item"><div class="card text-center"><div class="card-header">'.$advertiser.'</div>';
				$output .= '<div class="card-body"><form method="POST">
							<span class="body-subhead">Associate Info(Added BY)</span>

							<input type="hidden" name="associate_id" value="'.$caid.'">
							<button type="button" class="btn more view_profile" name="associate-more" id="'.$reg_id.'">
								<img src="img/more.svg">
							</button><br>
							NAME:'.$name.'<br>ID: '.$caid.'<br>
							<br>

							<span class="body-subhead">Advertisement Info</span>
							<input type="hidden" name="advert_id" value="'.$adID.'">
							<button type="submit" class="btn more" name="advert-more" id="advert-more" data-toggle="modal" data-target="#myADModal">
								<img src="img/more.svg">
							</button>
							<br>

							PLACE:'.$place_name.'<br>TIMESLOT:'.$timeslot.'<br>TIMESTAMP:'.$timestamp.'
							</form>
							</div>';

				$output .= '<hr><div class="card-footer">
								<button type="submit" class= "float-right btnn remove remove_before_approve ml-1" id='.$adID.'>Remove</button>
								<button type="submit" class= "float-right btnn approve" id='.$adID.'>Approve</button>
								
								</div>
							</div></div>';
	}
}
return $output;
}

///////////////////////RETURN ACTIVE ADS/////////////////////////////
function owl_carousel2() {
	include "connect.php";
	$sql = "Select * from advertisements where status='active'";
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
				
				$output .= '<div class="item"><div class="card text-center"><div class="card-header">'.$advertiser.'</div>';
				$output .= '<div class="card-body"><form method="POST">
							<span class="body-subhead">Associate Info(Added BY)</span>

							<input type="hidden" name="associate_id" value="'.$caid.'">
							<button type="button" class="btn more view_profile" name="associate-more" id="'.$reg_id.'">
								<img src="img/more.svg">
							</button><br>
							NAME:'.$name.'<br>ID: '.$caid.'<br>
							<br>

							<span class="body-subhead">Advertisement Info</span>
							<input type="hidden" name="advert_id" value="'.$adID.'">
							<button type="submit" class="btn more" name="advert-more" id="advert-more" data-toggle="modal" data-target="#myADModal">
								<img src="img/more.svg">
							</button>
							<br>

							PLACE:'.$place_name.'<br>TIMESLOT:'.$timeslot.'<br>TIMESTAMP:'.$timestamp.'
							</form>
							</div>';

				$output .= '<hr><div class="card-footer">
								
								<button type="submit" class= "float-right btnn inactive" id="'.$adID.'">Inactive</button>
								
								</div>
							</div></div>';
	}
}
return $output;
}


///////////////////////RETURN INACTIVE ADS/////////////////////////////
function owl_carousel3() {
	include "connect.php";
	$sql = "Select * from advertisements where status='inactive'";
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
				
				$output .= '<div class="item"><div class="card text-center"><div class="card-header">'.$advertiser.'</div>';
				$output .= '<div class="card-body"><form method="POST">
							<span class="body-subhead">Associate Info(Added BY)</span>

							<input type="hidden" name="associate_id" value="'.$caid.'">
							<button type="button" class="btn more view_profile" name="associate-more" id="'.$reg_id.'">
								<img src="img/more.svg">
							</button><br>
							NAME:'.$name.'<br>ID: '.$caid.'<br>
							<br>

							<span class="body-subhead">Advertisement Info</span>
							<input type="hidden" name="advert_id" value="'.$adID.'">
							<button type="submit" class="btn more" name="advert-more" id="advert-more" data-toggle="modal" data-target="#myADModal">
								<img src="img/more.svg">
							</button>
							<br>

							PLACE:'.$place_name.'<br>TIMESLOT:'.$timeslot.'<br>TIMESTAMP:'.$timestamp.'
							</form>
							</div>';

				$output .= '<hr><div class="card-footer">
								<button type="submit" class= "float-right btnn remove remove_after_approve" id="'.$adID.'">Remove</button>
								<button type="submit" class= "float-right btnn approve mr-1" id="'.$adID.'">Active</button>
								
								</div>
							</div></div>';
	}
}
return $output;
}

/////////////////////////////////// VIEW AD MODAL DATA ///////////////////////////////////////////
if(isset($_POST['ad_id']) || isset($_POST['ad_edit_id'])) {
		include "connect.php";
		
		if(isset($_POST['ad_id'])) {
			$ad_id = $_POST['ad_id'];
		}
		if(isset($_POST['ad_edit_id'])) {
			$ad_id = $_POST['ad_edit_id'];
		}
		$sql = "Select * from advertisements where ad_id=$ad_id LIMIT 1";
		$res = mysqli_query($conn,$sql);
		$output = array();
		while($row=mysqli_fetch_array($res)) {
			$output['place_name'] = $row['place_name'];
			$output['advertiser_name'] = $row['advertiser_name'];
			$output['description'] = $row['description'];
			$output['timeslot'] = $row['timeslot'];
			$output['image300_600'] = $row['300*600'];
			$output['image160_600'] = $row['160*600'];
			$output['image728_90'] = $row['728*90'];
			$output['image720_300'] = $row['720*300'];

			// $output .= '<div id="demo" class="carousel slide" data-ride="carousel">

						 
			// 				<div class="carousel-inner">
			// 				    <div class="carousel-item active">'.
			// 				      '<img src="coadmin/img/advertisements/'.$image300_600.'" alt="Los Angeles">
			// 				    </div>';
			// $output .=  '<div class="carousel-item">
			//       			<img src="coadmin/img/advertisements/'.$image160_600.'" alt="Chicago">
			//     		</div>';

			// $output .=  '<div class="carousel-item">
			//      			 <img src="coadmin/img/advertisements/'.$image728_90.'" alt="New York">
			//     		</div>';
			// $output .=  '<div class="carousel-item">
			//      			 <img src="coadmin/img/advertisements/'.$image720_300.'" alt="New York">
			//     		</div>    		
			//     		</div>';    		
			  

			  
			// $output .=  '<a class="carousel-control-prev" href="#demo" data-slide="prev">
			//    			 <span class="carousel-control-prev-icon"></span>
			//  			</a>
			// 			<a class="carousel-control-next" href="#demo" data-slide="next">
			// 		     <span class="carousel-control-next-icon"></span>
			// 	     	</a>
			// 			</div>';
		}
		echo json_encode($output);
	}


//////////////////////////////	VIEW PROFILE MODAL DATA//////////////////////////////////

if(isset($_POST['reg_id'])) {
	include "connect.php";
	$output = array();

	$reg_id = $_POST['reg_id'];

	$sql = "Select * from coadmin_reg where reg_id=".$reg_id." LIMIT 1";
	$result = mysqli_query($conn,$sql);
	while($row=mysqli_fetch_array($result)) {
		$output['fname'] = $row['firstname'];
		$output['lname'] = $row['lastname'];
		$output['mob'] = $row['contact'];
		$output['mail'] = $row['email'];
	}

	$sql2 = "Select * from approved_admins where reg_id=".$reg_id." LIMIT 1";
	$result2 = mysqli_query($conn, $sql2);
	while($row2=mysqli_fetch_array($result2)) {
		$output['ads_added'] = $row2['ads_added'];

		$data = array();
		$place = '';

		$data = unserialize($row2['allocated_places']);
		for($i=0; $i<(sizeof($data) - 1); $i=$i+1) {
			$place .= $data[$i].',';
		} $place .= $data[$i];

		$output['allocated_places'] = $place;
	}
	echo json_encode($output);
}
?>


