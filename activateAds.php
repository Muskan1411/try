<?php
////////////////////////////APPROVE ADVERTISEMENTS///////////////////////////////
	if(isset($_POST['ad_id'])) {
		include "connect.php";
		$id = $_POST['ad_id'];

		//status = active//
		$sql = "Update advertisements set status='active' where ad_id=".$id." LIMIT 1";
		mysqli_query($conn, $sql);

		$sql1 = "Select * from advertisements where ad_id=".$id." LIMIT 1";
		$res1 = mysqli_query($conn, $sql1);
		while($row1 = mysqli_fetch_array($res1)) {
			$place_name = $row1['place_name'];    //fetch place_name
			$caid = $row1['coadmin_CAID'];       // fetch CAID
		
			//adsAdded_count + 1//
			$sql2 = "Select * from places where place_name='$place_name' LIMIT 1";
			$res2 = mysqli_query($conn, $sql2);
			while($row2 = mysqli_fetch_array($res2)) {
				$count = $row2['adsAdded_count'];
				$count = $count + 1;

				$sql3 = "Update places set adsAdded_count=$count where place_name='$place_name'";
				$status = mysqli_query($conn, $sql3);
			}

			//ads_approved + 1//
			$sql4 = "Select * from approved_admins where CAID='$caid' LIMIT 1";
			$res4 = mysqli_query($conn, $sql4);
			while($row4 = mysqli_fetch_array($res4)) {
				$count = $row4['ads_approved'];
				$count = $count + 1;

				$sql5 = "Update approved_admins set ads_approved = $count where CAID='$caid'";
				$status1 = mysqli_query($conn, $sql5);
			}

			if($status == 1 && $status1 == 1) {
					echo 'Ad activated';
				}
		}

	}


////////////////////////////REJECT ADVERTISEMENTS///////////////////////////////
	if(isset($_POST['ad_remove_id'])) {
		include "connect.php";
		$id = $_POST['ad_remove_id'];

		$sql1 = "Select * from advertisements where ad_id=".$id." LIMIT 1";
		$res1 = mysqli_query($conn, $sql1);
		while($row1=mysqli_fetch_array($res1)) {
			
			$place_name = $row1['place_name'];	//fetch place_name
			$timeslot = $row1['timeslot'];		//fetch timeslot
			
			///delete images from folder
			$img300_600 = 'coadmin/img/advertisements/'.$row1['300*600'];
			$img160_600 = 'coadmin/img/advertisements/'.$row1['160*600'];
			$img728_90 = 'coadmin/img/advertisements/'.$row1['728*90'];
			$img720_300 = 'coadmin/img/advertisements/'.$row1['720*300'];
			if($row1['300*600'] != 'white3.jpg') {
				unlink($img300_600);
			}
			if($row1['160*600'] != 'white2.jpg') {
				unlink($img160_600);
			}
			if($row1['728*90'] != 'white1.jpg') {
				unlink($img728_90);
			}
			if($row1['720*300'] != 'white.jpg') {
				unlink($img720_300);
			}

			//Status = no
			$sql4 = "Update timeslot_places set status='no' where place_name='$place_name' and timeslot=$timeslot";
			mysqli_query($conn, $sql4);
			
		}

		//Delete Ad
		$sql = "Delete from advertisements where ad_id=".$id."";
		$res = mysqli_query($conn, $sql);

		if($res==1) {
			echo "Ad removed";
		}
	}


/////////////////////////////////////Inactive Advertisements////////////////////////////////////////////////
	if(isset($_POST['ad_inactive_id'])) {
		include "connect.php";
		$id = $_POST['ad_inactive_id'];
		
		$sql = "Update advertisements set status='inactive' where ad_id=".$id."";
		$res = mysqli_query($conn, $sql);
		if($res==1) {
			echo "Done";
		} else {
			echo "Not";
		}
	}	
/////////////////////////////////////Active Advertisements////////////////////////////////////////////////
	if(isset($_POST['ad_active_id'])) {
		include "connect.php";
		$id = $_POST['ad_active_id'];
		
		$sql = "Update advertisements set status='active' where ad_id=".$id."";
		$res = mysqli_query($conn, $sql);
		if($res==1) {
			echo "Done";
		} else {
			echo "Not";
		}
	}
/////////////////////////////////////Delete Advertisements////////////////////////////////////////////////
	if(isset($_POST['ad_delete_id'])) {
		include "connect.php";
		$id = $_POST['ad_delete_id'];
		
		$sql1 = "Select * from advertisements where ad_id=".$id." LIMIT 1";
		$res1 = mysqli_query($conn, $sql1);
		while($row1=mysqli_fetch_array($res1)) {
			
			$place_name = $row1['place_name'];	//fetch place_name
			$timeslot = $row1['timeslot'];		//fetch timeslot
			
			///delete images from folder
			$img300_600 = 'coadmin/img/advertisements/'.$row1['300*600'];
			$img160_600 = 'coadmin/img/advertisements/'.$row1['160*600'];
			$img728_90 = 'coadmin/img/advertisements/'.$row1['728*90'];
			$img720_300 = 'coadmin/img/advertisements/'.$row1['720*300'];
			if($row1['300*600'] != 'white3.jpg') {
				unlink($img300_600);
			}
			if($row1['160*600'] != 'white2.jpg') {
				unlink($img160_600);
			}
			if($row1['728*90'] != 'white1.jpg') {
				unlink($img728_90);
			}
			if($row1['720*300'] != 'white.jpg') {
				unlink($img720_300);
			}
			
			//adsAdded_Count - 1
			
			//echo $place_name;
					$sql2 = "Select * from places where place_name='$place_name' LIMIT 1";
					$res2 = mysqli_query($conn, $sql2);
					while($row2 = mysqli_fetch_array($res2)) {
						$ads_AddedCount = $row2['adsAdded_count'] ;
						$ads_AddedCount = $ads_AddedCount- 1;
						//echo $ads_AddedCount;
						$sql3 = "Update places set adsAdded_count =$ads_AddedCount where place_name='$place_name'";
						$res3 = mysqli_query($conn, $sql3);
					}
			

			//Status = no
			$sql4 = "Update timeslot_places set status='no' where place_name='$place_name' and timeslot=$timeslot";
			mysqli_query($conn, $sql4);
			
		}

		//Delete Ad
		$sql = "Delete from advertisements where ad_id=".$id."";
		$res = mysqli_query($conn, $sql);

		if($res==1) {
			echo "Ad removed";
		}
	}
?>