<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_error extends Admin_Non_Permission_Controller {
	
	function __construct()
	{
		parent::__construct();
	}	
	
	function index()
	{

	    die('Access Denied');
//		$data = array();
//        $this->view($this->admin_view.'/dashboard', $data);
	}
}