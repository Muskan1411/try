<?php
	include "connect.php";

	if(isset($_POST['reg_id'])) {
		$output = array();
		$sql = "Select * from coadmin_reg where reg_id='".$_POST['reg_id']."' LIMIT 1";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_array($result)) {
				$output['regId'] = $row['reg_id'];
				$output['fname'] = $row['firstname'];
				$output['lname'] = $row['lastname'];
				$output['mob'] = $row['contact'];
				$output['mail'] = $row['email'];
				$output['img'] = $row['image'];
				$output['dob'] = $row['dob'];
				$output['faname'] = $row['fatherName'];
				$output['address'] = $row['address'];
			}
		}
		$sql1 = "Select * from approved_admins where reg_id=".$_POST['reg_id']." LIMIT 1";
		$result1 = mysqli_query($conn, $sql1);
		while($row = mysqli_fetch_array($result1)) {
			$output['ads_added'] = $row['ads_added'];
			$output['ads_approved'] = $row['ads_approved'];
			if($row['ads_approved'] != 0) {
				$standing = ($row['ads_approved']/$row['ads_added'])*100;
				$output['standing'] = $standing.'%';
			} else {
				$output['standing'] = '0%';
			}
 		}
		echo json_encode($output);
	}
?>