jQuery('#tgl_meninggal').datetimepicker({
    format:'Y-m-d H:i',
    mask:true
});

$(function() {
  $('#tembusan').tagsInput({
    width: 'auto',
    defaultText:"Tembusan"
  });
});

$(document).ready(function(e){
    $("#formSkmk").on('submit', function(e) {
        
        e.preventDefault();

        var formAction = $("#formSkmk").attr('action');
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

                if (data.result == 1) {
                    Swal.fire('Success!', data.msg, 'success');
                    setTimeout(function () { window.location.href = baseURI + '/surat-kematian';}, 2000);
                } else {
                    Swal.fire('Failed!', data.msg, 'error');
                }
            }
        });
        return false;
    });
});