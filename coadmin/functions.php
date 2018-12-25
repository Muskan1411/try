<?php
session_start();
if(isset($_SESSION['user'])) {

function get_name() {
	include "conn.php";
		$sql1 = "Select * from coadmin_reg where username='".$_SESSION['user']."' LIMIT 1";
		$res1 = mysqli_query($conn, $sql1);
		$output = '';
		while($row = mysqli_fetch_array($res1)) {
			$firstname = $row['firstname'];
			$lastname = $row['lastname'];
			$output .= $firstname.' '.$lastname;
		}

		return $output;
}
function get_caid() {
	include "conn.php";
	$sql1 = "Select * from approved_admins where username='".$_SESSION['user']."' LIMIT 1";
		$res1 = mysqli_query($conn, $sql1);
		$caid = '';
		while($row = mysqli_fetch_array($res1)) {
			$caid .= $row['CAID'];
		}
		return $caid;
}
function nav_tabs() {
		include "conn.php";

		$sql1 = "Select * from approved_admins where username='".$_SESSION['user']."' LIMIT 1";
		$res1 = mysqli_query($conn, $sql1);
		$output = '';
		while($row = mysqli_fetch_array($res1)) {
			$adsmania = $row['carousel'];
			$adhub = $row['display'];
	  		if($adhub == 'yes') {
	  			$output .= '<a href="#" class="list-group-item pb-2 border-bottom">
                  				<h4 class="	fa fa-arrows"></h4><span class="hidden-xs"> ADHUB</span>
               				</a>';
	  							// $output .= '<li class="nav-item"><a href="#adhub" class="nav-link active" data-toggle="tab">ADHUB</a></li>';
	  		}
			if($adsmania == 'yes') {
	  			$output .=  '<a href="#" class="list-group-item pb-2 border-bottom">
                  				<h4 class="	fa fa-arrows"></h4><span class="hidden-xs"> ADSMANIA</span>
               				</a>';
	  							// $output .= '<li class="nav-item"><a href="#adsmania" class="nav-link" data-toggle="tab">ADSMANIA</a></li>';
	  		}
	  	}
	  	return $output;
	}
}
?>