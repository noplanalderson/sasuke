<?php
function alert($type, $msg)
{
	switch ($type) {
		case 'success':
			$color = 'success';
			break;
		
		default:
			$color = 'danger';
			break;
	}

	if(!empty($msg))
	{
		return '<div class="alert alert-'.$color.' fadeIn" role="alert">
	          '.$msg.'
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	            <span aria-hidden="true">×</span>
	          </button>
	        </div>';
	}
}

function flash_alert()
{
	$CI =& get_instance();
	
	if($CI->session->userdata('error'))
	{
		return '<div class="alert alert-danger fadeIn" role="alert">
	          '.session()->getFlashdata('error').'
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	            <span aria-hidden="true">×</span>
	          </button>
	        </div>';
	}
	elseif($CI->session->userdata('success'))
	{
		return '<div class="alert alert-success fadeIn" role="alert">
	          '.session()->getFlashdata('success').'
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	            <span aria-hidden="true">×</span>
	          </button>
	        </div>';
	}
}

function encodeImage($path)
{
	$type = pathinfo($path, PATHINFO_EXTENSION);
	$data = @file_get_contents($path);
	$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

	return $base64;
}

# Konversi dari Penanggalan SQL ke Penanggalan Indonesia
function format_tanggal($tanggal, $cetak_hari = FALSE, $time = FALSE, $timezone = 'WIB')
{
	$hari = array ( 1 =>    'Senin',
			'Selasa',
			'Rabu',
			'Kamis',
			'Jumat',
			'Sabtu',
			'Minggu'
		);

	$bulan = array (1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);

	if(preg_match('/^\d+$/', $tanggal)) 
	{
		if($time === true)
		{
			$tanggal = date('Y-m-d H:i:s', $tanggal);

			$split = explode('-', $tanggal);
			$time = explode(' ', $split[2]);
			$tgl_indo = $time[0] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0] . ' - ' . $time[1] . ' ' . $timezone;
		}
		else
		{
			$tanggal = date('Y-m-d', $tanggal);

			$split = explode('-', $tanggal);
			$tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
		}

		if ($cetak_hari) {
			$num = date('N', strtotime($tanggal));
			return $hari[$num] . ', ' . $tgl_indo;
		}

		return $tgl_indo;
	}
	elseif(empty($tanggal))
	{
		return '-';
	}
	else
	{
		if($time ===  true)
		{
			$split = explode('-', $tanggal);
			$time = explode(' ', $split[2]);
			$tgl_indo = $time[0] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0] . ' - ' . $time[1] . ' ' . $timezone;
		}
		else
		{
			$split = explode('-', $tanggal);
			$time = explode(' ', $split[2]);
			$tgl_indo = $time[0] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
		}

		if ($cetak_hari) {
			$num = date('N', strtotime($tanggal));
			return $hari[$num] . ', ' . $tgl_indo;
		}

		return $tgl_indo;
	}
}

function format_bulan($tanggal, $type = 'STANDAR')
{
	switch ($type) {
		case 'ROMAWI':
			$bulan = array (
				1 => 'I',
				2 => 'II',
				3 => 'III',
				4 => 'IV',
				5 => 'V',
				6 => 'VI',
				7 => 'VII',
				8 => 'VIII',
				9 => 'IX',
				10=> 'X',
				11=> 'XI',
				12=> 'XII'
			);
			
			$split = explode('-', $tanggal);
			return $bulan[ (int)$split[1] ];
			
			break;
		
		default:
			$bulan = array (
				1 => 'Januari',
				2 => 'Februari',
				3 => 'Maret',
				4 => 'April',
				5 => 'Mei',
				6 => 'Juni',
				7 => 'Juli',
				8 => 'Agustus',
				9 => 'September',
				10=> 'Oktober',
				11=> 'November',
				12=> 'Desember'
			);
			
			$split = explode('-', $tanggal);
			return $bulan[ (int)$split[1] ].' '.$split[0];

			break;
	}
}

