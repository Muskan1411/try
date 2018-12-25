<?php
	include "connect.php";
	if(isset($_POST['editProfile'])) {
		$faname = $_POST['faname'];
		$mob = $_POST['mobile'];
		$dob = $_POST['dob'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$editID = $_POST['editId'];

		$sql = "Update coadmin_reg set fathername='$faname', contact='$mob',dob='$dob', address='$address', email='$email' where reg_id=$editID ";
		$result = mysqli_query($conn, $sql);
		if($result) {
			echo "<script>
				alert('Updated');
				window.location.href = 'manage_coadmins.php';
			</script>";
		}
	}

?>