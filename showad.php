<?php
//////////////////////Get Selected Place///////////////////////////////
////////////////////////////////////////////////////////////////////
function getPlace() {	
	include "connect.php";

	$place = '';
	if(isset($_POST['search'])) {
		$place = $_POST['place_name'];
	} else {
		$sql = "Select * from places order by place_name LIMIT 1";
		$res = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($res)) {
			$place = $row['place_name'];
		}
	}
	return $place;
}

//////////////////////Get Current Slot///////////////////////////////
////////////////////////////////////////////////////////////////////
function calculateCurrentSlot() {
	date_default_timezone_set('Asia/Kolkata');
	$min = date('i');
	$slot = intval($min/3); 
	return $slot;
}

//////////////////////728*90 Size///////////////////////////////
////////////////////////////////////////////////////////////////////
function make_slides2() {
	include "connect.php";
	///variables///
	$timeslot = array();
	$image = array();
	$count = 0; $tempSlot = 0;
	$i = 0; $output = '';
	$place = getPlace();

	$sql2 = "Select * from advertisements where place_name='$place' and status='active' order by timeslot";
	$res2 = mysqli_query($conn, $sql2);

	$slot = calculateCurrentSlot();

	if(mysqli_num_rows($res2)>0) {
		while($row2 = mysqli_fetch_array($res2)) {
			$timeslot[] = $row2['timeslot'];
			$image[] = $row2['728*90'];
		}
		$size = sizeof($timeslot);
		
		while($count<20) {
			while($tempSlot <= $timeslot[$i]) {

				if($count == $slot) {
					$output .= '<div class="carousel-item active" data-interval="180000"><a href="#" target="_blank">';
				} else {
					$output .= '<div class="carousel-item" data-interval="180000"><a href="#" target="_blank">';
				}

				if($tempSlot == $timeslot[$i]) {
					$output .= ' <img class="d-block w-100 carousel_img" src="coadmin/img/advertisements/'.$image[$i].'" alt="'.$count.'" 
					id="'.$count.'"></a></div>';
					if($i<$size-1) {
						$i = $i + 1;
					}
				}
				else {
					$output .= '
					<img class="d-block w-100 carousel_img" src="coadmin/img/advertisements/white1.jpg" alt="'.$count.'" id="'.$count.'"></a>
					</div>';		
				}
				$tempSlot = $tempSlot + 3;
				$count = $count+1;
			}
			if($count == $slot) {
				$output .= '<div class="carousel-item active" data-interval="180000"><a href="#" target="_blank">';
			} else {
				$output .= '<div class="carousel-item" data-interval="180000"><a href="#" target="_blank">';
			}	

				
			$output .= '
				<img class="d-block w-100 carousel_img" src="coadmin/img/advertisements/white1.jpg" alt="'.$count.'" id="'.$count.'"></a>
				</div>';		
			$count = $count + 1;
		}
	} 
		else 
	{
		while($count<20) {
			if($count == $slot) {
				$output .= '<div class="carousel-item active" data-interval="180000"><a href="#" target="_blank">';
			} else {
				$output .= '<div class="carousel-item" data-interval="180000"><a href="#" target="_blank">';
			}	

			$output .= '
			<img class="d-block w-100 carousel_img" src="coadmin/img/advertisements/white1.jpg" alt="'.$count.'" id="'.$count.'"></a>						</div>';
			$count = $count + 1;
		}
	}
	return $output;
}


//////////////////////160*600 Size///////////////////////////////
////////////////////////////////////////////////////////////////////
function make_slides3() {
	include "connect.php";
	///variables///
	$timeslot = array();
	$image = array();
	$count = 0; $tempSlot = 0;
	$i = 0; $output = '';
	$place = getPlace();

	$sql2 = "Select * from advertisements where place_name='$place' and status='active' order by timeslot";
	$res2 = mysqli_query($conn, $sql2);

	$slot = calculateCurrentSlot();

	if(mysqli_num_rows($res2)>0) {
		while($row2 = mysqli_fetch_array($res2)) {
			$timeslot[] = $row2['timeslot'];
			$image[] = $row2['160*600'];
		}
		$size = sizeof($timeslot);
		
		while($count<20) {
			while($tempSlot <= $timeslot[$i]) {

				if($count == $slot) {
					$output .= '<div class="carousel-item active" data-interval="180000"><a href="#" target="_blank">';
				} else {
					$output .= '<div class="carousel-item" data-interval="180000"><a href="#" target="_blank">';
				}

				if($tempSlot == $timeslot[$i]) {
					$output .= ' <img class="d-block w-100 carousel_img" src="coadmin/img/advertisements/'.$image[$i].'" alt="'.$count.'" 
					id="'.$count.'"></a></div>';
					if($i<$size-1) {
						$i = $i + 1;
					}
				}
				else {
					$output .= '
					<img class="d-block w-100 carousel_img" src="coadmin/img/advertisements/white2.jpg" alt="'.$count.'" id="'.$count.'"></a>
					</div>';		
				}
				$tempSlot = $tempSlot + 3;
				$count = $count+1;
			}
			if($count == $slot) {
				$output .= '<div class="carousel-item active" data-interval="180000"><a href="#" target="_blank">';
			} else {
				$output .= '<div class="carousel-item" data-interval="180000"><a href="#" target="_blank">';
			}	

				
			$output .= '
				<img class="d-block w-100 carousel_img" src="coadmin/img/advertisements/white2.jpg" alt="'.$count.'" id="'.$count.'"></a>
				</div>';		
			$count = $count + 1;
		}
	} 
		else 
	{
		while($count<20) {
			if($count == $slot) {
				$output .= '<div class="carousel-item active" data-interval="180000"><a href="#" target="_blank">';
			} else {
				$output .= '<div class="carousel-item" data-interval="180000"><a href="#" target="_blank">';
			}	

			$output .= '
			<img class="d-block w-100 carousel_img" src="coadmin/img/advertisements/white2.jpg" alt="'.$count.'" id="'.$count.'"></a>						</div>';
			$count = $count + 1;
		}
	}
	return $output;
}


