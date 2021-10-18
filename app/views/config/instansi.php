<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SASUKE - Instansi</title>

    <base href="<?= base_url()?>">

    <link rel="icon" href="<?= site_url('_/img/logo-default.png');?>">

    <!-- Custom fonts for this template-->
    <link href="<?= site_url('_/vendors/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css');?>">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= site_url('_/css/sb-admin-2.min.css');?>" rel="stylesheet">
    <link href="<?= site_url('_/css/custom.css');?>" rel="stylesheet">

    <link href="<?= site_url('_/vendors/sweetalert2/dist/sweetalert2.min.css');?>" rel="stylesheet">
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
                                    <img class="logo-sasuke" src="<?= site_url('_/img/logo-default.png');?>">
                                    <div class="text-center mb-4">
                                        <h1 class="h4 text-gray-900">SASUKE <?= SASUKE_VERSION ?></h1>
                                        <small>Konfigurasi Instansi</small>
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
    <script src="<?= site_url('_/js/jquery/jquery.min.js');?>"></script>
    <script src="<?= site_url('_/vendors/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="<?= site_url('_/vendors/jquery-easing/jquery.easing.min.js');?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= site_url('_/js/sb-admin-2.min.js');?>"></script>

    <script src="<?= site_url('_/vendors/sweetalert2/dist/sweetalert2.js'); ?>"></script>

    <script src="<?= site_url('_/js/instansi.config.js');?>"></script>
</body>

</html>