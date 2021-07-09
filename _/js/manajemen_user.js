    var baseURI = $('base').attr('href');

    $(document).ready(function(){
        'use strict';

        $('#tblUser').DataTable({
            responsive: true,
            "language": [{
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "emptyTable": "Tidak ada User",
                "lengthMenu": "_MENU_ &nbsp; user/halaman",
                "search": "Cari: ",
                "zeroRecords": "User tidak Ditemukan",
                "paginate": {
                  "previous": "<i class='fas fa-chevron-left'></i>",
                  "next": "<i class='fas fa-chevron-right'></i>",
                },
            }],
            ordering: true,
            dom: '<"left"l><"right"fr>',
        });
     });

    $(function(){
        $('.tambah-user').on('click', function() {
        	$('.modal-title').html('Tambah User');
            $('.modal-footer button[type=submit]').html('Tambah');
            $('.modal-body form').attr('action', baseURI + '/tambah-user');
            $('#is_active_box').attr('class', 'col-md-6 d-none');
            
            $('#id_user').val('');
            $('#user_name').val('');
            $('#user_email').val('');
            $('#nama_pegawai').val('');
            $('#nip').val('');
            $('#id_type').val('');
        });
        $("#tblUser").on('click', '.edit-user', function(){
            $('.modal-title').html('Edit User');
            $('.modal-footer button[type=submit]').html('Edit User');
            $('.modal-body form').attr('action', baseURI + '/edit-user');
            $('#is_active_box').attr('class', 'col-md-6');

            const id_user = $(this).data('id');
            $.ajax({
                url: baseURI + '/get-user',
                data: {
                        id: id_user, 
                        sasuke_token: $('meta[name="X-CSRF-TOKEN"]').attr('content')
                    },
                method: 'post',
                dataType: 'json',
                success: function(data){
                    $('.csrf_token').val(data.token);
                    $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);
                    $('#id_user').val(id_user)
                    $('#user_name').val(data.user_name);
                    $('#user_email').val(data.user_email);
                    $('#nama_pegawai').val(data.nama_pegawai);
                    $('#nip').val(data.nip);
                    $('#id_type').val(data.id_type);
                    if(data.is_active == 'TRUE') {
                        $('#is_active').prop('checked', true);
                    } else {
                        $('#is_active').prop('checked', false);
                    }
                }
            });
        });
    });

    $("#tblUser").on('click', '.delete-btn', function(e){
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
            const id_user = $(this).data('id');

            $.ajax({
                url: baseURI + '/hapus-user',
                data: { 
                id: id_user,
                sasuke_token: $('meta[name="X-CSRF-TOKEN"]').attr('content')
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {

                    $('.csrf_token').val(data.token);
                    $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

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

    $("#userForm").on('submit', function() {
        var formAction = $("#userForm").attr('action');
        var dataUser = {
            id_user : $('#id_user').val(),
            user_name : $('#user_name').val(),
            user_email : $('#user_email').val(),
            nama_pegawai : $('#nama_pegawai').val(),
            nip : $('#nip').val(),
            id_type : $('#id_type').val(),
            is_active : ($('#is_active').is(":checked")) ? true : false,
            sasuke_token : $('.csrf_token').val()
        };

        $.ajax({
            type: "POST",
            url: formAction,
            data: dataUser,
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