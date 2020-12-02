<script type="text/javascript">
    $("#submitLupa").click(function() {
        var formAction = $("#formLupa").attr('action');
        var dataLupa = {
            submit: $("#submitLupa").attr('name'),
            user_email: $("#user_email").val(),
            <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value')
        };

        $.ajax({
            type: "POST",
            url: formAction,
            data: dataLupa,
            dataType: 'json',
            success: function(data) {
                if (data.result == 1) {
                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                    $("#msg_lupa").removeAttr('style');
                    $('#msg_lupa').attr('class', 'alert alert-success');
                    $('.msg_lupa').html(data.msg);
                    $("#msg_lupa").slideDown('slow');
                    $("#msg_lupa").alert().delay(6000).slideUp('slow');
                } else {
                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                    $("#msg_lupa").removeAttr('style');
                    $('#msg_lupa').attr('class', 'alert alert-danger');
                    $('.msg_lupa').html(data.msg);
                    $("#msg_lupa").slideDown('slow');
                    $("#msg_lupa").alert().delay(3000).slideUp('slow');
                }
            }
        });
        return false;
    });

    $("#submitPassword").click(function() {
        var formAction = $("#formPassword").attr('action');
        var dataPassword = {
            user_password: $("#user_password").val(),
            repeat_password: $("#repeat_password").val(),
            submit: $('#submitPassword').val(),
            <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value')
        };

        $.ajax({
            type: "POST",
            url: formAction,
            data: dataPassword,
            dataType: 'json',
            success: function(data) {
                if (data.result == 1) {
                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                    $("#msg_pwd").removeAttr('style');
                    $('#msg_pwd').attr('class', 'alert alert-success');
                    $('.msg_pwd').html(data.msg);
                    $("#msg_pwd").slideDown('slow');
                    $("#msg_pwd").alert().delay(3000).slideUp('slow');
                    setTimeout(function () { window.location.href = "<?= base_url('login');?>";}, 2000);
                } else {
                    $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                    $("#msg_pwd").removeAttr('style');
                    $('#msg_pwd').attr('class', 'alert alert-danger');
                    $('.msg_pwd').html(data.msg);
                    $("#msg_pwd").slideDown('slow');
                    $("#msg_pwd").alert().delay(3000).slideUp('slow');
                }
            }
        });
        return false;
    });
</script>