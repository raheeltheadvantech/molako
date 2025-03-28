<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(dirname(__FILE__) . '/MY_Form_validation.php');

final class Form_validation_user extends MY_Form_validation
{
    public function __construct($rules = array())
    {
		parent::__construct($rules);
    }
}