<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

		<!-- js -->
		<?= js('jquery/jquery.min') ?>

		<?php $this->_CI->load_js_plugin() ?>
		
		<?= plugin('sweetalert2/dist/sweetalert2.min', 'js'); ?>
		
		<?= js('sb-admin-2.min') ?>
		
		<?php $this->_CI->load_js() ?>

		<?= js('akun') ?>

		<?= js('show_pwd') ?>

		<?= $custom_js; ?>

	</body>
</html>