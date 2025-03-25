<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Exceptions_hook Class
 *
 * This class contains functions that handles parse erros, fatal errors and exceptions
 *
 */
class Exceptions_hook {
	
	function __construct()
	{
		//var_dump(error_reporting());die;
		//echo $this->error_level_tostring(error_reporting(), ',');die;
	}
	
	/**
	 * Error Catcher
	 *
	 * Sets the user functions for parse errors, fatal errors and exceptions
	 *
	 * @access	public
	 * @return	void
	 */
	public function error_catcher()
	{
		//	die('HERELO');
	//	set_error_handler(array($this, 'handle_errors'));
	//	set_exception_handler(array($this, 'handle_exceptions'));
	//	register_shutdown_function(array($this, 'handle_fatal_errors'));
		
		set_error_handler(array($this, 'handle_errors'));
		set_exception_handler(array($this, 'handle_exceptions'));
		register_shutdown_function(array($this, 'handle_fatal_errors'));
	//	ob_start(array($this, 'handle_fatal_errors'));
	//	ob_start('handle_fatal_errors');
		
	}
	/**
	 * Parse Error Handler
	 *
	 * Accesses parse errors, formats the error message and redirects
	 *
	 * @access	public
	 * @param 	int
	 * @param 	string
	 * @param 	string
	 * @param 	int
	 * @return 	void
	 */
	public function handle_errors_old($errno, $errstr, $errfile, $errline)
	{
		if (!(error_reporting() & $errno))
		{
			return;
		}
		
		$message = "\nError Type: [".$errno."] ".$this->_friendly_error_type($errno)."\n";
		$message .= "Error Message: ".$errstr."\n";
		$message .= "In File: ".$errfile."\n";
		$message .= "At Line: ".$errline."\n";
		$message .= "Platform: " . PHP_VERSION . " (" . PHP_OS . ")\n";
		$message .= "\nEND\n";
		$this->_forward_error($message);
	}
	
	private function is_local_server()
	{
		$base_url = config_item('base_url');
		if(strpos($base_url, 'alamakin.com') !== FALSE)
		{
			return false;
		}
		
		return true;
	}
	
	public function handle_errors($severity, $message, $filepath, $line)
	{
		//echo 'In handle_errors';
		//	Deprecated
		if($severity === 8192)
		{
			return;
		}
		
		$is_local_host = $this->is_local_server();
		//var_dump($is_local_host);
		//var_dump($severity, $message, $filepath, $line);
		//var_dump($severity);
		
		//ob_start();		//	POINTED
		if (!(error_reporting() & $severity) /*and $is_local_host == TRUE*/)
		{//die('RETURN 000');
			return;
		}
		//die('OK');
		$is_error = (((E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR | E_USER_ERROR) & $severity) === $severity);

		// When an error occurred, set the status header to '500 Internal Server Error'
		// to indicate to the client something went wrong.
		// This can't be done within the $_error->show_php_error method because
		// it is only called when the display_errors flag is set (which isn't usually
		// the case in a production environment) or when errors are ignored because
		// they are above the error_reporting threshold.
		if ($is_error)
		{
			set_status_header(500);
		}

		// Should we ignore the error? We'll get the current error_reporting
		// level and add its bits with the severity bits to find out.
		if (($severity & error_reporting()) !== $severity and $is_local_host == TRUE)
		{
			return;
		}
	//	die('OK');
		$_error =& load_class('Exceptions', 'core');
	//	$_error->log_exception($severity, $message, $filepath, $line);

		// Should we display the error?
		if (str_ireplace(array('off', 'none', 'no', 'false', 'null'), '', ini_get('display_errors')))
		{
			$_error->show_php_error($severity, $message, $filepath, $line);
		}

		// If the error is fatal, the execution of the script should be stopped because
		// errors can't be recovered from. Halting the script conforms with PHP's
		// default error handling. See http://www.php.net/manual/en/errorfunc.constants.php
		if ($is_error)
		{
			exit(1); // EXIT_ERROR
		}
	}

	/**
	 * Exception Handler
	 *
	 * Accesses exception class on shutdown, formats the error message and redirects
	 *
	 * @access	public
	 * @return	void
	 */
	public function handle_exceptions_old($exception)
	{
		$message = "\nError Type: ".get_class($exception)."\n";
		$message .= "Error Message: ".$exception->getMessage()."\n";
		$message .= "In File: ".$exception->getFile()."\n";
		$message .= "At Line: ".$exception->getLine()."\n";
		$message .= "Platform: " . PHP_VERSION . " (" . PHP_OS . ")\n";
		$message .= "\nBACKTRACE\n";
		$message .= $exception->getTraceAsString();
		$message .= "\nEND\n";
		$this->_forward_error($message);
	}
	
	public function handle_exceptions($exception)
	{
		//echo 'In Exceptions';
		//var_dump($exception);die;
		$_error =& load_class('Exceptions', 'core');
		//$_error->log_exception('error', 'Exception: '.$exception->getMessage(), $exception->getFile(), $exception->getLine());

		is_cli() OR set_status_header(500);
		// Should we display the error?
		if (str_ireplace(array('off', 'none', 'no', 'false', 'null'), '', ini_get('display_errors')))
		{
			$_error->show_exception($exception);
		}

		exit(1); // EXIT_ERROR
	}

