<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>The corresponding controller for this page is found at:</p>
		<code><?php $hash = encrypt('irfanabdulaziz'); echo strlen($hash).'<br/>'; echo $hash;?></code>
		<code><?php var_dump(verify($hash));?></code>

		<p>The corresponding controller for this page is found at:</p>
		<code><?php 
		$plain = hash('gost', random_string('alnum', 8));
		echo $plain.'<br/>';
		$key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES); echo base64url_encode($key).'<br/>';
		$cipher = hash_generator($plain,$key); echo base64url_encode($cipher);?></code>
		<code><?= hash_unbox($cipher, $key);?></code>
		<code>
		<?php
		$CI =& get_instance();
		$CI->load->library('encryption');
		$key = $CI->encryption->create_key(16);
		$key_digest = $CI->encryption->hkdf($key, $digest = 'sha512', $salt = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES), $length = 16, $info = '');
		$CI->encryption->initialize(
			array(
                'cipher' => 'blowfish',
                'mode' => 'cbc',
                'key' => $key
        	)
		);

		$plain_text = 'ridwannaim';
		$ciphertext = $CI->encryption->encrypt($plain_text);
		echo $ciphertext.'<br/>';
		echo $key.'<br/>';
		// echo $key_digest.'<br/>';
		echo $CI->encryption->decrypt($ciphertext);
		?>
	</code>
	<?= password_hash('Load1n9321!@#', PASSWORD_ARGON2ID);?>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>