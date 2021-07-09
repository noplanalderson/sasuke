$(document).ready(function(e){
    $("#formPassword").on('submit', function(e) {
        
        e.preventDefault();

        var formAction = $("#formPassword").attr('action');
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
                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);
                $("#msg_password").slideDown('slow');
                $('.msg_password').html(data.msg);

                if (data.result == 1) {
                    $('#msg_password').attr('class', 'alert alert-success');
                    $("#msg_password").alert().delay(3000).slideUp('slow');
                    setTimeout(function () { window.location.href = baseURI + '/login';}, 2000);
                } else {
                    $('#msg_password').attr('class', 'alert alert-danger');
                    $("#msg_password").alert().delay(3000).slideUp('slow');
                }
            }
        });
        return false;
    });
});