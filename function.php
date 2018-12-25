<?php
	function get_total_records()
	{
		include "conn.php";
		$stmt = $conn->prepare("Select * from carouselImages");
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $stmt->rowCount();
	}
	function upload_image3($time) {
		
		if(isset($_FILES['user_image3'])) {
			$name = $_FILES['user_image3']['name'];
			$extension = explode(".", $name);
			$newName = $time.".".$extension[1];
			$destination = './upload/'.$newName;
			move_uploaded_file($_FILES['user_image3']['tmp_name'], $destination);
			return $newName;
		}	
	}
	function upload_image($time) {	
		if(isset($_FILES['user_image'])) {
			$name = $_FILES['user_image']['name'];
			$extension = explode(".", $name);
			$newName = $time.".".$extension[1];
			$destination = './upload/'.$newName;
			move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
			return $newName;
		}
	}
	function upload_image1($time) {	
		if(isset($_FILES['user_image1'])) {
			$name = $_FILES['user_image1']['name'];
			$extension = explode(".", $name);
			$newName = $time.".".$extension[1];
			$destination = './upload/'.$newName;
			move_uploaded_file($_FILES['user_image1']['tmp_name'], $destination);
			return $newName;
		}
	}
	function upload_image2($time) {	
		if(isset($_FILES['user_image2'])) {
			$name = $_FILES['user_image2']['name'];
			$extension = explode(".", $name);
			$newName = $time.".".$extension[1];
			$destination = './upload/'.$newName;
			move_uploaded_file($_FILES['user_image2']['tmp_name'], $destination);
			return $newName;
		}	
	}
?>