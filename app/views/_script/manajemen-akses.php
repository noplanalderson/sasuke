    <!-- Page level plugins -->
	<script src="<?= site_url('assets/vendor/select2/js/select2.min.js');?>"></script>
    <script>
    $(function(){
        $('.tambah-akses').on('click', function() {
        	$('.modal-title').html('Tambah Tipe Akses');
            $('.modal-footer button[type=submit]').html('Tambah');
            $('.modal-body form').attr('action', '<?= base_url("tambah-role");?>');
            $('#id_type').val('');
            $('#user_type').val('');
            $('#id_menu').select2({
                dropdownParent: $('#aksesModal'),
                minimumResultsForSearch: Infinity,
                placeholder: 'Pilih Roles'
            }).val('').trigger('change');
        });
        $('.edit-akses').on('click', function() {
            $('.modal-title').html('Edit Tipe Akses');
            $('.modal-footer button[type=submit]').html('Update');
            $('.modal-body form').attr('action', '<?= base_url("edit-role");?>');

            const id_type = $(this).data('id');
            $.ajax({
                url: '<?= base_url("get-role");?>',
                data: {
                        id: id_type, 
                        <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value')
                    },
                method: 'post',
                dataType: 'json',
                success: function(data){
                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                    $('#id_type').val(id_type);
                    $('#user_type').val(data.user_type);

                    var roles = data.roles;

                    if (roles) {
                        var arrayRoles = roles.split(',');
                        $('#id_menu').select2({
                            dropdownParent: $('#aksesModal'),
                            minimumResultsForSearch: Infinity,
                            placeholder: 'Pilih Roles'
                        }).val(arrayRoles).trigger('change');
                    }
                    else
                    {
                        $('#id_menu').select2({
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
            <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value')
        };

        $.ajax({
            type: "POST",
            url: formAction,
            data: dataAkses,
            dataType: 'json',
            success: function(data) {
                
                $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                $('.msg').html(data.msg);
                $("#msg").slideDown('slow');

                if (data.result == 1) {
                    $('#msg').attr('class', 'alert alert-success');
                    $("#msg").alert().delay(6000).slideUp('slow');
                    setTimeout(location.reload.bind(location), 1000);
                } else {
                    $('#msg').attr('class', 'alert alert-danger');
                    $("#msg").alert().delay(3000).slideUp('slow');
                }
            }
        });
        return false;
    });

  $("#akses-list").on('click', '.btn-delete', function(){
    var result = confirm("Anda yakin ingin menghapus akses ini?");

      if (result) {
          var $tr = $(this).closest('tr');
          const id_type = $(this).data('id');

          $.ajax({
              url: '<?= base_url("hapus-role/");?>' + id_type,
              method: 'get',
              dataType: 'json',
              success: function(data) {

                if (data.result == 1) {
                  $('#delete_msg').attr('class', 'alert alert-success');
                  $tr.find('td').fadeOut(1000,function(){ 
                    $tr.remove();                    
                  });
                } 
                else {
                  $('#delete_msg').attr('class', 'alert alert-danger');
                }

                $('.delete_msg').html(data.msg);
                $("#delete_msg").slideDown('slow');
                $("#delete_msg").alert().delay(6000).slideUp('slow');
              }
          });
      }
  });
    </script>