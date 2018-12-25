<?php
session_start();
	if(isset($_SESSION['uname'])) {
	include "get_Profile_ads.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include "header.php";?>
	<link rel="stylesheet" href="css/owlcarousel.css">
    <link rel="stylesheet" href="css/owltheme.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
	<link rel="stylesheet" type="text/css" href="css/maintainAdStatus.css">
	<script type="text/javascript" src="js/maintainAdStatus.js"></script>
</head>
<body>
	<?php $page='four'; include "navbar.php";?>

<div class="wrap-ads" style="position: relative; margin-top: 100px;">

	<!-- --------------APPROVAL------------------ -->

<div class="row ml-4 mr-4 mb-4 pt-4">
	
		<div class="div-inside-row mb-4">
			<div class="text">Approval <span>Request</span></div>
		</div>
	
	
		<div class="div-inside-row">
			<div class="owl-carousel owl-theme">
				<?php echo owl_carousel1();?>
			</div>
		</div>
	
</div>
	
	<!-- --------------ACTIVE------------------ -->

<div class="row mt-5 ml-4 mr-4 mb-4">
	
		<div class="div-inside-row mb-4">
			<div class="text">Active <span>ADS</span></div>
		</div>
	
		<div class="div-inside-row text-center">
			<div class="owl-carousel owl-theme">
				<?php echo owl_carousel2();?>	
		</div>
	
</div>
</div>


<!-- --------------INACTIVE------------------ -->

<div class="row mt-5 ml-4 mr-4 mb-4">
	
		<div class="div-inside-row mb-4">
			<div class="text">InActive <span>ADS</span></div>
		</div>
	
		<div class="div-inside-row text-center">
			<div class="owl-carousel owl-theme">
				<?php echo owl_carousel3();?>
			</div>
		</div>
	
</div>
</div>

	<!----------------SCRIPT------------------ -->
	
<script src="js/owlcarousel.js"></script>
  <script>
      $('.owl-carousel').owlCarousel({
      loop:false,
      margin:20,
      nav    : true,
      smartSpeed :900,
      navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
      responsiveClass: true,
      responsive:{
      0:{
      items: 1,
      dots: false
      },
      600:{
      items: 2,
      dots: false
      },
      900:{
      items: 3,
      dots: false
      },
      1200:{
      items: 4,
      dots: false
      }
      },
      autoplay:true,
      autoplayTimeout: 3000,
      autoplayHoverPause: true,
      responsiveRefreshRate: 100
      });
      // $(document).on('click','.more', function() ) {
      // 	('#myModal').modal('show');
      // }
      </script>

</body>
</html>


<!-- -------------------ADVERTISEMENT MODAL-------------------------- -->
<div class="modal" id="myADModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Advertisements</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <?php 
        	if(isset($_POST['advert-more'])) {
        		// include "get_Profile_ads.php";
        		$adID = $_POST['advert_id'];
        		include "connect.php";

				$sql1 = "Select * from advertisements where ad_id=$adID LIMIT 1";
				$res = mysqli_query($conn,$sql1);
				
				while($row=mysqli_fetch_array($res)) {
					$image300_600 = $row['300*600'];
					$image160_600 = $row['160*600'];
					$image728_90 = $row['728*90'];
					$image720_300 = $row['720*300'];
					$output = '';
					echo '<div id="demo" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
								    <div class="carousel-item active">'.
									      '<img src="coadmin/img/advertisements/'.$image300_600.'" alt="Los Angeles">'.'
								    </div>';
					$output .=  '<div class="carousel-item">
					      			<img src="coadmin/img/advertisements/'.$image160_600.'" alt="Chicago">
					    		</div>';

					$output .=  '<div class="carousel-item">
					     			 <img src="coadmin/img/advertisements/'.$image728_90.'" alt="New York">
					    		</div>';
					$output .=  '<div class="carousel-item">
					     			 <img src="coadmin/img/advertisements/'.$image720_300.'" alt="New York">
					    		</div>    		
					    		</div>';    		
	  
					$output .=  '<a class="carousel-control-prev" href="#demo" data-slide="prev">
					   			 <span class="carousel-control-prev-icon"></span>
					 			</a>
								<a class="carousel-control-next" href="#demo" data-slide="next">
							     <span class="carousel-control-next-icon"></span>
						     	</a>
								</div>';
				}
			echo $output;
        	}
        ?>
      </div>

      

    </div>
  </div>
</div>

<!-- -------------------ASSOCIATE PROFILE---------------------- -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Profile</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="text-center">

        	
        	<h3 id="coadmin_name" class="mb-3"></h3>
			<form action="editAssociateProfile.php" method="POST" id="profileEdit">
			
			
			<div class="input-group mb-3">
        		<div class="input-group-prepend">
        			<span class="input-group-text"><b>Allocated Places</b></span>
        		</div>
        		<input type="text" class="form-control" id="alloted-places" name="alloted-places">
        		
        	</div>

        	<div class="input-group mb-3">
        		<div class="input-group-prepend">
        			<span class="input-group-text"><b>Mobile&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
        		</div>
        		<input type="text" class="form-control" id="mobile" name="mobile">
        		<div class="input-group-append">
        			<span class="input-group-text"><a class="btn" id="mobile-link"><i class="fa fa-phone logo"></i><!-- <img class="logo" alt="Logo" src="img/call.svg" width="20" height="15" title="call"> --></a></span>
        		</div>
        	</div>
			

			<div class="input-group mb-3">
        		<div class="input-group-prepend">
        			<span class="input-group-text"><b>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
        		</div>
        		<input type="text" class="form-control" id="email" name="email">
        		<div class="input-group-append">
        			<span class="input-group-text"><a class="btn" id="email-link"><i class="fa fa-envelope logo"></i><!-- <img class="logo" alt="Logo" src="img/mail.svg" width="15" height="15"> --></a></span>
        		</div>
        	</div>
			
        	<div class="input-group mb-3">
        		<div class="input-group-prepend">
        			<span class="input-group-text"><b>Ads Added&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
        		</div>
        		<input type="text" class="form-control" id="ads_added" name="ads_added">
        		
        	</div>

			</form>
        </div>
      </div>

    </div>
  </div>
</div>
<?php
}
?>