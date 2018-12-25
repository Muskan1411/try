$(document).ready(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) /*height in pixels when the navbar becomes non opaque*/ {
          
            $('.navbar').addClass('opaque');
            $('.font-bold,.nav-link').css({
                "color": "white"
            });
            $('.tagline').css({
                "color": "white"
            });
            $('.font-bold').css({
                "font-size": "35px"
            });
            $('.font-large').css({
                "font-size": "38px"
            });
            if ($(window).width() > 661) {
                $('.font-bold').css({
                    "letter-spacing": "2px"
                });
            }
        } else {
            $('.font-bold').css({
                "letter-spacing": "0px"
            });
            $('.navbar').removeClass('opaque');
            $('.tagline').css({
                "color": "#901108"
            });
            $('.font-bold').css({
                "color": "#303030"
            });
            $('.nav-link').css({
                "color": "#901108"
            });
            $('li.active > a').css({
                "css": "#303030"
            });
            if ($(window).width() > 661) {
                $('.font-bold').css({
                    "font-size": "38px"
                });
                $('.font-large').css({
                    "font-size": "68px"
                });
            }
        }
    });
});

//Geolocation
$(document).on('click', '#location', function(event) {
    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
    latitude = position.coords.latitude;
    longitude = position.coords.longitude;
    /*function showPosition(position) {
        x.innerHTML="Latitude: " + position.coords.latitude + 
        "<br>Longitude: " + position.coords.longitude;
    }*/
});


$(document).on('submit', '#addPlaceForm', function() {
    $.ajax({
        url: "addPlace.php",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        processData: false,
        success:function(data) {
            alert(data);
        }

    })
})