
<?php
	include "conn.php";
	include "function.php";
	$output = array();
	$stmt = $conn->prepare("Select * from carouselImages order by id desc");
	$stmt->execute();
	$result = $stmt->fetchAll();
	$data = array();
	$filtered_rows = $stmt->rowCount();
	foreach($result as $row) {
		$image = '';
		if($row['img'] != '') {
			$image = '<img src="upload/'.$row["img"].'" class="img-thumbnail" width="200" height="200">';
		} else {
			$image = '';
		}
		$time = $row['timeslot'];
		$time = $time+2;
		$sub_array = array();
		$sub_array[] = $row['timeslot']."-$time";
		$sub_array[] = $image;
		$sub_array[] = "<button type='button' name='update' id='".$row["id"]."' style='background-color:#901108; color:#fff;' class='btn update table-button'>Edit</button>";

		$sub_array[] = "<button type='button' name='delete' id='".$row["id"]."' style='background-color:#901108; color:#fff;' class='btn delete table-button'>Remove</button>";

		$sub_array[] = $row['timestamp'];
		$data[] = $sub_array;
	}
	$output = array(
		"draw"				=>	intval($_POST['draw']),
		"recordsTotal"		=>	$filtered_rows,
		"recordsFiltered"	=>	get_total_records(),
		"data"				=>	$data
	);

	echo json_encode($output);
?>