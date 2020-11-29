    <!-- Page level plugins -->
    <script src="<?= site_url('assets/vendor/datatables/jquery.dataTables.min.js');?>"></script>
    <script src="<?= site_url('assets/vendor/datatables/dataTables.bootstrap4.min.js');?>"></script>
	<script src="<?= site_url('assets/vendor/select2/js/select2.min.js');?>"></script>
    <!-- Page level custom scripts -->
    <script src="<?= site_url('assets/js/demo/datatables-demo.js');?>"></script>
    <script>
    $(function(){
        $('.tambah-jabatan').on('click', function() {
        	$('.modal-title').html('Tambah Jabatan');
            $('.modal-footer button[type=submit]').html('Tambah');
            $('.modal-body form').attr('action', '<?= base_url("tambah-jabatan");?>');
            $('#id_jabatan').val('');
            $('#nama_jabatan').val('');
        });
        $('.edit-jabatan').on('click', function() {
            $('.modal-title').html('Edit Jabatan');
            $('.modal-footer button[type=submit]').html('Update');
            $('.modal-body form').attr('action', '<?= base_url("edit-jabatan");?>');

            const id_jabatan = $(this).data('id');
            $.ajax({
                url: '<?= base_url("get-jabatan");?>',
                data: {
                        id: id_jabatan, 
                        <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value')
                    },
                method: 'post',
                dataType: 'json',
                success: function(data){
                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                    $('#id_jabatan').val(id_jabatan);
                    $('#nama_jabatan').val(data.nama_jabatan);
                }
            });
        });
    });

    $("#submit").click(function() {
        var formAction = $("#jabatanForm").attr('action');
        var dataJabatan = {
            id_jabatan: $("#id_jabatan").val(),
            nama_jabatan: $("#nama_jabatan").val(),
            <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value')
        };

        $.ajax({
            type: "POST",
            url: formAction,
            data: dataJabatan,
            dataType: 'json',
            success: function(data) {
                if (data.result == 1) {
                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                    $("#msg_jabatan").removeAttr('style');
                    $('#msg_jabatan').attr('class', 'alert alert-success');
                    $('.msg_jabatan').html(data.msg);
                    $("#msg_jabatan").slideDown('slow');
                    $("#msg_jabatan").alert().delay(3000).slideUp('slow');
                    setTimeout(location.reload.bind(location), 1000);
                } else {
                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                    $("#msg_jabatan").removeAttr('style');
                    $('#msg_jabatan').attr('class', 'alert alert-danger');
                    $('.msg_jabatan').html(data.msg);
                    $("#msg_jabatan").slideDown('slow');
                    $("#msg_jabatan").alert().delay(3000).slideUp('slow');
                }
            }
        });
        return false;
    });
    </script>