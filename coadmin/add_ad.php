<?php
session_start();
if(isset($_SESSION['user'])) {
	include "conn.php";
	if(isset($_POST['action'])) {

		function upload_image($time) {
		if(isset($_FILES['user_image'])) {
			$name = $_FILES["user_image"]['name'];
			$extension = explode('.', $name);
			$newName = $time.".".$extension[1];
			$destination = 'img/advertisements/'.$newName;
			move_uploaded_file($_FILES["user_image"]['tmp_name'], $destination);
			return $newName;
		}
	}

	function upload_image1($time) {
		if(isset($_FILES['user_image'])) {
			$name = $_FILES["user_image1"]['name'];
			$extension = explode('.', $name);
			$newName = $time.".".$extension[1];
			$destination = 'img/advertisements/'.$newName;
			move_uploaded_file($_FILES["user_image1"]['tmp_name'], $destination);
			return $newName;
		}
	}

	function upload_image2($time) {
		if(isset($_FILES['user_image'])) {
			$name = $_FILES["user_image2"]['name'];
			$extension = explode('.', $name);
			$newName = $time.".".$extension[1];
			$destination = 'img/advertisements/'.$newName;
			move_uploaded_file($_FILES["user_image2"]['tmp_name'], $destination);
			return $newName;
		}
	}

	function upload_image3($time) {
		if(isset($_FILES['user_image'])) {
			$name = $_FILES["user_image3"]['name'];
			$extension = explode('.', $name);
			$newName = $time.".".$extension[1];
			$destination = 'img/advertisements/'.$newName;
			move_uploaded_file($_FILES["user_image3"]['tmp_name'], $destination);
			return $newName;
		}
	}
		$advertiser = mysqli_real_escape_string($conn, $_POST['name']);
		$description = mysqli_real_escape_string($conn, $_POST['desc']);
		$place = mysqli_real_escape_string($conn, $_POST['place']);
		$timeslot = mysqli_real_escape_string($conn, $_POST['timeslot']);

		$slot = $timeslot;
		$name = $place.''.$slot;

		if($_FILES['user_image']['name'] != '') {
			
			$image = upload_image($name);
		} else {
			$image = 'white3.jpg';
		}
		
		if($_FILES['user_image1']['name'] != '') {
		
			$image1 = upload_image1($name.'1');
		} else {
			$image1 = 'white2.jpg';
		}
		
		if($_FILES['user_image2']['name'] != '') {
			
			$image2 = upload_image2($name.'2');
		} else {
			$image2 = 'white1.jpg';
		}
		
		if($_FILES['user_image3']['name'] != '') {
		
			$image3 = upload_image3($name.'3');
		} else {
			$image3 = 'white.jpg';
		}
		
		// timestamp //
		date_default_timezone_set('Asia/Kolkata');
			$currTime = date('Y-m-d H:i');

		$status = 'no';
		// CAID //
		$sql = "Select * from approved_admins where username='".$_SESSION['user']."' ";
		$res = mysqli_query($conn, $sql);
		while($row=mysqli_fetch_array($res)) {
			$caid = $row['CAID'];
			$ads_added = $row['ads_added'];
			$ads_approved = $row['ads_approved'];
			$auto_approval = $row['auto_approval'];
			if($auto_approval=='yes') {
				$ads_approved = $ads_approved + 1;
				$status = 'active';
			}
			$ads_added = $ads_added + 1; 

			$sql4 = "Update approved_admins set ads_added=$ads_added, ads_approved=$ads_approved where CAID='$caid'";
			mysqli_query($conn, $sql4);
		}
	
		$sql2 = "Insert into advertisements (advertiser_name, description,coadmin_CAID,place_name,`300*600`,`160*600`,`728*90`,`720*300`,timeslot,timestamp,status) values ('$advertiser', '$description', '$caid', '$place', '$image', '$image1', '$image2', '$image3', $timeslot, '$currTime', '$status')";
		$status = mysqli_query($conn, $sql2);

		$sql3 = "Update timeslot_places set status='blocked' where place_name='$place' and timeslot=$timeslot";
		mysqli_query($conn, $sql3);
		
		
		if($status == 1) {
			echo "<script>alert('AD has been sent for approval.');
				window.location.href = 'sidebar.php';
			</script>";
		} else {
			echo "Ferf";
		}
	} 
}
?>