$("#form_smtp").on('submit',(function(e) {
    e.preventDefault();

    var baseURI = $('base').attr('href');
    var formAction = $("#form_smtp").attr('action');

    $.ajax({
        type: "POST",
        url: formAction,
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType:'json',
        success: function(data) {
            $('.csrf_token').val(data.token);

            if (data.result == 1) {
                Swal.fire('Berhasil!', data.msg, 'success');
                setTimeout(function () { window.location.reload(); }, 2000);
            } else {
                Swal.fire('Gagal!', data.msg, 'error');
            }
        }
    });
    return false;
}));