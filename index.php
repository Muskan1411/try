<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "header.php";?>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Archivo' rel='stylesheet'>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
</head>
<body>
	<div class="container-fluid text-center">
		<div class="row">
			<div class="col-md-6 col-xs-9 col-xl-5 center">
				
				<div class="card"  id="back-card">
					<div class="card-body">
						<div id="head">
							<h1 class="heading">LOGIN</h1>
						</div>
						
						<form method="POST"">

							<div class="input-group form-group" style="margin-top: 20px; margin-bottom: 25px;">
								<div class="input-group-prepend">
									<span class="input-group-text" style="background: inherit;"><i class="fa fa-user"></i></span>
								</div>
								<input type="text" name="username" class="form-control effect-1" placeholder="Enter username" required>
								<span class="focus-border"></span>
							</div>

							<div class="input-group form-group" ng-app="show_hide_pswd"  ng-controller="show_hide_pswd_ctrl" style="margin-bottom: 25px;">
								<div class="input-group-prepend">
									<span class="input-group-text" style="background-color: inherit;"><i class="fa fa-lock"></i></span>
								</div>
								<input type="{{inputType}}" name="pswd" class="form-control effect-1" ng-model="pswd_field" placeholder="Enter password" required>
								<div class="input-group-append">
									<span class="input-group-text mt-2" style="background-color: inherit;">
										<label ng-click="showPassword()" style="cursor: pointer;font-size:14px;">{{showHideClass}}</label>
									</span>
								</div>
								<span class="focus-border"></span>
							</div>

							<button type="submit" name='login' class="btnn form-control pt-3 pb-3"><i class="fa fa-sign-in-alt" style="padding-right: 3px;"></i>Login</button>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		if(isset($_POST['login'])) {
			$name = $_POST['username'];
			$pswd = $_POST['pswd'];
			if($name == 'Admin' && $pswd == 'Admin14') {
				session_start();
				$_SESSION['uname'] = $name;
				header("Location: manage_coadmins.php");
			} else {
				echo "<script>
						alert('Incorrect details!!');
						window.location.href = window.location.href;
					</script>";
			}
		}
	?>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript">
		var app = angular.module("show_hide_pswd", []);
		app.controller("show_hide_pswd_ctrl", function($scope) {
			$scope.inputType = 'password';
			$scope.showHideClass = 'HIDE';
			$scope.showPassword = function () {
				if($scope.pswd_field != null) {
					if($scope.inputType == 'password') {
						$scope.inputType = 'text';
						$scope.showHideClass = 'SHOW';
					} else {
						$scope.inputType = 'password';
						$scope.showHideClass = 'HIDE';
					}
				}
			}
		});
	</script>
	
</body>
</html>