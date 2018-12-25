<?php
	if(isset($_POST['id'])) {
		include "connect.php";

		$id = $_POST['id'];
		$output = array();
		$sql = "Select * from advertisements where ad_id=$id";
		$res = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($res)) {
			$output['advertiser_name'] = $row['advertiser_name'];
			$output['description'] = $row['description'];
			$output['place_name'] = $row['place_name'];
			$output['timeslot'] = $row['timeslot'].'-'.($row['timeslot'] + 4);
			$output['img1'] = $row['300*600'];
			$output['img2'] = $row['160*600'];
			$output['img3'] = $row['728*90'];
			$output['img4'] = $row['720*300'];

 		}
 		echo json_encode($output);
	}

?>