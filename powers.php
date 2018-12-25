<?php

///////////////////Auto Approval/////////////////////////////

	if(isset($_POST['autoapproval_id'])) {
		if(isset($_POST['check'])) {
			include "connect.php";

			$check = $_POST['check']; 
			$id = $_POST['autoapproval_id'];

			$sql1 = "Update approved_admins set auto_approval='$check' where reg_id=$id";
			$status = mysqli_query($conn, $sql1);
			if($status && $check=='yes') {
				echo "Auto-Approved";
			} else {
				echo "Removed from Auto-Approved";
			}	
		}
	}


/////////////////////////Carousel//////////////////////////////

	if(isset($_POST['carousel_id'])) {
		if(isset($_POST['check'])) {
			include "connect.php";

			$check = $_POST['check']; 
			$id = $_POST['carousel_id'];

			$sql2 = "Update approved_admins set carousel='$check' where reg_id=$id";
			$status = mysqli_query($conn, $sql2);
			if($status && $check=='yes') {
				echo "Done";
			} else {
				echo "Done";
			}	
		}
	}


/////////////////////////Carousel//////////////////////////////

	if(isset($_POST['display_id'])) {
		if(isset($_POST['check'])) {
			include "connect.php";

			$check = $_POST['check']; 
			$id = $_POST['display_id'];

			$sql3 = "Update approved_admins set display='$check' where reg_id=$id";
			$status = mysqli_query($conn, $sql3);
			if($status && $check=='yes') {
				echo "Done";
			} else {
				echo "Done";
			}	
		}
	}
	
?>