<?php

		$conn = mysqli_connect('localhost', 'root', 'muskan11', 'KSTask');
		
		function calculateSlot() {
			date_default_timezone_set('Asia/Kolkata');
			$min = date('i');
			$slot = intval($min/3); 
			return $slot;
		}

		function make_slides1($conn) {
			$query = "Select distinct(timeslot),img from carouselImages order by timeslot asc";
			$result = mysqli_query($conn, $query);
			$output = '';
			$ext = array();
			$count = 0; $i=0;
			$data = array();
			while($row=mysqli_fetch_array($result)) {
				$image = $row['img'];
				$extension = explode(".", $image);
				$name = $extension[0];
				$ext[] = $extension[1];
				$data[] = $name;
			}
		$size = sizeof($data);
		$slot = calculateSlot();
		while($count<20) {
			$mul = $count * 4; 

			if($count == $slot) {
				$output .= '<div class="carousel-item active" data-interval="180000"><a href="#" target="_blank">';
			} else {
				$output .= '<div class="carousel-item" data-interval="180000"><a href="#" target="_blank">';
			}
			if($mul == $data[$i]) {
				$output .= '
				<img class="d-block w-100 carousel_img" src="upload/'.$data[$i].'.'.$ext[$i].'" alt="'.$row['timeslot'].'" id="'.$count.'"></a>
				</div>';
				if($i<$size-1) {
					$i++;
				}
			} else {
				$output .= '
				<img class="d-block w-100 carousel_img" src="upload/white.jpg" alt="'.$row['timeslot'].'" id="'.$count.'"></a>
				</div>';
			}	
			$count = $count + 1;
		}
		return $output;
	}

	function make_slides2($conn) {
		$query = "Select distinct(timeslot),img3 from carouselImages order by timeslot asc";
		$result = mysqli_query($conn, $query);
		$output = '';
		$ext = array();
		$data = array();
		$i=0;$count=0;
		while($row = mysqli_fetch_array($result)) {
			$extension = explode('.', $row['img3']);
			$name = $extension[0];
			$ext[] = $extension[1];
			$data[] = $name;
		}
		$size = sizeof($data);
		$slot = calculateSlot();
		while($count<20) {
			$mul = ($count * 4)+3;
			
			if($count == $slot) {
				$output .= '<div class="carousel-item active" data-interval="180000"><a href="#" target="_blank">';
			} else {
				$output .= '<div class="carousel-item" data-interval="180000"><a href="#" target="_blank">';
			}
			if($mul == $data[$i]) {
				$output .= '
				<img class="d-block w-100 carousel_img" src="upload/'.$data[$i].'.'.$ext[$i].'" alt="'.$row['timeslot'].'" id="'.$count.'"></a>
				</div>';
				if($i<$size-1) {
					$i=$i+1;
				}
			} else {
				$output .= '
				<img class="d-block w-100 carousel_img" src="upload/white1.jpg" alt="'.$row['timeslot'].'" id="'.$count.'"></a>
				</div>';
			}	
			$count = $count + 1;
		}
		return $output;
	}

	function make_slides3($conn) {
		$query = "Select distinct(timeslot),img2 from carouselImages order by timeslot asc";
		$result = mysqli_query($conn, $query);
		$output = '';
		$ext = array();
		$data = array();
		$i=0;$count=0;
		while($row = mysqli_fetch_array($result)) {
			$extension = explode('.', $row['img2']);
			$name = $extension[0];
			$ext[] = $extension[1];
			$data[] = $name;
		}
		$size = sizeof($data);
		$slot = calculateSlot();
		while($count<20) {
			$mul = ($count * 4)+2;
			
			if($count == $slot) {
				$output .= '<div class="carousel-item active" data-interval="180000"><a href="#" target="_blank">';
			} else {
				$output .= '<div class="carousel-item" data-interval="180000"><a href="#" target="_blank">';
			}
			if($mul == $data[$i]) {
				$output .= '
				<img class="d-block w-100 carousel_img" src="upload/'.$data[$i].'.'.$ext[$i].'" alt="'.$row['timeslot'].'" id="'.$count.'"></a>
				</div>';
				if($i<$size-1) {
					$i++;
				}
			} else {
				$output .= '
				<img class="d-block w-100 carousel_img" src="upload/white2.jpg" alt="'.$row['timeslot'].'" id="'.$count.'"></a>
				</div>';
			}	
			$count = $count + 1;
		}
		return $output;
	}

	function make_slides4($conn) {
		$query = "Select distinct(timeslot),img1 from carouselImages order by timeslot asc";
		$result = mysqli_query($conn, $query);
		$output = '';
		$ext = array();
		$data = array();
		$i=0;$count=0;
		while($row = mysqli_fetch_array($result)) {
			$extension = explode('.', $row['img1']);
			$name = $extension[0];
			$ext[] = $extension[1];
			$data[] = $name;
		}
		$size = sizeof($data);
		$slot = calculateSlot();
		while($count<20) {
			$mul = ($count * 4)+1;
			
			if($count == $slot) {
				$output .= '<div class="carousel-item active" data-interval="180000"><a href="#" target="_blank">';
			} else {
				$output .= '<div class="carousel-item" data-interval="180000"><a href="#" target="_blank">';
			}
			if($mul == $data[$i]) {
				$output .= '
				<img class="d-block w-100 carousel_img" src="upload/'.$data[$i].'.'.$ext[$i].'" alt="'.$row['timeslot'].'" id="'.$count.'"></a>
				</div>';
				if($i<$size-1) {
					$i++;
				}
			} else {
				$output .= '
				<img class="d-block w-100 carousel_img" src="upload/white3.jpg" alt="'.$row['timeslot'].'" id="'.$count.'"></a>
				</div>';
			}	
			$count = $count + 1;
		}
		return $output;
	}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<script type="text/javascript">
	$.fn.carousel.Constructor.prototype.cycle = function (event) {
	    if (!event) {
	        this._isPaused = false;
	      }

	      if (this._interval) {
	        clearInterval(this._interval)
	        this._interval = null;
	      }

	      if (this._config.interval && !this._isPaused) {
	          
	        var $ele = $('.carousel-item-next');
	        var newInterval = $ele.data('interval') || this._config.interval;
	        this._interval = setInterval(
	          (document.visibilityState ? this.nextWhenVisible : this.next).bind(this),
	          newInterval
	        );
	      }
		};
