<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';

$route['tambah-user'] 					= 'manajemen_user/tambah';
$route['get-user'] 						= 'manajemen_user/get_user';
$route['edit-user'] 					= 'manajemen_user/edit';
$route['hapus-user'] 					= 'manajemen_user/hapus';

$route['get-role'] 						= 'manajemen_akses/get_role';
$route['tambah-role'] 					= 'manajemen_akses/tambah';
$route['edit-role'] 					= 'manajemen_akses/edit';
$route['hapus-role/(:any)'] 			= 'manajemen_akses/hapus/$1';
$route['update-index']					= 'manajemen_akses/update_index';

$route['submit-instansi']				= 'pengaturan_instansi/submit';

$route['ganti-password'] 				= 'akun/ganti_password';
$route['get-akun'] 						= 'akun/get_akun';

$route['daftar-jabatan'] 				= 'jabatan/index';
$route['get-jabatan'] 					= 'jabatan/get_jabatan';
$route['tambah-jabatan'] 				= 'jabatan/tambah';
$route['edit-jabatan'] 					= 'jabatan/edit';
$route['hapus-jabatan/(:any)'] 			= 'jabatan/hapus/$1';

$route['daftar-pejabat'] 				= 'pejabat/index';
$route['get-pejabat'] 					= 'pejabat/get_pejabat';
$route['tambah-pejabat'] 				= 'pejabat/tambah';
$route['edit-pejabat'] 					= 'pejabat/edit';
$route['hapus-pejabat/(:any)'] 			= 'pejabat/hapus/$1';

$route['surat-kematian'] 				= 'skmk/index';
$route['buat-skmk'] 					= 'skmk/buat';
$route['submit-skmk']					= 'skmk/submit_skmk';
$route['edit-skmk/(:any)'] 				= 'skmk/edit/$1';
$route['do-edit-skmk']					= 'skmk/do_edit';
$route['hapus-skmk']		 			= 'skmk/hapus';
$route['detail-skmk/(:any)'] 			= 'skmk/detail/$1';

$route['reset/(:any)'] 					= 'lupa_password/reset/$1';
$route['do-reset'] 						= 'lupa_password/submit';
$route['submit-pwd'] 					= 'lupa_password/submit_pwd';

$route['konfigurasi'] 					= 'konfigurasi/konfigurasi/index';
$route['konfigurasi/instansi'] 			= 'konfigurasi/konfigurasi/instansi';
$route['konfigurasi/submit'] 			= 'konfigurasi/konfigurasi/submit';
$route['konfigurasi/submit-instansi'] 	= 'konfigurasi/konfigurasi/submit-instansi';
$route['konfigurasi/smtp'] 				= 'konfigurasi/konfigurasi/smtp';
$route['konfigurasi/submit-smtp'] 		= 'konfigurasi/konfigurasi/submit_smtp';

$route['aktivasi/(:any)'] 				= 'aktivasi/index/$1';
$route['submit-password'] 				= 'aktivasi/submit';

$route['submit-setting'] 				= 'app_setting/submit';

$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
