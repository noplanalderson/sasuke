<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SASUKE - Instansi</title>

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
                                        <small>Konfigurasi Instansi</small>
                                    </div>
                                    <div id="msg_instansi" class="alert" style="display: none">
                                        <small class="msg_instansi">
                                        </small>
                                    </div>
                                    
								    <?= form_open_multipart('konfigurasi/submit-instansi', 'method="post" id="form_instansi" accept-charset="utf-8"');?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Kode Surat Instansi *</label>
                                                    <input type="text" id="kode_instansi" name="kode_instansi" placeholder="Kode Instansi" class="form-control" required="required"/>
                                                    <small class="text-danger">Hanya huruf 2-10 karakter.</small>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Nama Instansi *</label>
                                                    <input type="text" id="nama_instansi" name="nama_instansi" placeholder="Nama Instansi" class="form-control" required="required" />
                                                    <small class="text-danger">Hanya alfanumerik, spasi, dan dash</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nama Instansi (alt)</label>
                                                    <input type="text" id="nama_instansi_alt" name="nama_instansi_alt" placeholder="Nama Instansi (alt)" class="form-control"  />
                                                    <small class="text-danger">Hanya alfanumerik, spasi, dan dash</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Induk Instansi *</label>
                                                    <input type="text" id="induk_instansi" name="induk_instansi" placeholder="Induk Instansi" class="form-control" required="required"/>
                                                    <small class="text-danger">Hanya alfanumerik dan spasi</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Kota Instansi *</label>
                                                    <input type="text" id="kota_instansi" name="kota_instansi" placeholder="Kota Instansi" class="form-control" required="required"/>
                                                    <small class="text-danger">Hanya huruf dan spasi</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Kota Administrasi/DATI II *</label>
                                                    <input type="text" id="kota_administrasi" name="kota_administrasi" placeholder="Kota Adminstrasi / DATI II" class="form-control" required="required"/>
                                                    <small class="text-danger">Hanya alfanumerik dan spasi</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Alamat Instansi *</label>
                                                    <textarea name="alamat_instansi" id="alamat_instansi" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Kode Pos Instansi *</label>
                                                    <input type="number" id="kode_pos_instansi" name="kode_pos_instansi" placeholder="Kode Pos" class="form-control" required="required"/>
                                                    <small class="text-danger">Hanya angka 5 karakter</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Telepon Instansi *</label>
                                                    <input type="text" id="telp_instansi" name="telp_instansi" placeholder="No. Telepon" class="form-control" required="required"/>
                                                    <small class="text-danger">Format +62xxx / (021) xxx / 021-xxx-xxx </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email Instansi *</label>
                                                    <input type="email" id="email_instansi" name="email_instansi" placeholder="Email" class="form-control" required="required"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Logo Kop Instansi *</label>
                                                    <input type="file" class="form-control" name="logo_kop_instansi" id=logo_kop_instansi accept="image/*" required="required">
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
                        setTimeout(function () { window.location.href = "<?= base_url('/');?>";}, 3000);
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
</body>

</html>