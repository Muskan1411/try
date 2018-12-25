<?php
	include "connect.php";

	$sql = "Select * from places order by place_name";
	$res = mysqli_query($conn, $sql);

	$output = array();

	while($row = mysqli_fetch_array($res)) {
		$output[] = array('place_name' => $row['place_name']);
	}

	echo json_encode($output);

?>