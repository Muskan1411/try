

$(document).on('click','.activate', function() {	
	var id = $(this).attr("id");
	$.ajax({
		url: "activateAds.php",
		method: "post",
		data: {id:id},
		success:function(data) {
			alert(data);
		}

	})
});

///////////////////////////////////////////////////////
////////////////////////view profile///////////////////
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

///////////////////////////////////////////////////////
///////////////////////view ads////////////////////////
$(document).on('click', '.view_ads', function() {
	var ad_id = $(this).attr('id');
	$.ajax({
		url: "get_Profile_ads.php",
		method:"post",
		data: {ad_id:ad_id},
		dataType: "json",
		success:function(data) {
			
			$("#AdModal").modal("show");
			$("#image1").attr("href", "coadmin/img/advertisements/"+data.image300_600);
			$("#image2").attr("href", "coadmin/img/advertisements/"+data.image160_600);
			$("#image3").attr("href", "coadmin/img/advertisements/"+data.image728_90);
			$("#image4").attr("href", "coadmin/img/advertisements/"+data.image720_300);
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

/////////////////////////reject ads//////////////////////////////
$(document).on('click', '.remove', function() {
	var ad_remove_id = $(this).attr("id");
	
	if(confirm("Are you sure you want to remove this?")) {
		$.ajax({
			url: "activateAds.php",
			method: "post",
			data: {ad_remove_id:ad_remove_id},
			success:function(data) {
				alert(data);
				window.location.href = window.location.href;
			}
		})
	} else {
		return false;
	}
})

/////////////////////////inactive ads//////////////////////////////
$(document).on('click','.inactive', function(){
	var ad_inactive_id = $(this).attr("id");
	if(confirm("Do you want to continue?")) {
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

/////////////////////////////active ads///////////////////////////
$(document).on('click','.active', function(){
	var ad_active_id = $(this).attr("id");
	if(confirm("Do you want to continue?")) {
		$.ajax({
			url: "activateAds.php",
			method: "post",
			data: {ad_active_id:ad_active_id},
			success:function(data) {
				alert(data);
				window.location.href = window.location.href;
			}
		})
	} else {
		return false;
	}
})

/////////////////////////////delete ads///////////////////////////
$(document).on('click','.delete', function(){
	var ad_delete_id = $(this).attr("id");
	if(confirm("Do you want to continue?")) {
		$.ajax({
			url: "activateAds.php",
			method: "post",
			data: {ad_delete_id:ad_delete_id},
			success:function(data) {
				alert(data);
				window.location.href = window.location.href;
			}
		})
	} else {
		return false;
	}
})

///////////////////////////edit ads///////////////////////////////
$(document).on('click','.edit', function(){
	var ad_edit_id = $(this).attr("id");
	
		$.ajax({
			url: "get_Profile_ads.php",
			method: "post",
			data: {ad_edit_id:ad_edit_id},
			dataType: "json",
			success:function(data) {
				alert(data.advertiser_name);
				$("#EditAdModal").modal("show");
				$("#adName").val('data.advertiser_name');
				$("#desc").val(data.description);

				
			}
		})
	
})