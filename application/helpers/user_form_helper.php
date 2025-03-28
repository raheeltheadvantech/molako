<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('_get_validation_object'))
{
	function &_get_validation_object()
	{
		$CI =& get_instance();

		// We set this as a variable since we're returning by reference.
		$return = FALSE;

		if (FALSE !== ($object = $CI->load->is_loaded('Form_validation_user')))
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

if ( ! function_exists('form_input_1'))
{
	function form_input_1($data = '', $value = '', $extra = '')
	{
		$defaults = array(
			'type' => 'text',
			'name' => is_array($data) ? '' : $data,
			'oninput' => isset($data['oninput']) ? $data['oninput'] : '',
	        'onkeydown' => isset($data['onkeydown']) ? $data['onkeydown'] : ' ', // Added onkeydown attribute
	        'onkeyup' => isset($data['onkeyup']) ? $data['onkeyup'] : ' ', // Added onkeydown attribute
			'value' => $value,
			//'label' => 'Label',
			'class'	=> (form_error(is_array($data) ? '' : $data)?' error':'')
		);
		
		if(isset($data['class']) and isset($data['name']))
		{
			$data['class'] = $data['class'] . ''. (form_error("$data[name]") ? ' error':'');
		}
		
		$label = 'Label';
		if(isset($data['label']))
		{
			$label = $data['label'];
			unset($data['label']);
		}

		$label_class = '';
		if(isset($data['label_class']))
		{
			$label_class = $data['label_class'];
			unset($data['label_class']);
		}

		if(empty($label_class) && isset($data['required'])){
			$label_class = 'required';
		}
		
		$error = (form_error("$data[name]") ? form_error("$data[name]") : '');

		
		$input = '<div class="form-group ">'."\n";
		
		if($error)
		{
			$input .= '<label class="label-error">'.$error.'</label>'."\n";
		}
		else
		{
			$input .= '<label class="'. $label_class .'">'.$label.'</label>'."\n";
		}
		
		$input .= '<input '.$defaults['oninput'].' ' . _parse_form_attributes($data, $defaults) . _attributes_to_string($extra) . " />\n";
		$input .= '</div>'."\n";
		
		return $input;
	}
}

if ( ! function_exists('form_textarea_1'))
{
	function form_textarea_1($data = '', $value = '', $extra = '')
	{
		$defaults = array(
			'name' => is_array($data) ? '' : $data,
			'cols' => '40',
			'rows' => '10',
		);
		if(isset($data['required']) && $data['required'])
		{


			$defaults['class'] = (form_error(is_array($data) ? '' : $data)?' error':'');
		}

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
			if(isset($data['required']) && $data['required'])
		{
		$data['class'] = $data['class'] . ''. (form_error("$data[name]") ? ' error':'');
		}
			
		}
		
		
		$label = 'Label';
		if(isset($data['label']))
		{
			$label = $data['label'];
			unset($data['label']);
		}
		$error = '';
		if(isset($data['required']) && $data['required'])
		{
		$error = (form_error("$data[name]") ? form_error("$data[name]") : '');
		}
		else
		{
			unset($data['required']);
		}
		
		$input = '<div class="form-group'.($error ? ' error':'').'">'."\n";
		$input .= '<label>'.$label.'</label>'."\n";
		if($error)
		{
			$input .= '<label class="label-error">'.$error.'</label>'."\n";
		}
		
		$input .= '<textarea '._parse_form_attributes($data, $defaults)._attributes_to_string($extra).'>'
			.html_escape($val)
			."</textarea>\n";
		$input .= '</div>'."\n";
		
		return $input;
	}
	
}

if ( ! function_exists('form_dropdown_1'))
{
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
		
		$empty_select = '<option value="">-- Please select --</option>'."\n";
		$form = $form . $empty_select;

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
		
		
		
		$dropdown = $form."</select>\n";
		

		$label = 'Label';
		if(isset($data['label']))
		{
			$label = $data['label'];
			unset($data['label']);
		}
		
		$error = (form_error("$data[name]") ? form_error("$data[name]") : '');
		
		$input = '<div class="form-group'.($error ? ' error':'').'">'."\n";
		$input .= '<label>'.$label.'</label>'."\n";
		if($error)
		{
			$input .= '<label class="label-error">'.$error.'</label>'."\n";
		}
		
		$input .= $dropdown ."\n";
		$input .= '</div>'."\n";
		
		return $input;
		
		
	}
}


/* End of file user_form_helper.php */
/* Location: ./application/helpers/user_form_helper.php */
