    var baseURI = $('base').attr('href');

    $(function(){
        $('.tambah-akses').on('click', function() {
        	$('.modal-title').html('Tambah Tipe Akses');
            $('.modal-footer button[type=submit]').html('Tambah');
            $('.modal-body form').attr('action', baseURI + '/tambah-role');
            $('#id_type').val('');
            $('#user_type').val('');
            $('#id_menu').select2({
                width: '100%',
                dropdownParent: $('#aksesModal'),
                minimumResultsForSearch: Infinity,
                placeholder: 'Pilih Roles'
            }).val('').trigger('change');
        });
        $('.edit-akses').on('click', function() {
            $('.modal-title').html('Edit Tipe Akses');
            $('.modal-footer button[type=submit]').html('Update');
            $('.modal-body form').attr('action', baseURI + '/edit-role');

            const id_type = $(this).data('id');
            $.ajax({
                url: baseURI + '/get-role',
                data: {
                        id: id_type, 
                        sasuke_token: $('meta[name="X-CSRF-TOKEN"]').attr('content')
                    },
                method: 'post',
                dataType: 'json',
                success: function(data){
                    $('.csrf_token').val(data.token);
                    $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);
                    $('#id_type').val(id_type);
                    $('#user_type').val(data.user_type);

                    var roles = data.roles;

                    if (roles) {
                        var arrayRoles = roles.split(',');
                        $('#id_menu').select2({
                            width: '100%',
                            dropdownParent: $('#aksesModal'),
                            minimumResultsForSearch: Infinity,
                            placeholder: 'Pilih Roles'
                        }).val(arrayRoles).trigger('change');
                    }
                    else
                    {
                        $('#id_menu').select2({
                            width: '100%',
                            dropdownParent: $('#aksesModal'),
                            minimumResultsForSearch: Infinity,
                            placeholder: 'Pilih Roles'
                        }).val('').trigger('change');
                    }
                }
            });
        });
    });

    $("#aksesForm").on('submit', function() {
        var formAction = $("#aksesForm").attr('action');
        var dataAkses = {
            id_type: $("#id_type").val(),
            user_type: $("#user_type").val(),
            id_menu: $("#id_menu").val(),
            sasuke_token: $('.csrf_token').attr('value')
        };

        $.ajax({
            type: "POST",
            url: formAction,
            data: dataAkses,
            dataType: 'json',
            success: function(data) {
                
                $('.csrf_token').val(data.token);
                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

                if (data.result == 1) {
                    Swal.fire('Success!', data.msg, 'success');
                    setTimeout(location.reload.bind(location), 1000);
                } else {
                    Swal.fire('Failed!', data.msg, 'error');
                }
            }
        });
        return false;
    });

    $("#akses-list").on('click', '.btn-delete', function(e){

      e.preventDefault();

        Swal.fire({
            text: 'Anda yakin ingin menghapus tipe akses ini?',
            showCancelButton: true,
            type: 'warning',
            confirmButtonText: 'Yes',
            reverseButtons: true
        }).then((result) => {

            if (result.value == true) {
                var $tr = $(this).closest('tr');
                const id_type = $(this).data('id');

                $.ajax({
                    url: baseURI + '/hapus-role/' + id_type,
                    method: 'get',
                    dataType: 'json',
                    success: function(data) {

                    if (data.result == 1) {
                      Swal.fire('Success!', data.msg, 'success');
                      $tr.find('td').fadeOut(1000,function(){ 
                        $tr.remove();                    
                      });
                    } 
                    else {
                      Swal.fire('Failed!', data.msg, 'error');
                    }
                  }
              });
            }
        })
    });

    $("#akses-list").on('change', '.index_page', function(){
        
        const type_id = $(this).data('id');
        var index_page = $('select[data-id="'+type_id+'"]').val();

        $.ajax({
            url: baseURI + '/update-index',
            data: { 
                id: type_id,
                index_page: index_page,
                sasuke_token: $('meta[name="X-CSRF-TOKEN"]').attr('content')
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {

                $('.csrf_token').val(data.token);
                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

                if(data.result == 0) {
                    $('.index_page option').prop('selected', function() {
                        return this.defaultSelected;
                    });;
                }
            }
        });
    });