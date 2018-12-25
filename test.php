<?php
session_start();
if(isset($_SESSION['uname'])) {
	include "place.php";
	$conn = mysqli_connect('localhost', 'root', 'muskan11', 'KSTask');
	function make_query($conn) {
		$query = "Select distinct(timeslot),img from carouselImages order by timeslot asc";
		$result = mysqli_query($conn, $query);
		return $result;
	}
	function make_slide_indicators($conn) {
		$output = '';
		$count = 0;
		$result = make_query($conn);
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
		return $output;
	}
	function make_slides($conn) {
		$output = '';
		$count = 0; $i=0;
		$result = make_query($conn);
		$data = array();
		while($row=mysqli_fetch_array($result)) {
			$image = $row['img'];
			$extension = explode(".", $image);
			$name = $extension[0];
			$data[] = $name;
		}
		$size = sizeof($data);
		while($count<20) {
			$mul = $count * 4;
			date_default_timezone_set('Asia/Kolkata');
			$min = date('i');
			$slot = intval($min/3);
			/*$remain = $min%3;
			if($remain!=0) {
				$interval_time = $remain*60*1000;
			} else {
				$interval_time = 180000;
			}*/
			if($count == $slot) {
				$output .= '<div class="carousel-item active" data-interval="1000"><a href="#" target="_blank">';
				
			} else {
				$output .= '<div class="carousel-item" data-interval="1000"><a href="#" target="_blank">';
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
		return $output;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<?php include "header.php";?>
	<link rel="stylesheet" type="text/css" href="css/carousel.css">
	<link rel="stylesheet" type="text/css" href="css/navbar.css">

	<script type="text/javascript" src="js/script.js">
	</script>
	<script type="text/javascript">
	console.log("hello m here");
	$.fn.carousel.Constructor.prototype.cycle = function (event) {
    console.log("hello m here----------------");
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
				   <a href="place.php?id=<?php echo "Place1"; ?>" class="list-group-item link <?php if($place == 'Place1'){ echo '_active';}?>">Place 1</a>
				    <a href="place.php?id=<?php echo "Place2"; ?>" class="list-group-item link <?php if($place == 'Place2'){ echo '_active';}?>">Place 2</a>
				    <a href="place.php?id=<?php echo "Place3"; ?>" class="list-group-item link <?php if($place == 'Place3'){ echo '_active';}?>">Place 3</a>
				    <a href="place.php?id=<?php echo "Place4"; ?>" class="list-group-item link <?php if($place == 'Place4'){ echo '_active';}?>">Place 4</a>
				    <a href="place.php?id=<?php echo "Place5"; ?>" class="list-group-item link <?php if($place == 'Place5'){ echo '_active';}?>">Place 5</a>
				    <a href="place.php?id=<?php echo "Place6"; ?>" class="list-group-item link <?php if($place == 'Place6'){ echo '_active';}?>">Place 6</a>
  				</div>
			</div>
			<div class="col-lg-9">
				<div id="dynamic_carousel" class="carousel slide" data-pause="none" data-ride="carousel" data-interval="40000">
		
			<ol class="carousel-indicators">
				<?php echo make_slide_indicators($conn); ?>
			</ol>

			<div class="carousel-inner">
				<?php echo make_slides($conn); 	 
				?>
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
		<?php echo '<script type="text/javascript">myFunc();</script>';?>
			</div>
		</div>
			
	</div>
</body>
</html>
<?php
}
?>