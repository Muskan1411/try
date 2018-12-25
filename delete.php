<?php
	include "conn.php";
	include "function.php";
	if(isset($_POST['user_id'])) {
		$stmt = $conn->prepare(
			"DELETE FROM carouselImages where id='".$_POST['user_id']."'"
		);
		$result = $stmt->execute();
		if(!empty($result)) {
			echo "Deleted Successfully!!";
		}
	}

	if(isset($_POST['reg_id'])) {
		$stmt = $conn->prepare(
			"DELETE FROM coadmin_reg where reg_id='".$_POST['reg_id']."'"
		);
		$result = $stmt->execute();
		if(!empty($result)) {
			echo "Deleted Successfully!!";
		}

	}
?>