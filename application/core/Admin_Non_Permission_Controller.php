<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Non_Permission_Controller extends Admin_Public_Controller {

    function __construct()
    {
        parent::__construct();
		
		$this->load->library('Auth_admin');
		$this->auth_admin->is_logged_in(uri_string());
        $this->set_template('default');
    }
}
