<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= site_url('assets/vendor/jquery/jquery.min.js');?>"></script>
    <script src="<?= site_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
    <script src="<?= site_url('assets/vendor/parsleyjs/parsley.min.js');?>"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="<?= site_url('assets/vendor/jquery-easing/jquery.easing.min.js');?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= site_url('assets/js/sb-admin-2.min.js');?>"></script>
 
    <?= $script ?>

    <script>
    $("#submitPassword").click(function() {
        var formAction = $("#formPassword").attr('action');
        var dataPassword = {
            user_password: $("#user_password").val(),
            repeat_password: $("#repeat_password").val(),
            <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value')
        };

        $.ajax({
            type: "POST",
            url: formAction,
            data: dataPassword,
            dataType: 'json',
            success: function(data) {
                if (data.result == 1) {
                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                    $("#msg_pwd").removeAttr('style');
                    $('#msg_pwd').attr('class', 'alert alert-success');
                    $('.msg_pwd').html(data.msg);
                    $("#msg_pwd").slideDown('slow');
                    $("#msg_pwd").alert().delay(6000).slideUp('slow');
                } else {
                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                    $("#msg_pwd").removeAttr('style');
                    $('#msg_pwd').attr('class', 'alert alert-danger');
                    $('.msg_pwd').html(data.msg);
                    $("#msg_pwd").slideDown('slow');
                    $("#msg_pwd").alert().delay(3000).slideUp('slow');
                }
            }
        });
        return false;
    });

    $("#submitLogin").click(function() {
        var formAction = $("#formLogin").attr('action');
        var dataLogin = {
        	submit: $("#submitLogin").attr('name'),
            user_name: $("#user_name").val(),
            user_password: $("#user_password").val(),
            <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value')
        };

        $.ajax({
            type: "POST",
            url: formAction,
            data: dataLogin,
            dataType: 'json',
            success: function(data) {
                if (data.result == 1) {
                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                    $("#msg_login").removeAttr('style');
                    $('#msg_login').attr('class', 'alert alert-success');
                    $('.msg_login').html(data.msg);
                    $("#msg_login").slideDown('slow');
                    $("#msg_login").alert().delay(6000).slideUp('slow');
                    setTimeout(function () { window.location.href = "<?= base_url('dashboard');?>";}, 2000);
                } else {
                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                    $("#msg_login").removeAttr('style');
                    $('#msg_login').attr('class', 'alert alert-danger');
                    $('.msg_login').html(data.msg);
                    $("#msg_login").slideDown('slow');
                    $("#msg_login").alert().delay(3000).slideUp('slow');
                }
            }
        });
        return false;
    });

    $(".show-btn-password").click(function() {
    	var showBtn = $('.show-btn-password');
    	var formPassword = $('#user_password').attr('type');

    	if(formPassword === "password"){
          showBtn.attr('class', 'show-btn-password hide-btn');
          $('#user_password').attr('type', 'text');
        }else{
          $('#user_password').attr('type', 'password');
          showBtn.attr('class', 'show-btn-password');
        }
    });
   
   	$(".show-btn-repeat").click(function() {
    	var showBtn = $('.show-btn-repeat');
    	var formPassword = $('#repeat_password').attr('type');

    	if(formPassword === "password"){
          showBtn.attr('class', 'show-btn-repeat hide-btn');
          $('#repeat_password').attr('type', 'text');
        }else{
          $('#repeat_password').attr('type', 'password');
          showBtn.attr('class', 'show-btn-repeat');
        }
    });

   	$(function(){
   		$('#akun').on('click', function() {
            $.ajax({
                url: '<?= base_url("get-akun");?>',
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
	                if (data.result == 1) {
	                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
	                    $("#msg_akun").removeAttr('style');
	                    $('#msg_akun').attr('class', 'alert alert-success');
	                    $('.msg_akun').html(data.msg);
	                    $("#msg_akun").slideDown('slow');
	                    $("#msg_akun").alert().delay(6000).slideUp('slow');
	                    setTimeout(location.reload.bind(location), 1000);
	                } else {
	                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
	                    $("#msg_akun").removeAttr('style');
	                    $('#msg_akun').attr('class', 'alert alert-danger');
	                    $('.msg_akun').html(data.msg);
	                    $("#msg_akun").slideDown('slow');
	                    $("#msg_akun").alert().delay(3000).slideUp('slow');
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
    </script>
</body>

</html>