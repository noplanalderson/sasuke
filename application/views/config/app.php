<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SASUKE - Konfigurasi</title>

    <link rel="icon" href="<?= site_url('assets/img/logo-default.png');?>">

    <!-- Custom fonts for this template-->
    <link href="<?= site_url('assets/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css');?>">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= site_url('assets/css/sb-admin-2.min.css');?>" rel="stylesheet">
    <link href="<?= site_url('assets/css/custom.css');?>" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-8 col-lg-12 col-md-12">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <img class="logo-sasuke" src="<?= site_url('assets/img/logo-default.png');?>">
                                    <div class="text-center mb-4">
                                        <h1 class="h4 text-gray-900">SASUKE <?= SASUKE_VERSION ?></h1>
                                        <small>Konfigurasi Aplikasi dan User</small>
                                    </div>
                                    <div id="msg_config" class="alert" style="display: none">
                                        <small class="msg_config">
                                        </small>
                                    </div>
                                    
								    <?= form_open_multipart('konfigurasi/submit', 'method="post" id="form_app" accept-charset="utf-8"');?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Judul Aplikasi</label>
                                                    <input type="text" id="judul_app" name="judul_app" placeholder="Judul Aplikasi" class="form-control" required="required"/>
                                                    <small class="text-danger">Hanya alfanumerik spasi dan dash</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Judul Aplikasi (alt)</label>
                                                    <input type="text" id="judul_app_alt" name="judul_app_alt" placeholder="Judul Aplikasi (alt)" class="form-control" />
                                                    <small class="text-danger">Hanya alfanumerik spasi dan dash</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Username</label>
                                                <input type="text" id="user_name" name="user_name" placeholder="Username" class="form-control" required="required"/>
                                                <small class="text-danger">Hanya alfanumerik dan underscore</small>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Email</label>
                                                <input type="email" id="user_email" name="user_email" placeholder="you@somewhere.com" class="form-control" required="required"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
            								    	<label>Password</label>
            										<input type="password" id="user_password" name="user_password" placeholder="********" class="form-control" required="required"/>
                                                    <small class="text-danger">Password harus terdiri dari Uppercase, Lowercase, Numerik, dan Simbol min. 8 karakter</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Repeat Password</label>
                                                    <input type="password" id="repeat_password" name="repeat_password" placeholder="********" class="form-control" required="required"/>
                                                    <small class="text-danger">Password harus cocok.</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Footer Aplikasi</label>
                                            <input type="text" id="text_footer_app" name="text_footer_app" placeholder="Footer Aplikasi" class="form-control" required="required" />
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Logo Aplikasi</label>
                                                    <input type="file" class="form-control" name="logo_app" id=logo_app accept="image/*">
                                                    <small class="text-danger">Ekstensi gambar harus JPG, JPEG, PNG maks. 5MB.</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Icon Aplikasi</label>
                                                    <input type="file" class="form-control" name="icon_app" id=icon_app accept="image/*">
                                                    <small class="text-danger">Ekstensi gambar harus JPG, JPEG, PNG maks. 5MB.</small>
                                                </div>
                                            </div>
                                        </div>
										<button type="submit" id="submit" class="btn btn-block btn-primary mt-3" name="submit">Submit</button>
								    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="<?= site_url('assets/vendor/jquery/jquery.min.js');?>"></script>
    <script src="<?= site_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="<?= site_url('assets/vendor/jquery-easing/jquery.easing.min.js');?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= site_url('assets/js/sb-admin-2.min.js');?>"></script>

    <script>
    $(document).ready(function (e) {
        $("#form_app").on('submit',(function(e) {
            e.preventDefault();

            var formAction = $("#form_app").attr('action');

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
                        $("#msg_config").removeAttr('style');
                        $('#msg_config').attr('class', 'alert alert-success');
                        $('.msg_config').html(data.msg);
                        $("#msg_config").slideDown('slow');
                        $("#msg_config").alert().delay(6000).slideUp('slow');
                        setTimeout(function () { window.location.href = "<?= base_url('konfigurasi/instansi');?>";}, 3000);
                    } else {
                        $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                        $("#msg_config").removeAttr('style');
                        $('#msg_config').attr('class', 'alert alert-danger');
                        $('.msg_config').html(data.msg);
                        $("#msg_config").slideDown('slow');
                        $("#msg_config").alert().delay(3000).slideUp('slow');
                    }
                }
            });
            return false;
        }));
    });
    </script>
</body>

</html>