function encrypt($string)
{
	/**
	 * 
	 * Ini adalah Method untuk mengenkripsi string data atau pun file dan direktori
	 * 
	 * @param $string akan dienkripsi terlebih dahulu dengan md5(sha256())
	 *
	 * Lalu dipecah menjadi beberapa blok dan diacak
	 *
	 * @return $blok[i]
	 * 
	*/
	$hash  = md5($string);
	$blok1 = substr($hash, 0,8);
	$blok2 = substr($hash, 8,8);
	$blok3 = substr($hash, 16,4);
	$blok4 = substr($hash, 20,4);
	$blok5 = substr($hash, 24,8);

	return $blok2.'-'.$blok4.'-'.$blok5.'-'.$blok3.'-'.$blok1;
}

function verify($string)
{
	/**
	 *
	 * @param $string adalah parameter yang akan dikembalikan nilainya
	 * ke enkripsi md5(sha256())
	 *
	 * Sebelum dikembalikan, validasi terlebih dahulu 
	 * string dan panjang karakter dari $string
	 *
	 * Karakter yang diizinkan hanya huruf,angka (0-9), dan dash (-)
	 * dengan panjang karakter 36
	 * 
	 * Jika validasi cocok, maka akan mengembalikan nilai $hash
	 * Jika tidak, maka kembalikan nilai false
	 *
	*/
	$string = preg_replace("/[^a-z0-9\-]/", "", $string);
	if(strlen($string) == 36)
	{
		$hash = explode("-", $string);
		$hash = $hash[4].$hash[0].$hash[3].$hash[1].$hash[2];
		return $hash;
	}
	else
	{
		return false;
	}
}

function hash_generator($str, $key)
{
	$nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
	$ciphertext = sodium_crypto_secretbox($str, $nonce, $key);

	return $nonce . $ciphertext;
}

function hash_unbox($cipher, $key)
{
	$nonce = mb_substr($cipher, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
	$ciphertext = mb_substr($cipher, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');
	return sodium_crypto_secretbox_open($ciphertext, $nonce, $key);
}

function random_char($length = 16)
{
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!@#$%^&*()-_+?{}[]<|>?,.';
    return substr(str_shuffle(str_repeat($chars, ceil($length/strlen($chars)) )), 0, $length);
}

function get_real_ip()
{
   if(!empty($_SERVER['HTTP_CLIENT_IP']))
   {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
   }
   elseif ( ! empty($_SERVER['HTTP_X_FORWARDED_FOR']))
   {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
   }
   else
   {
      $ip = $_SERVER['REMOTE_ADDR'];
   }
   
   return $ip;
}

function button($button = [], $label = TRUE, $mode = 'a', $attr = NULL)
{
	if(!empty($button))
	{
		if($label)
		{
			return '<'.$mode.' '.$attr.'><i class="'.$button->icon_menu.'"></i> '.$button->label_menu.'</'.$mode.'>';
		}
		else
		{
			return '<'.$mode.' '.$attr.'><i class="'.$button->icon_menu.'"></i></'.$mode.'>';
		}
	}
}

function passwordHash($plaintext)
{
	if (version_compare(PHP_VERSION, '7.3', '>='))
	{
		return password_hash($plaintext, PASSWORD_ARGON2ID);
	}
	else
	{
		return password_hash($plaintext, PASSWORD_DEFAULT);
	}
}

/**
 * Encode data to Base64URL
 * @param string $data
 * @return boolean|string
 */
function base64url_encode($data)
{
  // First of all you should encode $data to Base64 string
  $b64 = base64_encode($data);

  // Make sure you get a valid result, otherwise, return FALSE, as the base64_encode() function do
  if ($b64 === false) {
    return false;
  }

  // Convert Base64 to Base64URL by replacing “+” with “-” and “/” with “_”
  $url = strtr($b64, '+/', '-_');

  // Remove padding character from the end of line and return the Base64URL result
  return rtrim($url, '=');
}

/**
 * Decode data from Base64URL
 * @param string $data
 * @param boolean $strict
 * @return boolean|string
 */
function base64url_decode($data, $strict = false)
{
  // Convert Base64URL to Base64 by replacing “-” with “+” and “_” with “/”
  $b64 = strtr($data, '-_', '+/');

  // Decode Base64 string and return the original data
  return base64_decode($b64, $strict);
}