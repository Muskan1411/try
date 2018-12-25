<?php
	session_start();

	if(isset($_SESSION['uname'])) {
		if(isset($_POST['allocate_place'])) {
			include "connect.php";
			$id = $_POST['reg_id'];
?>
<!DOCTYPE html>
<html>
<head>
	<?php include "header.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/navbar.css">
	<link rel="stylesheet" type="text/css" href="css/allocate_place.css">
	<script type="text/javascript" src="js/manage_coadmins.js"></script>
</head>
<body>
	
		<?php $page=''; include "navbar.php";?>
		<div>
			<form action="allocate.php" method="POST">
			<div class="row justify-content-center allocate-div">
				
				<div class="col-md-6 col-11">
					
					<label for="place" class="text"> Select the places to <span class="h-text">Allocate</span></label>
					<select multiple class="form-control selectpicker" id="place" name="place[]" multiple data-live-search="true" required>
									<option disabled>Select the places:</option>
									<?php

										$places = array();

										$sql = "Select * from approved_admins where reg_id=$id";
										$res = mysqli_query($conn, $sql);

										while($row1 = mysqli_fetch_array($res)) {
											$allocated_places = $row1['allocated_places'];
											if($allocated_places != '') {
												$places = unserialize($allocated_places);
											}
										}
										$query = "Select * from places order by place_name asc";
										$result = mysqli_query($conn, $query);
										
										while($row=mysqli_fetch_array($result)) {
											$p=0;
											for($i=0; $i<sizeof($places); $i=$i+1) {
												if($row['place_name'] == $places[$i]) {
													echo '<option value="'.$row['place_name'].'" selected>'.$row['place_name'].'</option>';
													$p=1;
													break;
												}
											}
											if($p!=1) {
												echo '<option value="'.$row['place_name'].'" style="color:black;">'.$row['place_name'].'</option>';
											}
										}	
									?>
					</select>

				</div>
				<div class="col-md-2 col-10 mt-2 text-center">
					
					<input type="hidden" name="reg_id" value="'<?php echo $id;?>'">
					<button type="submit" class="btn allocate" name="allocate">Allocate</button>
				</div>
			
			</div>
			</form>

			<h4 class="text text-center" style="color: black; margin-top: 20px; ">Number of Places <span class="h-text">Allocated</span></h4>
				<?php 
					$sql = "Select * from places order by place_name";
					$res = mysqli_query($conn, $sql);
					while($row=mysqli_fetch_array($res)) {
						$place_name = $row['place_name'];
						$allocation_count = $row['allocation_count'];
					
				?>
				<div class="row justify-content-center">
					<div class="col-md-1 col-8">
						<h5 class="place-text"><?php echo $place_name;?></h5>
					</div>
					<div class="col-md-6 col-12 ml-0">
						<div class="progress">
	      					<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $allocation_count;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $allocation_count; ?></div>
	    				</div>
					</div>
				</div>
				<?php
					}
				?>
		</div>
	
</body>
</html>
<?php
	
}
}
?>
<script type="text/javascript">
	var delay = 200;
		$(".progress-bar").each(function(i){
    		$(this).delay( delay*i ).animate( { width: $(this).attr('aria-valuenow') + '%' }, delay );

			    $(this).prop('Counter',0).animate({
			        Counter: $(this).text()
			    }, {
			        duration: delay,
			        easing: 'swing',
			        step: function (now) {
			            $(this).text(Math.ceil(now));
			        }
			    });
			});
</script>