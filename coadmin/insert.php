<?php
$conn = mysqli_connect('localhost', 'root', 'muskan11', 'KSTask');
if(isset($_POST['image'])) {
			$data = $_POST["image"];

 			$image_array_1 = explode(";", $data);

 			$image_array_2 = explode(",", $image_array_1[1]);

			$data = base64_decode($image_array_2[1]);

			$imageName = 'img/displayed_images/'.time() . '.png';

			file_put_contents($imageName, $data);
			echo '<img src="'.$imageName.'" class="img-thumbnail" />';
}

	if(isset($_POST['submit'])) {

		$fname = mysqli_real_escape_string($conn, $_POST['fname']);
		$lname = mysqli_real_escape_string($conn, $_POST['lname']);
		$mob = mysqli_real_escape_string($conn, $_POST['mob']);
		$mail = mysqli_real_escape_string($conn, $_POST['email']);
		$faname = mysqli_real_escape_string($conn, $_POST['faname']);
		$dob = mysqli_real_escape_string($conn, $_POST['dob']);
		$address = mysqli_real_escape_string($conn, $_POST['address']);
		
		$name = $_FILES['userImg']['name'];
		$allowed_image_extension = array("png","jpg","jpeg");
		$image_extension = pathinfo($name, PATHINFO_EXTENSION);

		if($name != "") {
			if(!in_array($image_extension, $allowed_image_extension)) {
				echo '<script>
						alert("Upload valid image.Only PNG and JPG are allowed.")
						window.location.href = "main.php";
					</script>';
			} else {
				$destination = './img/profile_images/'.$name;
				move_uploaded_file($_FILES['userImg']['tmp_name'], $destination);

				$image = 'img/profile_images/'.$name;
			}
		} else {
			$image = 'img/profile_images/user.svg';
		}

		
			$query = "Insert into coadmin_reg (firstname, lastname, contact, email, image, fatherName, dob, address, status) values ('$fname', '$lname', '$mob', '$mail', '$image', '$faname', '$dob', '$address', 'no')";
			$result = mysqli_query($conn, $query);
			if($result==1) {
				echo '<script>
						alert("Registration successful!! You can login once verified.")
						window.location.href = "main.php";
						</script>';
			}
		
	}
?>