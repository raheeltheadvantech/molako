<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(dirname(__FILE__) . '/MY_Form_validation.php');

final class Form_validation_admin extends MY_Form_validation
{	
    public function __construct($rules = array())
    {
		parent::__construct($rules);
    }
	
    public function error_1($field, $custom_error = '', $prefix = '', $suffix = '')
	{
		if (empty($this->_field_data[$field]['error']))
		{
			return '';
		}

		if ($prefix === '')
		{
			//$prefix = $this->_error_prefix;
		}

		if ($suffix === '')
		{
			//$suffix = $this->_error_suffix;
		}
		
		if( $custom_error != '' )
		{
			return $prefix.$custom_error.$suffix;
		}
		
		return $prefix.$this->_field_data[$field]['error'].$suffix;
	}



	// --------------------------------------------------------------------

	/**
	 * Set Radio
	 *
	 * Enables radio buttons to be set to the value the user
	 * selected in the event of an error
	 *
	 * @param	string
	 * @param	string
	 * @param	bool
	 * @return	string
	 */
	public function set_radio_1($field = '', $value = '', $default = FALSE)
	{
		if ( ! isset($this->_field_data[$field], $this->_field_data[$field]['postdata']))
		{
			return ($default === TRUE && count($this->_field_data) === 0) ? ' checked="checked"' : '';
		}

		$field = $this->_field_data[$field]['postdata'];
		$value = (string) $value;
		if (is_array($field))
		{
			// Note: in_array('', array(0)) returns TRUE, do not use it
			foreach ($field as &$v)
			{
				if ($value === $v)
				{
					return ' checked="checked"';
				}
			}

			return '';
		}
		elseif (($field === '' OR $value === '') OR ($field !== $value))
		{
			return '';
		}

		return ' checked="checked"';
	}

	// --------------------------------------------------------------------

	/**
	 * Set Checkbox
	 *
	 * Enables checkboxes to be set to the value the user
	 * selected in the event of an error
	 *
	 * @param	string
	 * @param	string
	 * @param	bool
	 * @return	string
	 */
	public function set_checkbox_1($field = '', $value = '', $default = FALSE)
	{
		// Logic is exactly the same as for radio fields
		return $this->set_radio_1($field, $value, $default);
	}
}