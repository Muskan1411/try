$(document).ready(function() {
	$("#allocate-admin-table").css({"display":"none"});
})

$(function (){ 
	$("#pending-request-link").click(function(e) {
		$("#pending-request-table").delay(100).fadeIn(100);
		$("#allocate-admin-table").fadeOut(100);
		$("#allocate-admin-link").removeClass("active");
		$(this).addClass("active");
		e.preventDefault();
	});

	$("#allocate-admin-link").click(function(e) {
		$("#allocate-admin-table").delay(100).fadeIn(100);
		$("#pending-request-table").fadeOut(100);
		$("#pending-request-link").removeClass("active");
		$(this).addClass("active");
		e.preventDefault();
	});
})

/////////////////View Profile /////////////////////////
$(document).on('click', '.view', function(){
	var reg_id = $(this).attr('id');
	$.ajax({
		url: "view.php",
		method: "post",
		data:{reg_id:reg_id},
		dataType: "json",
		success: function(data) {
			$("#myModal").modal("show");
			$("#profile_img").html("<img src='coadmin/"+data.img+"' class='rounded-circle' width='180' height='180'>");
			$("#coadmin_name").html(data.fname+" "+data.lname);
			$("#mobile").val(data.mob);
			$("#email").val(data.mail);
			$("#mobile-link").attr("href", "tel:"+data.mob);
			$("#email-link").attr("href", "mailTo:https://mail.google.com/mail/?view=cm&fs=1&to="+data.mail);
			$("#dob").val(data.dob);
			$("#faname").val(data.faname);
			$("#address").val(data.address);
			$("#editId").val(data.regId);
			$("#ads_added").val(data.ads_added);
			$("#ads_approved").val(data.ads_approved);
			$("#standing").val(data.standing);
			$("#editProfile").attr("id",data.regId);
		}
	})
});

///////////////Hide Stats when not approved//////////
$(document).on('click', '.yetToApprove', function() {
	$('#stats-info-div').css({"display":"none"});
	$('.edit-button').css({"display":"none"});
	$('#profileEdit :input').prop("disabled", true);
}) 

////////////Show Stats when approved////////////////
$(document).on('click', '.alreadyApproved', function() {
	$('#stats-info-div').css({"display":"block"});
	$('.edit-button').css({"display":"block"});
	$('#profileEdit :input').prop("disabled", false);
}) 


////////////approve////////////////////////////
$(document).on('click', '.approve', function(){
	var reg_id = $(this).attr('id');
	if (confirm("Continue with the approval?")) {
		$.ajax({
			url: "approve.php",
			method: "post",
			data:{reg_id:reg_id},
			
			success: function(data) {
				alert(data);
				
				window.location.href = window.location.href;
			}
		})
	}
});

////////////////////////reject///////////////////
$(document).on('click', '.reject', function(){
	var reg_id = $(this).attr('id');
	if (confirm("Continue with the rejection?")) {
		$.ajax({
			url: "delete.php",
			method: "post",
			data:{reg_id:reg_id},
			
			success: function(data) {
				alert(data);

				window.location.href = window.location.href;
			}
		})
	}
})

/////////////////////////Auto Approve////////////////////////////
////////////////////////////////////////////////////////////////
$('input[name=autoapproval]').on('click', function() {
	var autoapproval_id = $(this).attr('id');
	if($(this).is(':checked')) {
		var check = "yes";
	} else {
		var check = "no";
	}
	if(confirm("Continue?")) {
		$.ajax({
			url: "powers.php",
			method: "post",
			data: {autoapproval_id:autoapproval_id , check:check},
			success:function(data) {
				alert(data);
			}
		})
	}
})

/////////////////////////Carousel Powers////////////////////////////
////////////////////////////////////////////////////////////////
$('input[name=carousel]').on('click', function() {
	var carousel_id = $(this).attr('id');
	if($(this).is(':checked')) {
		var check = "yes";
	} else {
		var check = "no";
	}
	if(confirm("Continue?")) {
		$.ajax({
			url: "powers.php",
			method: "post",
			data: {carousel_id:carousel_id, check:check},
			success:function(data) {
				alert(data);
			}
		})
	}
})

/////////////////////////Display Powers////////////////////////////
////////////////////////////////////////////////////////////////
$('input[name=display]').on('click', function() {
	var display_id = $(this).attr('id');
	if($(this).is(':checked')) {
		var check = "yes";
	} else {
		var check = "no";
	}
	if(confirm("Continue?")) {
		$.ajax({
			url: "powers.php",
			method: "post",
			data: {display_id:display_id, check:check},
			success:function(data) {
				alert(data);
			}
		})
	}
})






