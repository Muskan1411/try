<?php
session_start();
if(isset($_SESSION['user'])) {
	include "conn.php";
	$output = array();
	$data = json_decode(file_get_contents("php://input"));
	$sql = "Select timeslot from timeslot_places where place_name='".$data->place_name."'  and status='no'";
	$res = mysqli_query($conn, $sql);
	while($row=mysqli_fetch_array($res)) {
		$output[] = $row;
	}
	echo json_encode($output);
}
?>