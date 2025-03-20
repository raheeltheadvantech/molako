<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('_get_validation_object'))
{
	function &_get_validation_object()
	{
		$CI =& get_instance();

		// We set this as a variable since we're returning by reference.
		$return = FALSE;

		if (FALSE !== ($object = $CI->load->is_loaded($CI->form_validation_class_name)))
		{
			if ( ! isset($CI->$object) OR ! is_object($CI->$object))
			{
				return $return;
			}

			return $CI->$object;
		}
		
		return $return;
	}
}


// ------------------------------------------------------------------------
/**
 * Set Checkbox
 *
 * Let's you set the selected value of a checkbox via the value in the POST array.
 * If Form Validation is active it retrieves the info from the validation class
 *
 * @access	public
 * @param	string
 * @param	string
 * @param	bool
 * @return	string
 */
if ( ! function_exists('set_checkbox_2'))
{
	function set_checkbox_2($field = '', $value = '', $default = FALSE)
	{
		$OBJ =& _get_validation_object();
		if ($OBJ === TRUE)
		{
			return $OBJ->set_checkbox($field, $value, $default);
		}
		else
		{
			if ( ! isset($_POST[$field]))
			{
				if (count($_POST) === 0 AND $default == TRUE)
				{
					return ' checked="checked"';
				}
				return '';
			}
			$field = $_POST[$field];
			if (is_array($field))
			{
				if ( ! in_array($value, $field))
				{
					return '';
				}
			}
			else
			{
				if (($field == '' OR $value == '') OR ($field != $value))
				{
					return '';
				}
			}
			
			return ' checked="checked"';
		}
		
		
	}
}
	// --------------------------------------------------------------------
	/**
	 * Set Select
	 *
	 * Enables pull-down lists to be set to the value the user
	 * selected in the event of an error
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	string
	 */
if ( ! function_exists('set_select_1'))
{
	 
	function set_select_1($field = '', $value = '', $default = FALSE)
	{
		$OBJ =& _get_validation_object();
		
		if ($OBJ === TRUE)
		{
			return $OBJ->set_select($field, $value, $default);
		}
		else
		{
			if ( ! isset($_POST[$field]))
			{
				if (count($_POST) === 0 AND $default == TRUE)
				{
					return ' selected="selected"';
				}
				return '';
			}
			$field = $_POST[$field];
			if (is_array($field))
			{
				if ( ! in_array($value, $field))
				{
					return '';
				}
			}
			else
			{
				if (($field == '' OR $value == '') OR ($field != $value))
				{
					return '';
				}
			}
			
			return ' selected="selected"';
		}	
	
	}
}

// --------------------------------------------------------------------
/**
 * Drop-down Menu
 *
 * @access	public
 * @param	string
 * @param	array
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_dropdown_data_attr'))
{
	function form_dropdown_data_attr($name = '', $options = array(), $selected = array(), $extra = '')
	{
		if ( ! is_array($selected))
		{
			$selected = array($selected);
		}
		// If no selected state was submitted we will attempt to set it automatically
		if (count($selected) === 0)
		{
			// If the form name appears in the $_POST array we have a winner!
			if (isset($_POST[$name]))
			{
				$selected = array($_POST[$name]);
			}
		}
		if ($extra != '') $extra = ' '.$extra;
		$multiple = (count($selected) > 1 && strpos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';
		$form = '<select name="'.$name.'"'.$extra.$multiple.">\n";
		foreach ($options as $key => $val)
		{
			$key = (string) $key;
			if (is_array($val) && ! empty($val))
			{
				$form .= '<optgroup label="'.$key.'">'."\n";
				foreach ($val as $optgroup_key => $optgroup_val)
				{
					$sel = (in_array($optgroup_key, $selected)) ? ' selected="selected"' : '';
					$form .= '<option value="'.$optgroup_key.'"'.$sel.'>'.(string) $optgroup_val."</option>\n";
				}
				$form .= '</optgroup>'."\n";
			}
			else
			{
				$sel = (in_array($key, $selected)) ? ' selected="selected"' : '';
				$form .= '<option value="'.$key.'"'.$sel.'>'.(string) $val."</option>\n";
			}
		}
		$form .= '</select>';
		return $form;
	}
}


// ------------------------------------------------------------------------

if ( ! function_exists('form_input'))
{
	/**
	 * Text Input Field
	 *
	 * @param	mixed
	 * @param	string
	 * @param	mixed
	 * @return	string
	 */
	function form_input($data = '', $value = '', $extra = '')
	{
		$defaults = array(
			'type' => 'text',
			'name' => is_array($data) ? '' : $data,
			'value' => $value,
			'class'	=> (form_error(is_array($data) ? '' : $data)?' error':'')
		);
		
		if(isset($data['class']) and isset($data['name']))
		{
			$data['class'] = $data['class'] . ''. (form_error("$data[name]") ? ' error':'');
		}
		return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";
	}
}

