<?php
session_start();
if(isset($_SESSION['user'])) {
	include "conn.php";
	$output = array();
	$sql = "Select * from approved_admins where username='".$_SESSION['user']."'";
		$res = mysqli_query($conn, $sql);
		while($row=mysqli_fetch_array($res)) {
				$data = array();
			$n=0;
				if($row['allocated_places'] != '') {
					$data = unserialize($row['allocated_places']);
					while($n < sizeof($data)) {
						$output[] = array('place_name' => $data[$n]);
						$n  = $n+1;
					}
					// for($data as $rows) {
					// 	// $list .= '<li class="dropdown-item">'.$data[$i].'</li>';
						
						//$output['place_name'] = $data;

					// }
				} else {
					$output[] = array('place_name' => 'No places yet');
				}
		}
	echo json_encode($output);
}
?>
