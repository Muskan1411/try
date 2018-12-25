$(document).on('click','.view_profile', function() {
	var reg_id = $(this).attr('id');
	$.ajax({
		url: "get_Profile_ads.php",
		method:"post",
		data: {reg_id:reg_id},
		dataType: "json",
		success:function(data) {
			$("#myModal").modal("show");
			$("#coadmin_name").html(data.fname+" "+data.lname);
			$("#mobile").val(data.mob);
			$("#email").val(data.mail);
			$("#mobile-link").attr("href", "tel:"+data.mob);
			$("#email-link").attr("href", "mailTo:https://mail.google.com/mail/?view=cm&fs=1&to="+data.mail);

			$("#ads_added").val(data.ads_added);
			$("#alloted-places").val(data.allocated_places);
		}
	})
})

/////////////////approve ads //////////////////////
$(document).on('click', '.approve', function() {
	var ad_id = $(this).attr("id");
	if(confirm("Are you sure you want to approve?")) {
		$.ajax({
			url: "activateAds.php",
			method: "post",
			data: {ad_id:ad_id},
			success:function(data) {
				alert(data);
				window.location.href = window.location.href;
			}
		})
	} else {
		return false;
	}
})


$(document).on('click', '.remove', function() {
	var ad_remove_id = $(this).attr("id");
	// var x = '';
	// $(document).on('click', '.remove_before_approve', function() {
	// 	var x = 'rba';
	// 	console.log(x);
	// })
	// $(document).on('click', '.remove_after_approve', function() {
	// 	var x = 'raa';
	// 	console.log(x);
	// })
	if(confirm("Are you sure you want to remove this?")) {
		$.ajax({
			url: "activateAds.php",
			method: "post",
			data: {ad_remove_id:ad_remove_id, x:x},
			success:function(data) {
				alert(data);
				window.location.href = window.location.href;
			}
		})
	} else {
		return false;
	}
})


$(document).on('click','.inactive', function(){
	var ad_inactive_id = $(this).attr("id");
	if(confirm("Do you want to continue")) {
		$.ajax({
			url: "activateAds.php",
			method: "post",
			data: {ad_inactive_id:ad_inactive_id},
			success:function(data) {
				alert(data);
				window.location.href = window.location.href;
			}
		})
	} else {
		return false;
	}
})