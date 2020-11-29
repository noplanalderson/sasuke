<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * File ini berisi Konfigurasi EMail
 * Berfungsi untuk mengirimkan notifikasi kepada email client
 *
 * @package email.php
 * @author debu_semesta
 *
 *
*/
$config = array(
    'protocol' => 'smtp',
    'smtp_host' => 'smtp.gmail.com', 
    'smtp_port' => 465,
    'smtp_user' => 'noplanalderson@gmail.com',
    'smtp_pass' => 'Load1n9321!@#',
    'smtp_crypto' => 'ssl',
    'mailtype' => 'text/plan',
    'smtp_timeout' => '4',
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE,
    'crlf'    => "\r\n",
    'newline' => "\r\n"
);