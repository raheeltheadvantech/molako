<?php 
function format_address($fields, $br=false)
{
	if(empty($fields))
	{
		return ;
	}
	
	// Default format
	$default = "{firstname} {lastname}\n{company}\n{address_1}\n{address_2}\n{city}, {zone} {postcode}\n{country}";
	
	// Fetch country record to determine which format to use
	$CI = &get_instance();
	$CI->load->model('location_model');
	$c_data = $CI->location_model->get_country($fields['country_id']);
	
	if(empty($c_data->address_format))
	{
		$formatted	= $default;
	} else {
		$formatted	= $c_data->address_format;
	}
	$formatted		= str_replace('{firstname}', $fields['firstname'], $formatted);
	$formatted		= str_replace('{lastname}',  $fields['lastname'], $formatted);
	$formatted		= str_replace('{company}',  $fields['company'], $formatted);
	
	$formatted		= str_replace('{address_1}', $fields['address1'], $formatted);
	$formatted		= str_replace('{address_2}', $fields['address2'], $formatted);
	$formatted		= str_replace('{city}', $fields['city'], $formatted);
	$formatted		= str_replace('{zone}', $fields['zone'], $formatted);
	$formatted		= str_replace('{postcode}', $fields['zip'], $formatted);
	$formatted		= str_replace('{country}', $fields['country'], $formatted);
	
	// remove any extra new lines resulting from blank company or address line
	$formatted		= preg_replace('`[\r\n]+`',"\n",$formatted);
	if($br)
	{
		$formatted	= nl2br($formatted);
	}
	return $formatted;
	
}

function format_currency($value, $symbol=true, $decimal_points=true)
{
	if(!is_numeric($value))
	{
		return;
	}
	
	$CI =& get_instance();
	
	$currency_symbol 		= $CI->config->item('config_currency') ? $CI->config->item('config_currency') : '$';
	$currency_symbol_side 	= $CI->config->item('currency_symbol_side') ? $CI->config->item('currency_symbol_side') : 'left';
	$currency_number_decimal_points 	= $CI->config->item('currency_number_decimal_points') ? $CI->config->item('currency_number_decimal_points') : 2;
	$currency_decimal 	= $CI->config->item('currency_decimal') ? $CI->config->item('currency_decimal') : '.';
	$currency_thousands_separator 	= $CI->config->item('currency_thousands_separator') ? $CI->config->item('currency_thousands_separator') : ',';
	
	
	if($value < 0 )
	{
		$neg = '- ';
	} else {
		$neg = '';
	}
	
	if($symbol)
	{
		$formatted	= number_format(abs($value), ($decimal_points ? $currency_number_decimal_points:0), $currency_decimal, $currency_thousands_separator);
		
		if( $currency_symbol_side == 'left' )
		{
			$formatted	= $neg . $currency_symbol .' '. $formatted;
		}
		else
		{
			$formatted	= $neg.$formatted.' '.$currency_symbol;
		}
	}
	else
	{
		//traditional number formatting
		$formatted	= number_format(abs($value), ($decimal_points ? $currency_number_decimal_points:0), '.', ',');
	}
	
	return $formatted;
}

function format_currency_OLD($value, $symbol=true, $decimal_points=true)
{
	if(!is_numeric($value))
	{
		return;
	}
	
	$CI =& get_instance();
	
	if($value < 0 )
	{
		$neg = '- ';
	} else {
		$neg = '';
	}
	
	if($symbol)
	{
		$formatted	= number_format(abs($value), ($decimal_points ? $CI->config->item('currency_number_decimal_points'):0), $CI->config->item('currency_decimal'), $CI->config->item('currency_thousands_separator'));
		
		if( $CI->config->item('currency_symbol_side') == 'left' )
		{
			$formatted	= $neg.$CI->config->item('currency_symbol').' '.$formatted;
		}
		else
		{
			$formatted	= $neg.$formatted.' '.$CI->config->item('currency_symbol');
		}
	}
	else
	{
		//traditional number formatting
		$formatted	= number_format(abs($value), ($decimal_points ? $CI->config->item('currency_number_decimal_points'):0), '.', ',');
	}
	
	return $formatted;
}


function format_word($word, $uppercase = false){
	
	if(empty($word))
	{
		return '';
	}
	
	// Replace underscores from db word
	$word = str_replace('_', ' ', $word);
	
	// Convert first letter to upper case
	if($uppercase)
	{
		$word = ucfirst($word);
	}
	
	return $word;
}


/*--------- Credit Card Format ---------*/
	function uCase($str){
		// Get the cc Length
		$str_length = strlen($str);
		
		//$str = @ucfirst(@strtolower($str));
		$str = @ucwords(@strtolower($str));
		return $str;
	}
	
	function MaskACH($cc, $last_digits = 2){
		// Get the cc Length
		$cc_length = strlen($cc);
	
		// Replace all characters of account/routing except the last 2 and dashes
		for($i=0; $i<($cc_length-$last_digits); $i++){
			if($cc[$i] == '-'){continue;}
			$cc[$i] = 'X';
		}
	
		// Return the masked Credit Card #
		return $cc;
	}
	/**
	 * Replaces all but the last for digits with x's in the given credit card number
	 * @param int|string $cc The credit card number to mask
	 * @return string The masked credit card number
	 */
	function MaskCreditCard($cc, $mask = 'X'){
		// Get the cc Length
		$cc_length = strlen($cc);
	
		// Replace all characters of credit card except the last four and dashes
		for($i=0; $i<$cc_length-4; $i++){
			if($cc[$i] == '-'){continue;}
			$cc[$i] = $mask;
		}
	
		// Return the masked Credit Card #
		return $cc;
	}
	
	/**
	 * Add dashes to a credit card number.
	 * @param int|string $cc The credit card number to format with dashes.
	 * @return string The credit card with dashes.
	 */
	function FormatCreditCard($cc)
	{
		// Clean out extra data that might be in the cc
		$cc = str_replace(array('-',' '),'',$cc);
	
		// Get the CC Length
		$cc_length = strlen($cc);
	
		// Initialize the new credit card to contian the last four digits
		$newCreditCard = substr($cc,-4);
	
		// Walk backwards through the credit card number and add a dash after every fourth digit
		for($i=$cc_length-5;$i>=0;$i--){
			// If on the fourth character add a dash
			if((($i+1)-$cc_length)%4 == 0){
				$newCreditCard = '-'.$newCreditCard;
			}
			// Add the current character to the new credit card
			$newCreditCard = $cc[$i].$newCreditCard;
		}
	
		// Return the formatted credit card number
		return $newCreditCard;
	}

	//Examples
	//	echo maskCreditCard('5362267121053405').'<br>'; // Prints XXXXXXXXXXXX3405
	//	echo formatCreditCard('5362267121053405').'<br>'; // Prints 5362-2671-2105-3405
	//	echo formatCreditCard(maskCreditCard('5362267121053405')).'<br>'; // Prints XXXX-XXXX-XXXX-3405	
/*--------- Credit format ---------*/
