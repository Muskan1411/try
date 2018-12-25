<?php
include "conn.php";
	include "functions.php";
	include "profile.php";
if(isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
	
?>
<!DOCTYPE html>
<html>
<head>
	<?php include "header.php";?>
	<!-- <link rel="stylesheet" type="text/css" href="css/navbar.css"> -->
	<link rel="stylesheet" type="text/css" href="css/sidebar.css">
	<style type="text/css">
  div.bhoechie-tab div.tab-content1:not(.active){
  display: none;
}
</style>
</head>
<body>
	<!-- <?php //include "navbar.php";?> -->
	
	<div class="row">
        
            <div class="col-md-2 col-2 sidebar-tab-menu">
            	<div class="text-center sidebar-header mt-4  ml-3 hidden-xs">
            		<?php
            			 $name = get_name();
            			 $caid = get_caid();
            			 $output ='';
            			 $output .= '<h4 class="p-3">'.$name.'</h4>';
            			 $output .= '<p class="">'.$caid.'</p>';
            			 echo $output;
            		?>

            	</div>
            	<hr>
              <div class="list-group pt-5 mt-5 ">
                <form method="post">
                	<a href="#" class="list-group-item profile pb-2 border-bottom" id="<?php echo $user;?>">
                  		<h4 class="fa fa-user"></h4><span class="hidden-xs"> Profile</span>
                	</a>
	                <a href="#" class="list-group-item active pb-2 border-bottom">
	                  <h4 class="fa fa-map-signs"></h4><span class="hidden-xs"> Allocated Places</span>
	                </a>
	                  <?php echo nav_tabs();?>
	               
	            </form>
	            <li class="nav-item list-unstyled">
		            <a class="nav-link ml-1" href="logout.php"><h4 class="fa fa-power-off"></h4><span class="hidden-xs"> &nbsp;Log Out</span></a>
		        </li>
              </div>
            </div>
            <div class="col-md-10 col-10 bhoechie-tab">
                <!-- Profile section -->
                <div class="tab-content1"><hr>
                	<h1 class="text-center">Your Profile</h1><hr>
                	<div class="row justify-content-center">
                		<div class="col-md-4 col-10 text-center left-side">
                			<div id="profile_image" class=""></div>
                			<div id="name"></div><br>
                			<div class="">
                				<strong>Username :</strong> <?php echo $user;?><br>
                				<strong>CAID :</strong> <?php echo get_caid(); ?>	
                			</div>

                		</div>
                		<div class="col-md-6 col-10"><hr>
                			<div class="mb-4" id="faname"></div><hr>
                			<div class="mb-4" id="address"></div><hr>
                			<div class="mb-4" id="dob"></div><hr>
                			<div class="mb-4" id="email"></div><hr>
                			<div class="mb-4" id="contact"></div><hr>
                		</div>
                	</div>
                    <div class="change-password mt-5 text-center">
                    	<form id="chng_pswd_form" method="post">
                    		<div class="row justify-content-center">
                    			<div class="col-md-6 col-9 mb-5">
                    				<input type="password" name="pswd" class="form-control" placeholder="Change Your Password">
                    			</div>
                    			<div class="col-md-2 col-6">
                                    <input type="hidden" name="username" value="<?php echo $user;?>">
                    				<button type="submit" name="change" class="btn change-pswd form-control" id="<?php echo $user;?>">CHANGE</button>
                    			</div>
                    		</div>		
                    	</form>
                    	
                    </div>
                    <hr>
                </div>


                <!-- Allocated Places section -->
                <div class="tab-content1 text-center">
                	<hr><h1 class="">Allocated Places</h1><hr>
                   	<?php echo allocated_places($user);?>
                </div>
    
                
                <!-- ADHUB -->
                <div class="tab-content1 active">
                	<hr><h1 class="text-center">ADHUB</h1><hr>
                    <div>
                    	<ul class="nav nav-tabs">
                    		<li class="nav-item"><a href="#addinadhub" class="nav-link active" data-toggle="tab">ADD ADS</a></li>
                    		<li class="nav-item"><a href="#your-ads-adhub" class="nav-link" data-toggle="tab">YOUR ADS</a></li>
                    		<li class="nav-item"><a href="#approvedads-adhub" class="nav-link" data-toggle="tab">APPROVED ADS</a></li>
                    		<li class="nav-item"><a href="#pending-adhub" class="nav-link" data-toggle="tab">PENDING REQUESTS</a></li>
                    	</ul>
                    	<div class="tab-content">
  							<?php include "adhub.php";?>
 						</div>
                    </div>
                </div>
                <!--ADSMANIA-->
                <div class="tab-content1">
                	<hr><h1 class="text-center">ADSMANIA</h1><hr>
                    <ul class="nav nav-tabs">
                    		<li class="nav-item"><a href="#addinadmania" class="nav-link active" data-toggle="tab">ADD ADS</a></li>
                    		<li class="nav-item"><a href="#your-ads-admania" class="nav-link" data-toggle="tab">YOUR ADS</a></li>
                    		<li class="nav-item"><a href="#stats-admania" class="nav-link" data-toggle="tab">STATS</a></li>         	
                    </ul>
                    <div class="tab-content">
  							<?php include "admania.php";?>
 					</div>
                </div>
                
            </div>
        
  </div>

  

<script type="text/javascript" src="js/sidebar.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("div.sidebar-tab-menu>div.list-group>form>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.tab-content1").removeClass("active");
        $("div.bhoechie-tab>div.tab-content1").eq(index).addClass("active");
    });
});
</script>
</body>
</html>

<?php
}
?>