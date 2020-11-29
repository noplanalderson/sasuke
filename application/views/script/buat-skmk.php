    <script src="<?= site_url('assets/vendor/datetimepicker/build/jquery.datetimepicker.full.min.js');?>"></script>
    <script src="<?= site_url('assets/vendor/tags/jquery.tagsinput.min.js');?>"></script>

    <script>
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

    $("#submit").click(function() {
        var formAction = $("#formSkmk").attr('action');
        var dataSKMK = {
            <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value'),
            nomor: $("#nomor").val(),
            no_skmk: $("#no_skmk").val(),
            id_pejabat: $("#id_pejabat").val(),
            nama_pelapor: $("#nama_pelapor").val(),
            nama_terlapor: $("#nama_terlapor").val(),
            no_ktp_pelapor: $("#no_ktp_pelapor").val(),
            no_ktp_terlapor: $("#no_ktp_terlapor").val(),
            pekerjaan_pelapor: $("#pekerjaan_pelapor").val(),
            pekerjaan_terlapor: $("#pekerjaan_terlapor").val(),
            hubungan: $("#hubungan").val(),
            tempat_lahir_pelapor: $("#tempat_lahir_pelapor").val(),
            tempat_lahir_terlapor: $("#tempat_lahir_terlapor").val(),
            tgl_lahir_pelapor: $("#tgl_lahir_pelapor").val(),
            tgl_lahir_terlapor: $("#tgl_lahir_terlapor").val(),
            alamat_pelapor: $("#alamat_pelapor").val(),
            alamat_terlapor: $("#alamat_terlapor").val(),
            tgl_meninggal: $("#tgl_meninggal").val(),
            lokasi_meninggal: $("#lokasi_meninggal").val(),
            tembusan: $("#tembusan").val(),
            submit: $("#submit").val()
        };

        $.ajax({
            type: "POST",
            url: formAction,
            data: dataSKMK,
            dataType: 'json',
            success: function(data) {
                if (data.result == 1) {
                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                    $("#msg_skmk").removeAttr('style');
                    $('#msg_skmk').attr('class', 'alert alert-success');
                    $('.msg_skmk').html(data.msg);
                    $("#msg_skmk").slideDown('slow');
                    $("#msg_skmk").alert().delay(3000).slideUp('slow');
                    setTimeout(function () { window.location.href = "<?= base_url('surat-kematian');?>";}, 2000);
                } else {
                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                    $("#msg_skmk").removeAttr('style');
                    $('#msg_skmk').attr('class', 'alert alert-danger');
                    $('.msg_skmk').html(data.msg);
                    $("#msg_skmk").slideDown('slow');
                    $("#msg_skmk").alert().delay(3000).slideUp('slow');
                }
            }
        });
        return false;
    });
    </script>