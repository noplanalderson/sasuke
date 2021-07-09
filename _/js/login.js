
  $(document).ready(function(e){
      $("#formLogin").on('submit', function(e) {
        
        e.preventDefault();

        var formAction = $("#formLogin").attr('action');
        var baseURI = $('base').attr('href');

        $.ajax({
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            timeout: 10000,
            url: formAction,
            dataType: 'json',
            success: function(data) {
                
                $('.csrf_token').val(data.token);
                $('.msg_login').html(data.msg);
                $("#msg_login").slideDown('fast');
                
                if (data.result == 1) {
                    $('#msg_login').attr('class', 'alert alert-success');
                    $("#msg_login").alert().delay(6000).slideUp('fast');
                    setTimeout(function () { window.location.href = baseURI + '/' + data.url;}, 2000);
                } else {
                    $('#msg_login').attr('class', 'alert alert-danger');
                    $("#msg_login").alert().delay(3000).slideUp('fast');
                }
            }
        });
        return false;
    });
  });