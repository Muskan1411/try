$(document).on('click', '.profile', function() {
	var profile_uname = $(this).attr("id");
	$.ajax({
		url: "profile.php",
		method: "post",
		data: {profile_uname: profile_uname},
		dataType: "json",
		success:function(data) {
			$("#profile_image").html("<img src='"+data.image+"' class='rounded-circle' width='180' height='180'>");
			$("#name").html("<h3 class='mt-4'>"+data.name+"</h3>")
			$("#faname").html("<p><span class='fa fa-male mr-2'></span> "+data.fatherName+"</p>")
			$("#address").html("<p><span class='fa fa-home mr-2'></span> "+data.address+"</p>")
			$("#dob").html("<p><span class='fa fa-birthday-cake mr-2'></span> "+data.dob+"</p>")
			$("#email").html("<p><span class='fa fa-envelope mr-2'></span> "+data.email+"</p>")
			$("#contact").html("<p><span class='fa fa-phone mr-2'></span> "+data.contact+"</p>")
		}
	})
})


$(document).on('submit', '#chng_pswd_form', function() {
	
	console.log("sjfDE");
	$.ajax({
		url: "change_pswd.php",
		method: "post",
		data: new FormData(this),
		contentType: false,
        processData: false,
		success:function(data) {
			alert(data);
			window.location.href = window.location.href;
		}
	})
})