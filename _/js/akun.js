	var baseURI = $('base').attr('href');

    $("#formPassword").on('submit', function(e) {
    	
    	e.preventDefault();

        var formAction = $("#formPassword").attr('action');
        var dataPassword = {
            user_password: $("#user_password").val(),
            repeat_password: $("#repeat_password").val(),
            sasuke_token: $('.csrf_token').val(),
            kode: $('#kode').val()
        };

        $.ajax({
            type: "POST",
            url: formAction,
            data: dataPassword,
            dataType: 'json',
            success: function(data) {
            	$('.csrf_token').val(data.token);
            	$('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

                if (data.result == 1) {
                    Swal.fire('Berhasil!', data.msg, 'success');
                } else {
                    Swal.fire('Gagal!', data.msg, 'error');
                }
            }
        });
        return false;
    });

   	$(function(){
   		$('#akun').on('click', function() {
            $.ajax({
                url: baseURI + '/get-akun',
                method: 'get',
                dataType: 'json',
                success: function(data){
                    $('#user_name').val(data.user_name);
                    $('#user_email').val(data.user_email);
                    $('#user_picture_old').val(data.user_picture);
                }
            });
        });
   	})

   	$(document).ready(function(e){
	    $("#formAkun").on('submit', function(e) {
	    	e.preventDefault();

	        var formAction = $("#formAkun").attr('action');

	        $.ajax({
	            type: "POST",
	            data: new FormData(this),
	            processData: false,
	            contentType: false,
	            cache: false,
	            timeout: 800000,
	            url: formAction,
	            dataType: 'json',
	            success: function(data) {
	                $('.csrf_token').val(data.token);
            		$('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);
	                
	                if (data.result == 1) {
	                    Swal.fire('Berhasil!', data.msg, 'success');
	                    $('.user-name').text(data.user_name)
	                    $('.img-profile').attr('src', baseURI + '/_/uploads/user_img/' + data.user_picture)
	                } else {
	                    Swal.fire('Gagal!', data.msg, 'error');
	                }
	            }
	        });
	        return false;
	    });
	});

	$("#user_picture").change(function() {
	    var file = this.files[0];
	    var fileType = file.type;
	    var match = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
	    if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]))){
	    	$("#msg_akun").removeAttr('style');
            $('#msg_akun').attr('class', 'alert alert-danger');
            $('.msg_akun').html('Maaf, ekstensi yang diizinkan hanya JPG, JPEG, WEBP, & PNG.');
            $("#msg_akun").slideDown('slow');
            $("#msg_akun").alert().delay(3000).slideUp('slow');
	        $("#user_picture").val('');
	        return false;
	    }
	});

   	$(document).ready(function(e){
	    $("#formAktivasi").on('submit', function(e) {

	    	e.preventDefault();

	        var formAction = $("#formAktivasi").attr('action');
	        var dataPassword = {
	            user_password: $("#user_password").val(),
	            repeat_password: $("#repeat_password").val(),
	            kode: $("#kode").val(),
	            sasuke_token: $('.csrf_token').val()
	        };

	        $.ajax({
	            type: "POST",
	            url: formAction,
	            data: dataPassword,
	            dataType: 'json',
	            success: function(data) {
	            	$('.csrf_token').val(data.token);
	            	$('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

	                if (data.result == 1) {
	                    Swal.fire('Berhasil!', data.msg, 'success');
	                    setTimeout(function () { window.location.href = baseURI;}, 2000);
	                } else {
	                    Swal.fire('Gagal!', data.msg, 'error');
	                }
	            }
	        });
	        return false;
	    });
	});