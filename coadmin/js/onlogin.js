$(document).ready(function() {
	///////////////////////////////////
    //validate image width and height//
    //////////////////////////////////
    $("#user_image").change(function() {
        var user_image = document.getElementById("user_image");
        var reader = new FileReader();
        reader.readAsDataURL(user_image.files[0]);
        reader.onload = function(e) {
            var image = new Image();
            image.src = e.target.result;
            image.onload = function() {
                var height = this.height;
                var width = this.width;
                if (height != 600 || width != 300) {
                    alert("Invalid dimensions.");
                    $("#user_image").val(null);
                    return false;
                }
            };
        }
    });
    $("#user_image1").change(function() {
        var user_image1 = document.getElementById("user_image1");
        var reader = new FileReader();
        reader.readAsDataURL(user_image1.files[0]);
        reader.onload = function(e) {
            var image = new Image();
            image.src = e.target.result;
            image.onload = function() {
                var height = this.height;
                var width = this.width;
                if (height != 600 || width != 160) {
                    alert("Invalid dimensions.");
                    $("#user_image1").val(null);
                    return false;
                }
            };
        }
    });
    $("#user_image2").change(function() {
        var user_image2 = document.getElementById("user_image2");
        var reader = new FileReader();
        reader.readAsDataURL(user_image2.files[0]);
        reader.onload = function(e) {
            var image = new Image();
            image.src = e.target.result;
            image.onload = function() {
                var height = this.height;
                var width = this.width;
                if (height != 90 || width != 728) {
                    alert("Invalid dimensions.");
                    $("#user_image2").val(null);
                    return false;
                }
            };
        }
    });
    $("#user_image3").change(function() {
        var user_image3 = document.getElementById("user_image3");
        var reader = new FileReader();
        reader.readAsDataURL(user_image3.files[0]);
        reader.onload = function(e) {
            var image = new Image();
            image.src = e.target.result;
            image.onload = function() {
                var height = this.height;
                var width = this.width;
                if (height != 300 || width != 720) {
                    alert("Invalid dimensions.");
                    $("#user_image3").val(null);
                    return false;
                }
            };
        }
    });
});

//   jQuery(function ($) {
//     var $inputs = $('input[name="user_image"], input[name="user_image1"], input[name="user_image2"], input[name="user_image3"]');
//     $inputs.on('input', function () {
//         // Set the required property of the other input to false if this input is not empty.
//         $inputs.not(this).prop('required', !$(this).val().length);
//     });
// });