// --------------------------------------------------------------------

if ( ! function_exists('form_dropdown'))
{
	/**
	 * Drop-down Menu
	 *
	 * @param	mixed	$data
	 * @param	mixed	$options
	 * @param	mixed	$selected
	 * @param	mixed	$extra
	 * @return	string
	 */
	function form_dropdown($data = '', $options = array(), $selected = array(), $extra = '')
	{
		if(isset($data['class']) and isset($data['name']))
		{
			$data['class'] = $data['class'] . ''. (form_error("$data[name]") ? ' error':'');
		}

		$defaults = array();

		if (is_array($data))
		{
			if (isset($data['selected']))
			{
				$selected = $data['selected'];
				unset($data['selected']); // select tags don't have a selected attribute
			}

			if (isset($data['options']))
			{
				$options = $data['options'];
				unset($data['options']); // select tags don't use an options attribute
			}
		}
		else
		{
			$defaults = array('name' => $data);
		}

		is_array($selected) OR $selected = array($selected);
		is_array($options) OR $options = array($options);

		// If no selected state was submitted we will attempt to set it automatically
		if (empty($selected))
		{
			if (is_array($data))
			{
				if (isset($data['name'], $_POST[$data['name']]))
				{
					$selected = array($_POST[$data['name']]);
				}
			}
			elseif (isset($_POST[$data]))
			{
				$selected = array($_POST[$data]);
			}
		}

		$extra = _attributes_to_string($extra);

		$multiple = (count($selected) > 1 && stripos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';
		
		$form = '<select '.rtrim(_parse_form_attributes($data, $defaults)).$extra.$multiple.">\n";

		foreach ($options as $key => $val)
		{
			$key = (string) $key;

			if (is_array($val))
			{
				if (empty($val))
				{
					continue;
				}

				$form .= '<optgroup label="'.$key."\">\n";

				foreach ($val as $optgroup_key => $optgroup_val)
				{
					$sel = in_array($optgroup_key, $selected) ? ' selected="selected"' : '';
					$form .= '<option value="'.html_escape($optgroup_key).'"'.$sel.'>'
						.(string) $optgroup_val."</option>\n";
				}

				$form .= "</optgroup>\n";
			}
			else
			{
				$form .= '<option value="'.html_escape($key).'"'
					.(in_array($key, $selected) ? ' selected="selected"' : '').'>'
					.(string) $val."</option>\n";
			}
		}

		return $form."</select>\n";
	}
}

// --------------------------------------------------------------------

if ( ! function_exists('form_dropdown_1'))
{
	/**
	 * Drop-down Menu
	 *
	 * @param	mixed	$data
	 * @param	mixed	$options
	 * @param	mixed	$selected
	 * @param	mixed	$extra
	 * @return	string
	 */
	function form_dropdown_1($data = '', $options = array(), $selected = array(), $extra = '')
	{
		if(isset($data['class']) and isset($data['name']))
		{
			$data['class'] = $data['class'] . ''. (form_error("$data[name]") ? ' error':'');
		}

		$defaults = array();

		if (is_array($data))
		{
			if (isset($data['selected']))
			{
				$selected = $data['selected'];
				unset($data['selected']); // select tags don't have a selected attribute
			}

			if (isset($data['options']))
			{
				$options = $data['options'];
				unset($data['options']); // select tags don't use an options attribute
			}
		}
		else
		{
			$defaults = array('name' => $data);
		}

		is_array($selected) OR $selected = array($selected);
		is_array($options) OR $options = array($options);

		// If no selected state was submitted we will attempt to set it automatically
		if (empty($selected))
		{
			if (is_array($data))
			{
				if (isset($data['name'], $_POST[$data['name']]))
				{
					$selected = array($_POST[$data['name']]);
				}
			}
			elseif (isset($_POST[$data]))
			{
				$selected = array($_POST[$data]);
			}
		}

		$extra = _attributes_to_string($extra);

		$multiple = (count($selected) > 1 && stripos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

		$form = '<select '.rtrim(_parse_form_attributes($data, $defaults)).$extra.$multiple.">\n";

		foreach ($options as $key => $val)
		{
			$key = (string) $key;

			if (is_array($val))
			{
				if (empty($val))
				{
					continue;
				}

				$form .= '<optgroup label="'.$key."\">\n";

				foreach ($val as $optgroup_key => $optgroup_val)
				{
					$sel = in_array($optgroup_key, $selected) ? ' selected="selected"' : '';
					$form .= '<option value="'.html_escape($optgroup_key).'"'.$sel.'>'
						.(string) $optgroup_val."</option>\n";
				}

				$form .= "</optgroup>\n";
			}
			else
			{
				$form .= '<option value="'.html_escape($key).'" '.(is_object($val) ? rtrim(_parse_form_data_attributes((array)$val, array())) : '')
					.(in_array($key, $selected) ? ' selected="selected"' : '').'>'
					.(is_object($val) ? (string) $val->name : $val)."</option>\n";
			}
		}

		return $form."</select>\n";
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('_parse_form_data_attributes'))
{
	/**
	 * Parse the form attributes
	 *
	 * Helper function used by some of the form helpers
	 *
	 * @param	array	$attributes	List of attributes
	 * @param	array	$default	Default values
	 * @return	string
	 */
	function _parse_form_data_attributes($attributes, $default)
	{
		if (is_array($attributes))
		{
			foreach ($default as $key => $val)
			{
				if (isset($attributes[$key]))
				{
					$default[$key] = $attributes[$key];
					unset($attributes[$key]);
				}
			}

			if (count($attributes) > 0)
			{
				$default = array_merge($default, $attributes);
			}
		}

		$att = '';

		foreach ($default as $key => $val)
		{
			if ($key === 'value')
			{
				$val = html_escape($val);
			}
			elseif ($key === 'name' && ! strlen($default['name']))
			{
				continue;
			}

			$att .= 'data-'.$key.'="'.$val.'" ';
		}

		return $att;
	}
}


// ------------------------------------------------------------------------

if ( ! function_exists('form_checkbox_1'))
{
	/**
	 * Checkbox Field
	 *
	 * @param	mixed
	 * @param	string
	 * @param	bool
	 * @param	mixed
	 * @return	string
	 */
	function form_checkbox_1($data = '', $value = '', $checked = FALSE, $extra = '')
	{
		$defaults = array('type' => 'checkbox', 'name' => ( ! is_array($data) ? $data : ''), 'value' => $value);

		if (is_array($data) && array_key_exists('checked', $data))
		{
			$checked = $data['checked'];

			if ($checked == FALSE)
			{
				unset($data['checked']);
			}
			else
			{
				$data['checked'] = 'checked';
			}
		}

		if ($checked == TRUE)
		{
			$defaults['checked'] = 'checked';
		}
		else
		{
			unset($defaults['checked']);
		}


		if(!isset($data['id']))
		{
			$data['id'] = $data['name'].'_'.rand();
		}
		if(!isset($data['label']))
		{
			$data['label'] = $data['name'];
		}

		if(!isset($data['class']))$data['class'] = '';
		
		if(isset($data['class']) and isset($data['name']))
		{
			$data['class'] = $data['class'] . ''. (form_error("$data[name]") ? ' error':'');
		}
		
		$class_label = '';	//(form_error("$data[name]") ? ' class="error"':'');

				
		$outer = '<div class="radio-box '.$data['class'].'">'.
		'<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n"
		.'<label'.$class_label.' for="'.$data['id'].'">'.$data['label'].'</label>
		<span class="check"></span>
		</div>';
	
		return $outer;
		//return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('form_radio_1'))
{
	/**
	 * Radio Button
	 *
	 * @param	mixed
	 * @param	string
	 * @param	bool
	 * @param	mixed
	 * @return	string
	 */
	function form_radio_1($data = '', $value = '', $checked = FALSE, $extra = '')
	{
		is_array($data) OR $data = array('name' => $data);
		$data['type'] = 'radio';

		return form_checkbox_1($data, $value, $checked, $extra);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('validation_errors'))
{
	/**
	 * Validation Error String
	 *
	 * Returns all the errors associated with a form submission. This is a helper
	 * function for the form validation class.
	 *
	 * @param	string
	 * @param	string
	 * @return	string
	 */
	function validation_errors($prefix = '<li><span>', $suffix = '</span></li>')
	{
		if (FALSE === ($OBJ =& _get_validation_object()))
		{
			return '';
		}

		$errors = $OBJ->error_string($prefix, $suffix);

		if(empty($errors))
		{
			return '';
		}
		
		return $errors;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('set_value_textarea'))
{
	/**
	 * Form Value
	 *
	 * Grabs a value from the POST array for the specified field so you can
	 * re-populate an input field or textarea. If Form Validation
	 * is active it retrieves the info from the validation class
	 *
	 * @param	string	$field		Field name
	 * @param	string	$default	Default value
	 * @param	bool	$html_escape	Whether to escape HTML special characters or not
	 * @return	string
	 */
	function set_value_textarea($field, $default = '', $html_escape = FALSE)
	{
		$CI =& get_instance();

		$value = (isset($CI->form_validation) && is_object($CI->form_validation) && $CI->form_validation->has_rule($field))
			? $CI->form_validation->set_value($field, $default)
			: $CI->input->post($field, FALSE);

		isset($value) OR $value = $default;
		return ($html_escape) ? html_escape($value) : $value;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('form_textarea'))
{
	/**
	 * Textarea field
	 *
	 * @param	mixed	$data
	 * @param	string	$value
	 * @param	mixed	$extra
	 * @return	string
	 */
	function form_textarea($data = '', $value = '', $extra = '')
	{
		$defaults = array(
			'name' => is_array($data) ? '' : $data,
			'cols' => '40',
			'rows' => '10',
			'class'	=> (form_error(is_array($data) ? '' : $data)?' error':'')
		);

		if ( ! is_array($data) OR ! isset($data['value']))
		{
			$val = $value;
		}
		else
		{
			$val = $data['value'];
			unset($data['value']); // textareas don't use the value attribute
		}

		if(isset($data['class']) and isset($data['name']))
		{
			$data['class'] = $data['class'] . ''. (form_error("$data[name]") ? ' error':'');
		}

		return '<textarea '._parse_form_attributes($data, $defaults)._attributes_to_string($extra).'>'
			.html_escape($val)
			."</textarea>\n";
	}
	
}

if ( ! function_exists('form_error'))
{
	/**
	 * Form Error
	 *
	 * Returns the error for a specific form field. This is a helper for the
	 * form validation class.
	 *
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	string
	 */
	function form_error($field = '', $prefix = '', $suffix = '')
	{
		if (FALSE === ($OBJ =& _get_validation_object()))
		{
			return '';
		}

		return $OBJ->error($field, $prefix, $suffix);
	}
}

if ( ! function_exists('form_error_1'))
{
	function form_error_1($field = '', $custom_error = '', $prefix = '', $suffix = '')
	{
		if (FALSE === ($OBJ =& _get_validation_object()))
		{
			return '';
		}
		
		return $OBJ->error_1($field, $custom_error, $prefix, $suffix);
	}
}

if ( ! function_exists('set_checkbox_1'))
{
	/**
	 * Set Checkbox
	 *
	 * Let's you set the selected value of a checkbox via the value in the POST array.
	 * If Form Validation is active it retrieves the info from the validation class
	 *
	 * @param	string
	 * @param	string
	 * @param	bool
	 * @return	string
	 */
	function set_checkbox_1($field, $value = '', $default = FALSE)
	{
		$CI =& get_instance();

		if (isset($CI->form_validation) && is_object($CI->form_validation) && $CI->form_validation->has_rule($field))
		{
			return $CI->form_validation->set_checkbox_1($field, $value, $default);
		}

		// Form inputs are always strings ...
		$value = (string) $value;
		$input = $CI->input->post($field, FALSE);

		if (is_array($input))
		{
			// Note: in_array('', array(0)) returns TRUE, do not use it
			foreach ($input as &$v)
			{
				if ($value === $v)
				{
					return ' checked="checked"';
				}
			}

			return '';
		}

		// Unchecked checkbox and radio inputs are not even submitted by browsers ...
		if ($CI->input->method() === 'post')
		{
			return ($input === $value) ? ' checked="checked"' : '';
		}

		return ($default === TRUE) ? ' checked="checked"' : '';
	}
}


if ( ! function_exists('form_open'))
{
	/**
	 * Form Declaration
	 *
	 * Creates the opening portion of the form.
	 *
	 * @param	string	the URI segments of the form destination
	 * @param	array	a key/value pair of attributes
	 * @param	array	a key/value pair hidden data
	 * @return	string
	 */
	function form_open($action = '', $attributes = array(), $hidden = array())
	{
		$CI =& get_instance();

		// If no action is provided then set to the current url
		if ( ! $action)
		{
			$action = $CI->config->site_url($CI->uri->uri_string());
		}
		// If an action is not a full URL then turn it into one
		elseif (strpos($action, '://') === FALSE)
		{
			$action = str_replace('//', '/', $action);
			$action = $CI->config->site_url($action);
		}

		$attributes = _attributes_to_string($attributes);

		if (stripos($attributes, 'method=') === FALSE)
		{
			$attributes .= ' method="post"';
		}

		if (stripos($attributes, 'accept-charset=') === FALSE)
		{
			$attributes .= ' accept-charset="'.strtolower(config_item('charset')).'"';
		}

		$form = '<form action="'.$action.'"'.$attributes.">\n";

		if (is_array($hidden))
		{
			foreach ($hidden as $name => $value)
			{
				$form .= '<input type="hidden" name="'.$name.'" value="'.html_escape($value).'" />'."\n";
			}
		}

		// Add CSRF field if enabled, but leave it out for GET requests and requests to external websites
		if ($CI->config->item('csrf_protection') === TRUE && strpos($action, $CI->config->base_url()) !== FALSE && ! stripos($form, 'method="get"'))
		{
			// Prepend/append random-length "white noise" around the CSRF
			// token input, as a form of protection against BREACH attacks
			if (FALSE !== ($noise = $CI->security->get_random_bytes(1)))
			{
				list(, $noise) = unpack('c', $noise);
			}
			else
			{
				$noise = mt_rand(-128, 127);
			}

			// Prepend if $noise has a negative value, append if positive, do nothing for zero
			$prepend = $append = '';
			if ($noise < 0)
			{
				$prepend = str_repeat(" ", abs($noise));
			}
			elseif ($noise > 0)
			{
				$append  = str_repeat(" ", $noise);
			}

			$form .= sprintf(
				'%s<input type="hidden" name="%s" value="%s" />%s%s',
				$prepend,
				$CI->security->get_csrf_token_name(),
				$CI->security->get_csrf_hash(),
				$append,
				"\n"
			);
		}

		return $form;
	}
	
	if ( ! function_exists('get_validation_errors'))
	{
		function get_validation_errors()
		{
			if (FALSE === ($OBJ =& _get_validation_object()))
			{
				return '';
			}
			
			return $OBJ->get_validation_errors();
		}
	}
	
}



/* End of file MY_form_helper.php */
/* Location: ./application/helpers/MY_form_helper.php */