//////////////////////300*600 Size///////////////////////////////
////////////////////////////////////////////////////////////////////
function make_slides4() {
	include "connect.php";
	///variables///
	$timeslot = array();
	$image = array();
	$count = 0; $tempSlot = 0;
	$i = 0; $output = '';
	$place = getPlace();

	$sql2 = "Select * from advertisements where place_name='$place' and status='active' order by timeslot";
	$res2 = mysqli_query($conn, $sql2);

	$slot = calculateCurrentSlot();

	if(mysqli_num_rows($res2)>0) {
		while($row2 = mysqli_fetch_array($res2)) {
			$timeslot[] = $row2['timeslot'];
			$image[] = $row2['300*600'];
		}
		$size = sizeof($timeslot);
		
		while($count<20) {
			while($tempSlot <= $timeslot[$i]) {

				if($count == $slot) {
					$output .= '<div class="carousel-item active" data-interval="180000"><a href="#" target="_blank">';
				} else {
					$output .= '<div class="carousel-item" data-interval="180000"><a href="#" target="_blank">';
				}

				if($tempSlot == $timeslot[$i]) {
					$output .= ' <img class="d-block w-100 carousel_img" src="coadmin/img/advertisements/'.$image[$i].'" alt="'.$count.'" 
					id="'.$count.'"></a></div>';
					if($i<$size-1) {
						$i = $i + 1;
					}
				}
				else {
					$output .= '
					<img class="d-block w-100 carousel_img" src="coadmin/img/advertisements/white3.jpg" alt="'.$count.'" id="'.$count.'"></a>
					</div>';		
				}
				$tempSlot = $tempSlot + 3;
				$count = $count+1;
			}
			if($count == $slot) {
				$output .= '<div class="carousel-item active" data-interval="180000"><a href="#" target="_blank">';
			} else {
				$output .= '<div class="carousel-item" data-interval="180000"><a href="#" target="_blank">';
			}	

				
			$output .= '
				<img class="d-block w-100 carousel_img" src="coadmin/img/advertisements/white3.jpg" alt="'.$count.'" id="'.$count.'"></a>
				</div>';		
			$count = $count + 1;
		}
	} 
		else 
	{
		while($count<20) {
			if($count == $slot) {
				$output .= '<div class="carousel-item active" data-interval="180000"><a href="#" target="_blank">';
			} else {
				$output .= '<div class="carousel-item" data-interval="180000"><a href="#" target="_blank">';
			}	

			$output .= '
			<img class="d-block w-100 carousel_img" src="coadmin/img/advertisements/white3.jpg" alt="'.$count.'" id="'.$count.'"></a>						</div>';
			$count = $count + 1;
		}
	}
	return $output;
}


//////////////////////728*90 Size///////////////////////////////
////////////////////////////////////////////////////////////////////
function make_slides1() {
	include "connect.php";
	///variables///
	$timeslot = array();
	$image = array();
	$count = 0; $tempSlot = 0;
	$i = 0; $output = '';
	$place = getPlace();

	$sql2 = "Select * from advertisements where place_name='$place' and status='active' order by timeslot";
	$res2 = mysqli_query($conn, $sql2);

	$slot = calculateCurrentSlot();

	if(mysqli_num_rows($res2)>0) {
		while($row2 = mysqli_fetch_array($res2)) {
			$timeslot[] = $row2['timeslot'];
			$image[] = $row2['720*300'];
		}
		$size = sizeof($timeslot);
		
		while($count<20) {
			while($tempSlot <= $timeslot[$i]) {

				if($count == $slot) {
					$output .= '<div class="carousel-item active" data-interval="180000"><a href="#" target="_blank">';
				} else {
					$output .= '<div class="carousel-item" data-interval="180000"><a href="#" target="_blank">';
				}

				if($tempSlot == $timeslot[$i]) {
					$output .= ' <img class="d-block w-100 carousel_img" src="coadmin/img/advertisements/'.$image[$i].'" alt="'.$count.'" 
					id="'.$count.'"></a></div>';
					if($i<$size-1) {
						$i = $i + 1;
					}
				}
				else {
					$output .= '
					<img class="d-block w-100 carousel_img" src="coadmin/img/advertisements/white.jpg" alt="'.$count.'" id="'.$count.'"></a>
					</div>';		
				}
				$tempSlot = $tempSlot + 3;
				$count = $count+1;
			}
			if($count == $slot) {
				$output .= '<div class="carousel-item active" data-interval="180000"><a href="#" target="_blank">';
			} else {
				$output .= '<div class="carousel-item" data-interval="180000"><a href="#" target="_blank">';
			}	

				
			$output .= '
				<img class="d-block w-100 carousel_img" src="coadmin/img/advertisements/white.jpg" alt="'.$count.'" id="'.$count.'"></a>
				</div>';		
			$count = $count + 1;
		}
	} 
		else 
	{
		while($count<20) {
			if($count == $slot) {
				$output .= '<div class="carousel-item active" data-interval="180000"><a href="#" target="_blank">';
			} else {
				$output .= '<div class="carousel-item" data-interval="180000"><a href="#" target="_blank">';
			}	

			$output .= '
			<img class="d-block w-100 carousel_img" src="coadmin/img/advertisements/white.jpg" alt="'.$count.'" id="'.$count.'"></a>						</div>';
			$count = $count + 1;
		}
	}
	return $output;
}
?>