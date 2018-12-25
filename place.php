<?php
if(isset($_GET['id'])) {
	$conn = mysqli_connect('localhost', 'root', 'muskan11', 'KSTask');
	
	function make_query($conn) {
		$place = $_GET['id'];
		$query = "Select distinct(timeslot),img from carouselImages where place LIKE '%".$place."%' order by timeslot asc";
		$result = mysqli_query($conn, $query);
		return $result;
	}
function make_slide_indicators($conn) {
		$output = '';
		$count = 0;
		$result = make_query($conn);

		if(mysqli_num_rows($result)) {
		while($count<20) {

			if($count == 0) {
				$output .= '
					<li data-target="#dynamic_carousel" data-slide-to="'.$count.'" class="list"></li>';
			} else {
				$output .= '
					<li data-target="#dynamic_carousel" data-slide-to="'.$count.'" class="list"></li>';
			}
			$count = $count + 1;
		}	
	}
	return $output;
	}
	function make_slides($conn) {
		$output = '';
		$count = 0; $i=0;
		$result = make_query($conn);
		if(mysqli_num_rows($result)) {
		$data = array();
		while($row=mysqli_fetch_array($result)) {
			$image = $row['img'];
			$extension = explode(".", $image);
			$name = $extension[0];
			$data[] = $name;
		}
		$size = sizeof($data);
		date_default_timezone_set('Asia/Kolkata');
		$min = date('i');
		$slot = intval($min/3);
		while($count<20) {
			$mul = $count * 4;
			if($count == $slot) {
				$output .= '<div class="carousel-item active" data-interval="180000"><a href="#" target="_blank">';
			} else {
				$output .= '<div class="carousel-item" data-interval="180000"><a href="#" target="_blank">';
			}

			if($mul == $data[$i]) {
				$output .= '
				<img class="d-block w-100 carousel_img" src="upload/'.$mul.'.jpg" alt="'.$row['timeslot'].'" id="'.$count.'"></a>
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
		
	} 
	return $output;
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include "header.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/carousel.css">
	<link rel="stylesheet" type="text/css" href="css/navbar.css">

	<script type="text/javascript" src="js/script.js">
	</script>
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
</head>
<body>
	<div class="opaque-navbar" >
			<nav class="mb-4 navbar navbar-expand-lg fixed-top">
		        <a class="navbar-brand font-bold text animated rubberBand" href="#"><img id="logo" alt="Logo" src="logo.png" width="55" height="55"> <span>ADSMania<b class="tagline">Know the things better</b></span></a>

		        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"><img id="logo" alt="Logo" src="navicon.svg" width="35" height="35"></span>
		        </button>

		                <div class="collapse navbar-collapse animated pulse" id="navbarSupportedContent-4">
		                    <ul class="navbar-nav ml-auto">
		                        <li class="nav-item">
		                            <a class="nav-link float-shadow" href="onlogin.php"><i class="fa fa-plus fa-fw mx-1"></i>Add Ads<span class="sr-only">(current)</span></a>
		                        </li>
		                         <li class="nav-item ">
		                    <a class="nav-link" href="manage_coadmins.php"><i class="fa fa-user mx-1"></i>Manage CoAdmins<span class="sr-only">(current)</span></a>
		                </li>
		                        <li class="nav-item active">
		                            <a class="nav-link" href="carousel.php"><i class="fa fa-eye mx-1"></i>View Ads</a>
		                        </li>
		                        <li class="nav-item">
		                            <a class="nav-link" href="logout.php">Log Out</a>
		                        </li>
		                    </ul>
		                </div>        
		 	</nav>

  	</div>
	<div class="container py-5" ng-app="myApp">
		<div class="row">
			<div class="col-lg-3">
				<div class="list-group place-list">
					<h3 class="place-head list-group-item">Search By Place</h3>
				    <?php
						$query = "Select * from places order by place_name asc";
						$result = mysqli_query($conn, $query);
						
						while($row=mysqli_fetch_array($result)) {
						$place_name = $row['place_name'];
						$new_place_name = str_replace(' ', '', $place_name);
				   echo "<a href='place.php?id=".$new_place_name."' class='list-group-item link'>".$place_name."</a>";
				}
				?>

  				</div>
			</div>
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
			<div class="col-lg-9">
				<?php echo '<div id="dynamic_carousel" class="carousel slide" data-ride="carousel" data-interval="'.$interval_time.'">';?>
			<ol class="carousel-indicators">
				<?php echo make_slide_indicators($conn); ?>
			</ol>

			<div class="carousel-inner">
				<?php echo make_slides($conn); ?>
			</div>
			<a class="carousel-control-prev" href="#dynamic_carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#dynamic_carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
		</div>
			</div>
		</div>
			
	</div>
</body>
</html>
<?php
}
?>