<?php

defined('BASEPATH') OR exit('No direct script access allowed');



$active_group = 'default';

$query_builder = TRUE;


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

