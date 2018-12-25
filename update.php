<?php
	include 'conn.php';
	include 'function.php';

	if(isset($_POST['user_id'])) {
		$output = array();
		$stmt = $conn->prepare("Select * from carouselImages where id = '".$_POST['user_id']."' LIMIT 1");
		$stmt -> execute();
		$res = $stmt->fetchAll();
		foreach ($res as $row) {
			$output['adname'] = $row['advertiser_name'];
			$output['desc'] = $row['description'];
			$output['timeslot'] = $row['timeslot'];
			
			$output['img'] = '<img src="upload/'.$row["img1"].'" width="20%" height="50px">
								<input type="hidden" name="hidden_user_image1" value="'.$row["img1"].'" />';
			$output['img1'] = '<img src="upload/'.$row["img2"].'" width="20%" height="50px">
								<input type="hidden" name="hidden_user_image2" value="'.$row["img2"].'" />';
			$output['img2'] = '<img src="upload/'.$row["img3"].'" width="50%" height="50px">
								<input type="hidden" name="hidden_user_image3" value="'.$row["img3"].'" />';
			$output['img3'] = '<img src="upload/'.$row["img"].'" width="40%" height="50px">
								<input type="hidden" name="hidden_user_image" value="'.$row["img"].'" />';

			$output['place'] = $row['place'];
		}
		echo json_encode($output);
	}

?>