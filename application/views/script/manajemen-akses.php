    <!-- Page level plugins -->
    <script src="<?= site_url('assets/vendor/datatables/jquery.dataTables.min.js');?>"></script>
    <script src="<?= site_url('assets/vendor/datatables/dataTables.bootstrap4.min.js');?>"></script>
	<script src="<?= site_url('assets/vendor/select2/js/select2.min.js');?>"></script>
    <!-- Page level custom scripts -->
    <script src="<?= site_url('assets/js/demo/datatables-demo.js');?>"></script>
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

    $("#submit").click(function() {
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
                if (data.result == 1) {
                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                    $("#msg").removeAttr('style');
                    $('#msg').attr('class', 'alert alert-success');
                    $('.msg').html(data.msg);
                    $("#msg").slideDown('slow');
                    $("#msg").alert().delay(6000).slideUp('slow');
                    setTimeout(location.reload.bind(location), 1000);
                } else {
                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                    $("#msg").removeAttr('style');
                    $('#msg').attr('class', 'alert alert-danger');
                    $('.msg').html(data.msg);
                    $("#msg").slideDown('slow');
                    $("#msg").alert().delay(3000).slideUp('slow');
                }
            }
        });
        return false;
    });
    </script>