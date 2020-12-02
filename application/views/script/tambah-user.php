    <script>
    $(document).ready(function (e) {
        $("#Userman").on('submit',(function(e) {
            e.preventDefault();

            var formAction = $("#Userman").attr('action');

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
                        $("#msg_user").removeAttr('style');
                        $('#msg_user').attr('class', 'alert alert-success');
                        $('.msg_user').html(data.msg);
                        $("#msg_user").slideDown('slow');
                        $("#msg_user").alert().delay(3000).slideUp('slow');
                        setTimeout(function () { window.location.href = "<?= base_url('manajemen-user');?>";}, 3000);
                    } else {
                        $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                        $("#msg_user").removeAttr('style');
                        $('#msg_user').attr('class', 'alert alert-danger');
                        $('.msg_user').html(data.msg);
                        $("#msg_user").slideDown('slow');
                        $("#msg_user").alert().delay(3000).slideUp('slow');
                    }
                }
            });
            return false;
        }));
    });
    </script>