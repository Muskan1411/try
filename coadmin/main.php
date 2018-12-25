<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include "header.php";?>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<div class="container h-100">
		<div class="row h-100 justify-content-center align-items-center">
			<div class="col-md-6 col-sm-12 col-12">
				<div class="card">
					<div class="card-heading">
						<div class="row text-center">
							<div class="col-6">
								<a href="#login-form" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-6">
								<a href="#register-form" id="register-form-link">Register</a>
							</div>
						</div>
					</div>
					<hr>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<form action="login.php" method="post" id="login-form">
									
										<div class="input-field">
											<input type="text" name="uname" id="uname" pattern="[A-Za-z0-9]{2,30}" required/>
											<label for="uname">Enter username:</label>
										</div>
										<div class="input-field">
											<input type="password" name="pswd" id="pswd" required/>
											<label for="pswd">Enter Password:</label>
										</div>
										<button type="submit" class="submit-btn" name="login">Login</button>
									
								</form>
								<form action="insert.php" id="register-form" method="POST" enctype="multipart/form-data">
									<div class="input-group justify-content-center" style="position: relative;">
										<div id="profile-container">
										    <image class="upload-button" id="profileImage" src="img/profile_images/user.svg" width="160" height="150"/> 
										    
										</div>
      										 <input id="imageUpload" type="file" name="userImg" style="display: none;">
									</div>

										<div class="input-field">
											<input type="text" name="fname" id="fname" pattern="[A-Za-z]{2,20}" required/>
											<label for="fname">Enter First Name:</label>
										</div>
										<div class="input-field">
											<input type="text" name="lname" id="lname" pattern="[A-Za-z]{2,20}" required/>
											<label for="lname">Enter Last Name:</label>
										</div>
										<div class="input-field">
											<input type="text" name="faname" id="faname" pattern="[A-Za-z 
											-*]{2,20}" required/>
											<label for="faname">Enter Father's Name:</label>
										</div>
										<div class="input-field">
											<input type="text" name="dob" id="dob" pattern="^\d{4}-\d{2}-\d{2}$"required/>
											<label for="dob">Enter DOB:(yyyy-mm-dd)</label>
										</div>
										<div class="input-field">
											<input type="tel" name="mob" id="mob" pattern="[6789][0-9]{9}" required/>
											<label for="mob">Enter Mobile No:</label>
										</div>
										<div class="input-field">
											<input type="email" name="email" id="email" required/>
											<label for="email">Enter Email-Id:</label>
										</div>
										<div class="input-field">
											<input type="text" name="address" id="address" pattern="[a-zA-Z0-9 ,]{2,100}" required/>
											<label for="address">Enter Address:</label>
										</div>
									
										<button type="submit" class="submit-btn" name="submit">Register</button>
									
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<div id="uploadimageModal" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title">Upload & crop image</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-8 text-center">
						<div id="image_demo" style="width: 300px;margin-top:30px"></div>
					</div>
					<div class="col-md-4" style="padding-top: 30px">
						<br><br><br><br>
						<button class="crop_image" style="padding: 1em 4em;">Crop & Upload</button>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