	/**
	 * Fatal Error Handler
	 *
	 * Accesses output buffers on shutdown, formats the error message and redirects
	 *
	 * @access	public
	 * @return	void
	 */
	public function handle_fatal_errors_old()
	{
		if (($error = error_get_last())) {
			$buffer = ob_get_contents();
			ob_clean();
		
			$message = "\nError Type: [".$error['type']."] ".$this->_friendly_error_type($error['type'])."\n";
			$message .= "Error Message: ".$error['message']."\n";
			$message .= "In File: ".$error['file']."\n";
			$message .= "At Line: ".$error['line']."\n";
			$message .= "Platform: " . PHP_VERSION . " (" . PHP_OS . ")\n";
			$message .= "\nBACKTRACE\n";
			$message .= $buffer;
			$message .= "\nEND\n";
			$this->_forward_error($message);
		}
	}
	
	public function handle_fatal_errors()
	{
	//	ob_end_clean();
		//echo 'In handle_fatal_errors';
		$last_error = error_get_last();
		//var_dump($last_error);
		if (isset($last_error) &&
			($last_error['type'] & (E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING)))
		{
			//var_dump($last_error['type'], $last_error['message'], $last_error['file'], $last_error['line']);
			//die('HEllo');
			//$buffer = ob_get_contents();
			//ob_clean();
			$this->handle_errors($last_error['type'], $last_error['message'], $last_error['file'], $last_error['line']);
		}
		//die('END');
	}
	
	/**
	 * Send request to MY_Exceptions.php
	 *
	 *
	 * @access	private
	 * @param	string
	 * @return	void
	 */
	private function _forward_error($message)
	{
		$CI =& get_instance();
		
		require_once(BASEPATH.'core/Exceptions'.EXT);
		$class = 'Exceptions';
		$name = 'CI_'.$class;
		$error = new $name();
		
		
		$my_exception_file = APPPATH.'core/'.config_item('subclass_prefix').$class.EXT;
		if (file_exists($my_exception_file))
		{
			if (class_exists($my_exception_file, FALSE) === FALSE)
			{
				require_once($my_exception_file);
				$name = config_item('subclass_prefix').$class;
				$error = new $name();
			}
		}
		$heading = 'error found';
		$error->show_error_db($heading, $message, 'error_general');
		
	}
	/**
	 * Error Type Helper
	 *
	 * Translates error codes to something more human
	 *
	 * @access	private
	 * @param	string
	 * @return	string
	 */
	private function _friendly_error_type($type)
	{
		switch($type)
		{
			case E_ERROR: // 1
				return 'Fatal error';
			case E_WARNING: // 2
				return 'Warning';
			case E_PARSE: // 4
				return 'Parse error';
			case E_NOTICE: // 8
				return 'Notice';
			case E_CORE_ERROR: // 16
				return 'Core fatal error';
			case E_CORE_WARNING: // 32
				return 'Core warning';
			case E_COMPILE_ERROR: // 64
				return 'Compile-time fatal error';
			case E_COMPILE_WARNING: // 128
				return 'Compile-time warning';
			case E_USER_ERROR: // 256
				return 'Fatal user-generated error';
			case E_USER_WARNING: // 512
				return 'User-generated warning';
			case E_USER_NOTICE: // 1024
				return 'User-generated notice';
			case E_STRICT: // 2048
				return 'E_STRICT';
			case E_RECOVERABLE_ERROR: // 4096
				return 'Catchable fatal error';
			case E_DEPRECATED: // 8192
				return 'E_DEPRECATED';
			case E_USER_DEPRECATED: // 16384
				return 'E_USER_DEPRECATED';
		}
		return $type;
	}
	
	function error_level_tostring($intval, $separator = ',')
	{
		$errorlevels = array(
			E_ALL => 'E_ALL',
			E_USER_DEPRECATED => 'E_USER_DEPRECATED',
			E_DEPRECATED => 'E_DEPRECATED',
			E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
			E_STRICT => 'E_STRICT',
			E_USER_NOTICE => 'E_USER_NOTICE',
			E_USER_WARNING => 'E_USER_WARNING',
			E_USER_ERROR => 'E_USER_ERROR',
			E_COMPILE_WARNING => 'E_COMPILE_WARNING',
			E_COMPILE_ERROR => 'E_COMPILE_ERROR',
			E_CORE_WARNING => 'E_CORE_WARNING',
			E_CORE_ERROR => 'E_CORE_ERROR',
			E_NOTICE => 'E_NOTICE',
			E_PARSE => 'E_PARSE',
			E_WARNING => 'E_WARNING',
			E_ERROR => 'E_ERROR');
		
		$result = '';
		foreach($errorlevels as $number => $name)
		{
			if (($intval & $number) == $number)
			{
				$result .= ($result != '' ? $separator : '').$name;
			}
		}
		
		return $result;
	}	
}
/* End of file Exceptions_hook.php */
/* Location: ./application/hooks/Exceptions_hook.php */