    <script>
    $(document).ready(function (e) {
        $("#form_instansi").on('submit',(function(e) {
            e.preventDefault();

            var formAction = $("#form_instansi").attr('action');

            $.ajax({
                type: "POST",
                url: formAction,
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                dataType:'json',
                success: function(data) {
                    if (data.result == 1) {
                        $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                        $("#msg_instansi").removeAttr('style');
                        $('#msg_instansi').attr('class', 'alert alert-success');
                        $('.msg_instansi').html(data.msg);
                        $("#msg_instansi").slideDown('slow');
                        $("#msg_instansi").alert().delay(6000).slideUp('slow');
                    } else {
                        $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                        $("#msg_instansi").removeAttr('style');
                        $('#msg_instansi').attr('class', 'alert alert-danger');
                        $('.msg_instansi').html(data.msg);
                        $("#msg_instansi").slideDown('slow');
                        $("#msg_instansi").alert().delay(3000).slideUp('slow');
                    }
                }
            });
            return false;
        }));
    });
    </script>