</script>
<body>
 
  <div class="container-fluid">
  	<?php
				date_default_timezone_set('Asia/Kolkata');
				$min = date('i');
				$remain = $min%3;
				$remain = 3-$remain;
				if($remain!=3) {
					$interval_time = $remain*60*1000;
				} else {
					$interval_time = 180000;
				}
			?>
    <div class="row justify-content-center">
      <div style="width:728px; height:90px;">
      	<?php echo '<div id="dynamic_carousel1" class="carousel slide" data-ride="carousel" data-interval="'.$interval_time.'">';?>
      		<div class="carousel-inner">
				<?php echo make_slides2($conn); ?>
			</div>
      </div>
    </div>
	</div>
    <br>
 
    <div class="d-none d-md-flex  justify-content-between">
      <div style="width:160px; height:600px;">
      	<?php echo '<div id="dynamic_carousel2" class="carousel slide" data-ride="carousel" data-interval="'.$interval_time.'">';?>
      		<div class="carousel-inner">
				<?php echo make_slides3($conn); ?>
			</div>
      </div>
      </div> 
      <div  style="width:300px; height:600px;">
		<?php echo '<div id="dynamic_carousel3" class="carousel slide" data-ride="carousel" data-interval="'.$interval_time.'">';?>
      		<div class="carousel-inner">
				<?php echo make_slides4($conn); ?>
			</div>
      </div>
    </div>
    </div>
    <br>


    <!-- Or let Bootstrap automatically handle the layout -->
    <div class="row justify-content-center">
    
      <div style="width:720px; height:300px;">
      	<?php echo '<div id="dynamic_carousel4" class="carousel slide" data-ride="carousel" data-interval="'.$interval_time.'">';?>
      		<div class="carousel-inner">
				<?php echo make_slides1($conn); ?>
			</div>
      	</div></div>
  
    </div>
    <br>
    
   
  </div>


</body>
</html>
