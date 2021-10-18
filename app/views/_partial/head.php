<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Sistem Aplikasi Surat Kematian">
    <meta name="author" content="debu_semesta">
    <meta name="X-CSRF-TOKEN" content="<?= $this->security->get_csrf_hash();?>">

    <base href="<?= rtrim(base_url(), '/') ?>">
    
    <title><?= $title ?></title>

    <!-- App favicon -->
    <?= show_image('sites/'.$this->app->icon_app, 'icon', 'rel="icon" type="image/png" sizes="16x16"') ?>

    <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

    <!-- Core -->
    <?= css('sb-admin-2.min') ?>

    <?= css('custom') ?>
        
    <?php $this->_CI->load_css() ?>
    
    <?php $this->_CI->load_css_plugin() ?>
    
    <?= plugin('sweetalert2/dist/sweetalert2.min'); ?>
</head>