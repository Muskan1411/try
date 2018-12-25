<?php
	if(isset($_POST['allocate'])) {
		include "connect.php";
		$id = $_POST['reg_id'];
		
		$places = $_POST['place'];
		$place = serialize($places);
		
		$sql = "Update approved_admins set allocated_places='".$place."' where reg_id =$id";
		mysqli_query($conn, $sql);

			foreach ($places as $place) {
				$sql1 = "Select * from places where place_name='".$place."'";
				$res1 = mysqli_query($conn, $sql1);
				while($row = mysqli_fetch_array($res1)) {
					$sql2 = "Update places set allocation_count=".($row['allocation_count']+1)." where place_name ='".$place."' ";
					mysqli_query($conn, $sql2);
			}
		}

		echo "<script>alert('Allocated.');
			window.location.href = 'manage_coadmins.php';
		</script>";
	}

?>