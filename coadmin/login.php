<?php
	$conn = mysqli_connect('localhost', 'root', 'muskan11', 'KSTask');
	if(isset($_POST['login'])) {
		$uname = $_POST['uname'];
		$pswd = $_POST['pswd'];
		$sql = "Select username,password from coadmin_reg where username <> ''";
		$res=mysqli_query($conn, $sql);

		$p=0;
		while($row=mysqli_fetch_array($res)) {
			if($uname==$row['username'] && $pswd==$row['password']) {
				$p=1;
				session_start();
				$_SESSION['user'] = $uname;
				break;	
			}
		}
		if($p!=1) {
			echo '<script>alert("No such user");
			window.location.href = "main.php";
			</script>';
		} else {
			header("Location: sidebar.php");
		}
	}
?>