<?php

$active_group = 'default';
$query_builder = TRUE;
$host = $_SERVER['HTTP_HOST'];
$ip_address = $_SERVER['REMOTE_ADDR'];
$rootDirectory = FCPATH;
$lastFolder = basename($rootDirectory);
// Condition check karen
if (strpos($ip_address, '192.168') === 0) {
    $db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',

	'password' => '',

	'database' => 'molako3',
	'dbdriver' => 'mysqli',
	'dbprefix' => 'ci_',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
} elseif($ip_address == "::1"  || $ip_address == "127.0.0.1" ) {
    $db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',

	'password' => '',

	'database' => 'molako3',
	'dbdriver' => 'mysqli',
	'dbprefix' => 'ci_',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
} elseif(function_exists('stripos') &&stripos($host, 'regencyfarm') !== false) {
$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'techcity_ci_db_usr',
	'password' => 'UI?-5-FQbOlr!,!q2[m{D1r',
	'database' => 'techcity_ci_db',
	'dbdriver' => 'mysqli',
	'dbprefix' => 'ci_',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
} elseif(function_exists('str_contains') && str_contains($host, 'regencyfarm')) {
$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'techcity_ci_db_usr',
	'password' => 'UI?-5-FQbOlr!,!q2[m{D1r',
	'database' => 'techcity_ci_db',
	'dbdriver' => 'mysqli',
	'dbprefix' => 'ci_',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
} else{
$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'xyqdeimy_ecom_usr',
	'password' => 'T%9n1nw$UV8*JUVpwhKe5U0^X',
	'database' => 'xyqdeimy_ecom_db',
	'dbdriver' => 'mysqli',
	'dbprefix' => 'ci_',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
}




