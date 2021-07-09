<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

		<!-- js -->
		<?= js('jquery/jquery.min') ?>

		<?php $this->_CI->load_js_plugin() ?>
		
		<script src="https://unpkg.com/sweetalert2@7.24.1/dist/sweetalert2.js"></script>
		
		<?= js('sb-admin-2.min') ?>
		
		<?php $this->_CI->load_js() ?>

		<?= js('akun') ?>

		<?= js('show_pwd') ?>

		<?= $custom_js; ?>

	</body>
</html>