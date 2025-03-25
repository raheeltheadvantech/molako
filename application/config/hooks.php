<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['pre_system'] = array(
								'class'    => 'Exceptions_hook',
								'function' => 'error_catcher',
								'filename' => 'Exceptions_hook.php',
								'filepath' => 'hooks'
							);
							
/*$hook['post_controller_constructor'] = array(
                                'class'    => 'MY_Lang',
                                'function' => 'load_db_lang',
                                'filename' => 'MY_Lang.php',
                                'filepath' => 'core',
                                'params'   => array()
                                );*/


/*if(isset($this->CI->admin_session))
{
$hook['post_controller'] = array(
                                'class'    => 'Admin_url',
                                'function' => 'set_admin_url',
                                'filename' => 'Admin_url.php',
                                'filepath' => 'libraries',
                                'params'   => array()
                                );
}*/

/*
$hook['post_controller'] = array(
                                'class'    => 'Admin_database_triggers',
                                'function' => 'set_admin_url',
                                'filename' => 'Admin_url.php',
                                'filepath' => 'libraries',
                                'params'   => array()
                                );

*/