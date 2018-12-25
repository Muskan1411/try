<?php
	if(isset($_POST['username']) && isset($_POST['pswd'])) {
		include "conn.php";
		$username = $_POST['username'];
		$pswd = $_POST['pswd'];
		$sql1 = "Update approved_admins set password = '$pswd' where username = '$username'";
		$res1 = mysqli_query($conn, $sql1);

		$sql2 = "Update coadmin_reg set password = '$pswd' where username = '$username'";
		$res2 = mysqli_query($conn, $sql2);

		if($res1 && $res2) {
			echo "Password Changed!!!";
		}
	}
?>