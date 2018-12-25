<?php
	
	if(isset($_POST['place'])) {
	
		$conn = mysqli_connect('localhost', 'root', 'muskan11', 'KSTask');
		$place = $_POST['place'];
		$res = mysqli_query($conn,"Select * from places where place_name='".$place."'");
		
		if(!(mysqli_num_rows($res)>0)) { 
			$stmt1 = $conn->prepare("Insert into places (place_name) values ('$place')");
			$result = $stmt1->execute();
			$timeslot = 0;
			for($i=0; $i<20; $i=$i+1) {

				$sql2 = "Insert into timeslot_places (place_name, timeslot, status) values ('$place', $timeslot, 'no')";
				$res2 = mysqli_query($conn, $sql2);
				$timeslot = $timeslot+3;
			}
			echo "Place Added to the list";
		
		} else {
			echo "Place already exits in list";
		}
		
	}
?>