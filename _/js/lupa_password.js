    $("#formLupa").on('submit', function(e) {
        
        e.preventDefault();

        var formAction = $("#formLupa").attr('action');
        var baseURI = $('base').attr('href');
                
        Swal.fire({
            title: 'Tunggu!',
            text: 'Membuat Link Reset Password...',
            showConfirmButton: false,
            type: 'info'
        });

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
                    Swal.fire('Berhasil!', data.msg, 'success');
                    setTimeout(function () { window.location.href = baseURI;}, 2000);
                } else {
                    Swal.fire('Gagal!', data.msg, 'error');
                }
            }
        });
        return false;
    });