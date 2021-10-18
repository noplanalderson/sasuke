<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SASUKE - Konfigurasi SMTP</title>

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
                                        <small>Konfigurasi SMTP</small>
                                    </div>
                                    
								    <?= form_open_multipart('konfigurasi/submit-smtp', 'method="post" id="form_smtp" accept-charset="utf-8"');?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Protokol *</label>
                                                    <select name="protokol" id="protokol" class="form-control" required="required">
                                                        <option value="smtp">smtp</option>
                                                        <option value="sendmail">sendmail</option>
                                                        <option value="mail">mail</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Enkripsi *</label>
                                                    <select name="smtp_crypto" id="smtp_crypto" class="form-control" required="required">
                                                        <option value="ssl">SSL</option>
                                                        <option value="tls">TLS</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>SMTP Host *</label>
                                                    <input type="text" id="smtp_host" name="smtp_host" placeholder="smtp.domain.com" class="form-control" required="required" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>SMTP Port *</label>
                                                    <input type="number" id="smtp_port" name="smtp_port" placeholder="Example : 587" class="form-control"  required="required" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>SMTP User *</label>
                                                    <input type="email" id="smtp_user" name="smtp_user" placeholder="admin@domain.com" class="form-control" required="required"/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>SMTP Password *</label>
                                                    <input type="password" id="smtp_password" name="smtp_password" placeholder="********" class="form-control" required="required"/>
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

    <script src="<?= site_url('_/js/smtp.config.js');?>"></script>
</body>

</html>