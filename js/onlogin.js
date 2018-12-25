$('select').selectpicker();
var x = document.getElementById("mapholder");
var latitude;
var longitude;

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    window.latitude = position.coords.latitude;
    window.longitude = position.coords.longitude;
    var img_url = "https://maps.googleapis.com/maps/api/staticmap?center=" + latlon + "&zoom=14&size=400x200&key=AIzaSyCPZiUzoenAWSuTMW5LJhzxFSXYFrzVdQI";
    document.getElementById("mapholder").innerHTML = "<img src='" + img_url + "'>";
}

function showError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            x.innerHTML = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred."
            break;
    }
}
var list;
/*$("#sel").click(function(e) {
	var x = document.getElementById("sel").length;
		console.log(x);
	$("#sel").append(list);
	var code = {};
	$("select[name='timeslot'] > option").each(function() {
		if(code[this.text]) {
			$(this).remove();
		} else {
			code[this.text] = this.value;
		}
	});
});*/
$(document).ready(function() {
    //list = '<?php// echo dynamic_list(); ?>';
    $('#add_btn').click(function() {
        $('#user_form')[0].reset();
        $('.modal-title').text("Add Ads");
        $('#action').val("UPLOAD");
        $('#operation').val("UPLOAD");
        $('#time-div').css({"display":"none"});
    });
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
    //////////////////////////////////
    ////////////Datatable/////////////
    /////////////////////////////////
    var dataTable = $("#result").DataTable({
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "bAutoWidth": false,
        "aoColumns": [{
            sWidth: '300px'
        }, {
            sWidth: '300px'
        }, {
            sWidth: '300px'
        }, {
            sWidth: '300px'
        }, {
            sWidth: '320px'
        }],
        "order": [],
        "ajax": {
            url: "select.php",
            type: "POST"
        },
        "columnDefs": [{
            "target": [0, 3, 4],
            "orderable": false
        }, ],
    });
    ///////////////////////////
    ///////form submit/////////
    //////////////////////////
    $(document).on('submit', '#user_form', function(event) {
        event.preventDefault();
        var name = $('#adName').val();
        var desc = $('#desc').val();
        var timeslot = $("#sel option:selected").val();
        var places = $("#place").val();

        //validating image file
        var extension = $("#user_image").val().split('.').pop().toLowerCase();
        var extension1 = $("#user_image1").val().split('.').pop().toLowerCase();
        var extension2 = $("#user_image2").val().split('.').pop().toLowerCase();
        if (extension != '' && extension1 != '' && extension2 != '') {
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid Image File!");
                $("#user_image").val('');
                return false;
            }
            if (jQuery.inArray(extension1, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid Image File!");
                $("#user_image1").val('');
                return false;
            }
            if (jQuery.inArray(extension2, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid Image File!");
                $("#user_image2").val('');
                return false;
            }
        }
        if (timeslot != '' && name != '' && desc != '') {
            $.ajax({
                url: "insert.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    alert(data);
                    $("#user_form")[0].reset();
                    $("#adModal").modal('hide');
                    dataTable.ajax.reload();
                    window.location.href = window.location.href;
                }
            });
        } else {
            alert("Please select the option");
        }
    });

    $("#addPlace").keypress(function(e) {
        if (e.which == 13) {
            var place = $('#addPlace').val();
            $('<option>').val(place).text(place).appendTo($("#place"));
            $.post("addPlace.php", {
                place: place
            }, function(data) {
                alert(data);
            });
        }
    });

    $(document).on('click', '.update', function() {
        var user_id = $(this).attr("id");
        $.ajax({
            url: "update.php",
            method: "POST",
            data: {
                user_id: user_id
            },
            dataType: "json",
            success: function(data) {
                $('#adModal').modal('show');
                $('#adName').val(data.adname);
                $('#desc').val(data.desc);
                var timeslot = parseInt(data.timeslot);
                alert(timeslot);
                $('#time').val("Edit data for Slot "+data.timeslot+"-"+(timeslot+2));
                $('#selopt').css({"display":"none"});
                var string = data.place;
                var array = string.split(',');
                for(var i=0;i<array.length;i++){ 
                    $("#place option[value='"+array[i]+"']").prop("selected",true);
                }
                $('#ad_uploaded').html(data.img);
                $('#ad_uploaded1').html(data.img1);
                $('#ad_uploaded2').html(data.img2);
                $('#ad_uploaded3').html(data.img3);
                $('.modal-title').text("Edit Details");
                $('#user_id').val(user_id);
                $('#action').val("Edit");
                $("#operation").val("Edit");
            }
        })
    });

    $(document).on('click', '.delete', function() {
        var user_id = $(this).attr("id");
        if (confirm("Are you sure you want to remove this?")) {
            $.ajax({
                url: "delete.php",
                method: "POST",
                data: {
                    user_id: user_id
                },
                success: function(data) {
                	alert(data);
                    dataTable.ajax.reload();
                    window.location.href = window.location.href;
                }
            })
        } else {
            return false;
        }
    });
});

$('#adModal').on('hidden.bs.modal', function() {
    //$("#user_form")[0].reset();
    window.location.href = window.location.href;
});

function copyText(thi) {
    if (thi.id == "copyIcon1") {
        var copyText = document.getElementById("input-copy1");
    } else if (thi.id == "copyIcon2") {
        var copyText = document.getElementById("input-copy2");
    } else if (thi.id == "copyIcon3") {
        var copyText = document.getElementById("input-copy3");
    } else if (thi.id == "copyIcon4") {
        var copyText = document.getElementById("input-copy4");
    }
    copyText.select();
    document.execCommand("copy");
    alert("Copied the text:" + copyText.value);
}