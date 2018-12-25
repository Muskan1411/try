`	<?php
	include "conn.php";
	include "function.php";
	if(isset($_POST["operation"]))
	{
		if($_POST["operation"] == "UPLOAD"){
			$image = '';
			$timeslot = $_POST['timeslot'];
			$name = $_POST['name'];
			$desc = $_POST['desc'];

			$stmt1 = $conn->prepare("Select * from carouselImages");
			$stmt1->execute();
			$res = $stmt1->fetchAll();
			$p = 0;
			foreach($res as $row) {
				$ts = $row['timeslot'];
				if($ts == $timeslot) {
					$p = 1;
					break;
				}
			}
			$place = $_POST['place'];
			$place = join(',',$place);
			date_default_timezone_set('Asia/Kolkata');
				
				$slot = intval($timeslot/3);
				$time = $slot*4;
			if($p!=1) {
			if($_FILES['user_image']['name'] != '') {
				$image = upload_image($time+1);
			}
			if($_FILES['user_image1']['name'] != '') {
				$image1 = upload_image1($time+2);
			}
			if($_FILES['user_image2']['name'] != '') {
				$image2 = upload_image2($time+3);
			}
			if($_FILES['user_image3']['name'] != '') {
				$image3 = upload_image3($time);
			}
			
			date_default_timezone_set('Asia/Kolkata');
			$currTime = date('Y-m-d H:i');

			$stmt = $conn->prepare("Insert into carouselImages (advertiser_name,description,timeslot,img,img1,img2,img3,timestamp,place) values ('$name','$desc','$timeslot', '$image3','$image','$image1','$image2', '$currTime', '$place')");
			$result = $stmt->execute();
			} 
			if(!empty($result)) {
				echo "Ad has been Added Successfully!!!";
			}
		}

		if($_POST["operation"] == "Edit") {
			$image = '';
			$timeslot = $_POST['timeslot'];
				if($_FILES['user_image']['name'] != '') {
				$image = upload_image($time+1);
				}else {
					$image = $_POST["hidden_user_img"];
				}
				if($_FILES['user_image1']['name'] != '') {
					$image1 = upload_image1($time+2);
				}else {
					$image1 = $_POST["hidden_user_img"];
				}
				if($_FILES['user_image2']['name'] != '') {
					$image2 = upload_image2($time+3);
				}else {
					$image2 = $_POST["hidden_user_img"];
				}
				if($_FILES['user_image3']['name'] != '') {
					$image3 = upload_image3($time);
				} else {
					$image3 = $_POST["hidden_user_img"];
				}
				$adname = $_POST['name'];
				$desc = $_POST['desc'];
				$place = $_POST['place'];
				$place = join(',',$place);
				$id = $_POST['user_id'];

				date_default_timezone_set('Asia/Kolkata');
				$currTime = date('Y-m-d H:i');

				$stmt = $conn->prepare("Update carouselImages set advertiser_name='$adname', description='$desc', timeslot='$timeslot',  img='$image3',img1='$image',img2='$image1',img3='$image2',timestamp='$currTime',place='$place' where id='$id'");
				$result = $stmt->execute();
				if(!empty($result)) {
					echo "data inserted";
				}
		}
	}	
?>