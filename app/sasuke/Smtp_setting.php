<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smtp_setting extends SASUKE_Core {

	public function __construct()
	{
		parent::__construct();
		$this->access_control->check_login();
		$this->access_control->check_role();

		$this->_partial = array(
			'head',
			'sidebar',
			'topbar',
			'body',
			'footer',
			'modal',
			'script'
		);

		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'select2/css/select2.min'
		);

		$this->js_plugin  = array(
			'bootstrap/js/bootstrap.bundle.min',
			'select2/js/select2.min'
		);
	}

	public function index()
	{
		include APPPATH . 'config/email.php';

		$this->_module 	= 'settings/smtp_setting';
		
		$this->js 		= 'smtp_setting';
		
		$this->_data 	= array(
			'title' 	=> $this->app->judul_app_alt . ' - Pengaturan SMTP',
			'config'	=> $config
		);

		$this->load_view();
	}

	private function _rulesSMTP()
	{
		$rules = array(
			array(
				'field' => 'protokol',
				'label' => 'Protokol',
				'rules' => 'required|regex_match[/(smtp|sendmail|mail)$/]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'regex_match'=> '{field} harus merupakan smtp/sendmail/mail.'
				)
			),
			array(
				'field' => 'smtp_host',
				'label' => 'SMTP Host',
				'rules' => 'required|valid_url',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'valid_url'=> '{field} harus merupakan URL yang valid.'
				)
			),
			array(
				'field' => 'smtp_crypto',
				'label' => 'Mode Enkripsi',
				'rules' => 'required|regex_match[/(tls|ssl)$/]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'regex_match'=> '{field} hanya mendukung SSL/TLS.'
				)
			),
			array(
				'field' => 'smtp_port',
				'label' => 'SMTP Port',
				'rules' => 'required|integer',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'integer'=> '{field} harus merupakan angka.'
				)
			),
			array(
				'field' => 'smtp_user',
				'label' => 'SMTP User',
				'rules' => 'trim|required|valid_email',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'valid_email'=> '{field} harus merupakan email yang valid.'
				)
			),
			array(
				'field' => 'smtp_password',
				'label' => 'SMTP Password',
				'rules' => 'trim|required',
				'errors'=> array(
					'required' => '{field} harus diisi.',
				)
			),
		);

		return $rules;
	}

	public function submit()
	{
		$status = 0;
		$post 	= $this->input->post(null, TRUE);

		$this->form_validation->set_rules($this->_rulesSMTP());

		if ($this->form_validation->run() == TRUE) 
		{
			$protocol 	= $post['protokol'];
			$host 	 	= $post['smtp_host'];
			$port 		= $post['smtp_port'];
			$user 		= $post['smtp_user'];
			$password 	= $post['smtp_password'];
			$encryption = $post['smtp_crypto'];

			$email_cfg = fopen(APPPATH . 'config/email.php', "w");

$config = '<?php
defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');

$config = array(
	\'protocol\' => '.'"'.$protocol.'"'.',
    \'smtp_host\' => '.'"'.$host.'"'.', 
    \'smtp_port\' => '.$port.',
    \'smtp_user\' => '.'"'.$user.'"'.',
    \'smtp_pass\' => '.'"'.$password.'"'.',
    \'smtp_crypto\' => '.'"'.$encryption.'"'.',
    \'mailtype\' => \'text/plan\',
    \'smtp_timeout\' => \'4\',
    \'charset\' => \'utf-8\',
    \'wordwrap\' => TRUE,
    \'crlf\'    => "\r\n",
    \'newline\' => "\r\n"
);';

			$status = (fwrite($email_cfg, $config) !== false) ? 1 : 0;
			$msg = ($status === 1) ? 'Pengaturan SMTP Berhasil.' : 'Pengaturan SMTP Gagal.';

			fclose($email_cfg);

		} 
		else 
		{
			$msg = validation_errors();
		}
		
		$token = $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
}