    <!-- Page level plugins -->
    <script src="<?= site_url('assets/vendor/datatables/jquery.dataTables.min.js');?>"></script>
    <script src="<?= site_url('assets/vendor/datatables/dataTables.bootstrap4.min.js');?>"></script>
	<script src="<?= site_url('assets/vendor/select2/js/select2.min.js');?>"></script>
    <!-- Page level custom scripts -->
    <script src="<?= site_url('assets/js/demo/datatables-demo.js');?>"></script>
    <script>
    $(function(){
        $('.tambah-pejabat').on('click', function() {
        	$('.modal-title').html('Tambah Pejabat');
            $('.modal-footer button[type=submit]').html('Tambah');
            $('.modal-body form').attr('action', '<?= base_url("tambah-pejabat");?>');
            $('#id_pejabat').val('');
            $('#nip').val('');
            $('#id_jabatan').val('');
            $('#nama_pejabat').val('');
        });
        $('.edit-pejabat').on('click', function() {
            $('.modal-title').html('Edit Pejabat');
            $('.modal-footer button[type=submit]').html('Update');
            $('.modal-body form').attr('action', '<?= base_url("edit-pejabat");?>');

            const id_pejabat = $(this).data('id');
            $.ajax({
                url: '<?= base_url("get-pejabat");?>',
                data: {
                        id: id_pejabat, 
                        <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value')
                    },
                method: 'post',
                dataType: 'json',
                success: function(data){
                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                    $('#id_pejabat').val(id_pejabat);
                    $('#nip').val(data.nip);
                    $('#id_jabatan').val(data.id_jabatan);
                    $('#nama_pejabat').val(data.nama_pejabat);
                }
            });
        });
    });

    $("#submit").click(function() {
        var formAction = $("#pejabatForm").attr('action');
        var dataPejabat = {
            id_pejabat: $("#id_pejabat").val(),
            id_jabatan: $("#id_jabatan").val(),
            nip: $("#nip").val(),
            nama_pejabat: $("#nama_pejabat").val(),
            <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value')
        };

        $.ajax({
            type: "POST",
            url: formAction,
            data: dataPejabat,
            dataType: 'json',
            success: function(data) {
                if (data.result == 1) {
                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                    $("#msg_pejabat").removeAttr('style');
                    $('#msg_pejabat').attr('class', 'alert alert-success');
                    $('.msg_pejabat').html(data.msg);
                    $("#msg_pejabat").slideDown('slow');
                    $("#msg_pejabat").alert().delay(3000).slideUp('slow');
                    setTimeout(location.reload.bind(location), 1000);
                } else {
                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                    $("#msg_pejabat").removeAttr('style');
                    $('#msg_pejabat').attr('class', 'alert alert-danger');
                    $('.msg_pejabat').html(data.msg);
                    $("#msg_pejabat").slideDown('slow');
                    $("#msg_pejabat").alert().delay(3000).slideUp('slow');
                }
            }
        });
        return false;
    });
    </script>