$(document).ready(function() {
	$("#register-form").css({"display":"none"});

  $(".upload-button").on('click', function() {
    console.log("hjf");
       $("#imageUpload").click();
    });
	$image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'circle'
    },
    boundary:{
      width:300,
      height:300
    }
  });

  $('#imageUpload').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
  });


 $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"insert.php",
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
          $('#uploadimageModal').modal('hide');
          $('#profile-container').html(data);
        }
      });
    })
  });



})
////////Tabbed Login & Register Forms/////////
$(function (){
	$("#login-form-link").click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
		$("#register-form").fadeOut(100);
		$("#register-form-link").removeClass("active");
		$(this).addClass("active");
		e.preventDefault();
	});

	$("#register-form-link").click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
		$("#login-form").fadeOut(100);
		$("#login-form-link").removeClass("active");
		$(this).addClass("active");
		e.preventDefault();
	});
})

// $("#profileImage").click(function(e) {
// 	console.log("sefr");
//     $("#imageUpload").click();
// });

// function fasterPreview( uploader ) {
//     if ( uploader.files && uploader.files[0] ){
//           $('#profileImage').attr('src', 
//              window.URL.createObjectURL(uploader.files[0]) );
//     }
// }

// $("#imageUpload").change(function(){
//     fasterPreview( this );
// });

////////////////CSS/////////////////
