<?php
	include "connect.php";
	include "showad.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

	<?php  include "header.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/navbar.css">
	<link rel="stylesheet" type="text/css" href="css/view_ads.css">
</head>
<body>
	<?php $page='three'; include "navbar.php"; ?>
	<div class="" >
		<div class="findAds-div">
			
				<div class="row justify-content-center">
					<div class="col-md-8 col-10">
						<h1 class="text-center search-head mb-3"> Search for the Advertisement</h1>
						<form method="post">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-map-marker"></i></span>
							</div>
							
								<select class="form-control select-box" name="place_name">
									<?php
										$query = "Select * from places order by place_name asc";
										$result = mysqli_query($conn, $query);
										while($row=mysqli_fetch_array($result)) {
											echo '<option value="'.$row['place_name'].'">'.$row['place_name'].'</option>';
										}
									?>
								</select>
							
								<div class="input-group-append">
									<button type="submit" name="search" class="btn">Search</button>
								</div>
							
						</div>
						</form>
					</div>
				</div>
			
		</div>

<!----------------------------ADS--------------------------------------->
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
		    <div class="row justify-content-center pt-4">
		      <div style="width:728px; height:90px;">
		      	<?php echo '<div id="dynamic_carousel1" class="carousel slide" data-pause="none" data-ride="carousel" data-interval="'.$interval_time.'">';?>
		      		<div class="carousel-inner">
						<?php echo make_slides2(); ?>
					</div>
					 <a class="carousel-control-prev" href="#dynamic_carousel1" data-slide="prev">
					    <span class="carousel-control-prev-icon"></span>
					 </a>
					 <a class="carousel-control-next" href="#dynamic_carousel1" data-slide="next">
					    <span class="carousel-control-next-icon"></span>
					 </a>
		      </div>
		    </div>
			</div>
		    <br>
		 
		    <div class="d-none d-md-flex  justify-content-between">
		      <div style="width:160px; height:600px;">
		      	<?php echo '<div id="dynamic_carousel2" class="carousel slide"  data-pause="none" data-ride="carousel" data-interval="'.$interval_time.'">';?>
		      		<div class="carousel-inner">
						<?php echo make_slides3($conn); ?>
					</div>
					<a class="carousel-control-prev" href="#dynamic_carousel2" data-slide="prev">
					    <span class="carousel-control-prev-icon"></span>
					 </a>
					 <a class="carousel-control-next" href="#dynamic_carousel2" data-slide="next">
					    <span class="carousel-control-next-icon"></span>
					 </a>
		      </div>
		      </div> 
		      <div  style="width:300px; height:600px;">
				<?php echo '<div id="dynamic_carousel3" class="carousel slide" data-pause="none" data-ride="carousel" data-interval="'.$interval_time.'">';?>
		      		<div class="carousel-inner">
						<?php echo make_slides4($conn); ?>
					</div>
					<a class="carousel-control-prev" href="#dynamic_carousel3" data-slide="prev">
					    <span class="carousel-control-prev-icon"></span>
					 </a>
					 <a class="carousel-control-next" href="#dynamic_carousel3" data-slide="next">
					    <span class="carousel-control-next-icon"></span>
					 </a>
		      </div>
		    </div>
		    </div>
		    <br>

		    <div class="row justify-content-center">		    
		      <div style="width:720px; height:300px;">
		      	<?php echo '<div id="dynamic_carousel4" class="carousel slide" data-pause="none" data-ride="carousel" data-interval="'.$interval_time.'">';?>
		      		<div class="carousel-inner">
						<?php echo make_slides1($conn); ?>
					</div>
					<a class="carousel-control-prev" href="#dynamic_carousel4" data-slide="prev">
					    <span class="carousel-control-prev-icon"></span>
					 </a>
					 <a class="carousel-control-next" href="#dynamic_carousel4" data-slide="next">
					    <span class="carousel-control-next-icon"></span>
					 </a>
		      	</div>
		    </div>
		  
		    </div>
		    <br>
		    
		   
 	 </div>
	</div>

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


</body>
</html>