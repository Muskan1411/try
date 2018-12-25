<?php
	include "conn.php";
	if(isset($_POST['profile_uname'])) {
		$uname = $_POST['profile_uname'];
		$sql1 = "Select * from coadmin_reg where username='$uname'";
		$res1 = mysqli_query($conn, $sql1);

		$output = array();

		while($row = mysqli_fetch_array($res1)) {
			$output['name'] = $row['firstname'].' '.$row['lastname'];
			
			$output['contact'] = $row['contact'];
			$output['email'] = $row['email'];
			$output['image'] = $row['image'];
			$output['fatherName'] = $row['fatherName'];
			$output['dob'] = $row['dob'];
			$output['address'] = $row['address'];
			$output['password'] = $row['password'];
		}

		echo json_encode($output);
	}

	function allocated_places($user) {
		include "conn.php";
		$sql1 = "Select * from approved_admins where username='$user'";
		$res1 = mysqli_query($conn, $sql1);

		$places = array();
		$output = '';

		while($row=mysqli_fetch_array($res1)) {
			$allocated_places = $row['allocated_places'];
		}
		if($allocated_places != '') {
			$places = unserialize($allocated_places);
		}

		for($i=0; $i<sizeof($places); $i=$i+1) {
			$output .= $places[$i].'<hr>';
		}

		return $output;
	}

	?>