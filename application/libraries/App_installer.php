<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_installer
{
	public $db_host = 'localhost';

	public $db_user = '';

	public $db_password = '';

	public $db_name = '';

	public $message = '';
	
	public $db_env = 'development';

	public $db_collat = 'utf8_general_ci';

	protected $_conn;

	protected $_CI;

	/**
	 * Constructor
	 *
	 * @param	array	$config
	 * @return	void
	 */
	public function __construct($config = array())
	{
		empty($config) OR $this->initialize($config, FALSE);
		$this->_CI =& get_instance();

		log_message('info', 'Access Control Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize preferences
	 *
	 * @param	array	$config
	 * @param	bool	$reset
	 * @return	Secure_upload
	 */
	public function initialize(array $config = array(), $reset = TRUE)
	{
		$reflection = new ReflectionClass($this);

		if ($reset === TRUE)
		{
			$defaults = $reflection->getDefaultProperties();
			foreach (array_keys($defaults) as $key)
			{
				if ($key[0] === '_')
				{
					continue;
				}

				if (isset($config[$key]))
				{
					if ($reflection->hasMethod('set_'.$key))
					{
						$this->{'set_'.$key}($config[$key]);
					}
					else
					{
						$this->$key = $config[$key];
					}
				}
				else
				{
					$this->$key = $defaults[$key];
				}
			}
		}
		else
		{
			foreach ($config as $key => &$value)
			{
				if ($key[0] !== '_' && $reflection->hasProperty($key))
				{
					if ($reflection->hasMethod('set_'.$key))
					{
						$this->{'set_'.$key}($value);
					}
					else
					{
						$this->$key = $value;
					}
				}
			}
		}

		return $this;
	}

	// --------------------------------------------------------------------

	private function _hostValidation()
	{
		return (bool) preg_match("/^[a-z0-9\-.]*$/", $this->db_host);
	}

	private function _userValidation()
	{
		return (bool) preg_match("/^[a-z0-9_]*$/", $this->db_admin);
	}

	private function _dbNameValidation()
	{
		return (bool) preg_match("/^[a-z0-9_]*$/", $this->db_name);
	}

	public function doValidate()
	{
		if(!$this->_hostValidation()){
			$this->msg = ERR_HOST;
			return FALSE;
		}

		if(!$this->_userValidation()){
			$this->msg = ERR_USER;
			return FALSE;
		}

		if(!$this->_dbNameValidation()){
			$this->msg = ERR_DB_NAME;
			return FALSE;
		}
	}

	private function _connectDB()
	{
		$this->_conn = new mysqli($this->db_host, $this->db_user, $this->db_password);
		if($this->_conn->connect_error){
			$this->message = ERR_DB_CONN;
		}
		else
		{
			return true;
		}
	}

	private function _useDB()
	{
		if($this->_check_db() == true){
			return $this->_conn->select_db($this->db_name) ? true : false;
		}
	}

	private function _createTables()
	{
		$path = FCPATH . 'database' . DIRECTORY_SEPARATOR . 'database.sql';
		$query = '';
		$sqlScript = file($path);
		foreach ($sqlScript as $line)	{
			
			$startWith = substr(trim($line), 0 ,2);
			$endWith = substr(trim($line), -1 ,1);
			
			if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
				continue;
			}
				
			$query = $query . $line;
			if ($endWith == ';') {
				$this->_conn->query($query);
				if($this->_conn->error){
					return false;
				}
				$query= '';		
			}
		}
	}

	private function _createCfgFile()
	{
		$database_cfg = APPPATH . 'config' . DIRECTORY_SEPARATOR . 'database.php', "w");

$txt = '<?php
defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');

$active_group = \'default\';
$query_builder = TRUE;

$db[\'default\'] = array(
	\'dsn\'	=> \'\',
	\'hostname\' => '.'"'.$this->db_host.'"'.',
	\'username\' => '.'"'.$this->db_user.'"'.',
	\'password\' => '.'"'.$this->db_password.'"'.',
	\'database\' => '.'"'.$this->db_name.'"'.',
	\'dbdriver\' => \'mysqli\',
	\'dbprefix\' => \'\',
	\'pconnect\' => FALSE,
	\'db_debug\' => (ENVIRONMENT == '.'"'.$this->db_env.'"'.'),
	\'cache_on\' => FALSE,
	\'cachedir\' => \'\',
	\'char_set\' => \'utf8\',
	\'dbcollat\' => '.'"'.$this->db_collat.'"'.',
	\'swap_pre\' => \'\',
	\'encrypt\' => FALSE,
	\'compress\' => FALSE,
	\'stricton\' => FALSE,
	\'failover\' => array(),
	\'save_queries\' => TRUE
);';
		fwrite($database_cfg, $txt);
		fclose($database_cfg);
	}

	public function checkDB()
	{
		$this->config->load('database', TRUE);
		return $this->config->item('database');
	}

	public function doInstall()
	{
		if($this->_connectDB() == true)
		{
			if($this->_useDB() == true)
			{
				if(!$this->_createTables())
				{
					$this->message = ERR_TABLE;
				}
				else
				{
					$this->_createCfgFile();
					$this->message = INSTALL_SUCCESS;
				}
			}
			else
			{
				$this->message = ERR_DB_NOT_FOUND;
			}
		}
	}

	public function showMessage()
	{
		echo $this->message;
	}
}