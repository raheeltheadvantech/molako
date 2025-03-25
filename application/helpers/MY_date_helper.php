<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Overwriting the timezones function to include Arizona timezone
 */


if ( ! function_exists('timezones'))
{
    /**
     * Timezones
     *
     * Returns an array of timezones. This is a helper function
     * for various other ones in this library
     *
     * @param   string  timezone
     * @return  string
     */
    function timezones($tz = '')
    {
        // Note: Don't change the order of these even though
        // some items appear to be in the wrong order

        $zones = array(
            'UM12'      => -12,
            'UM11'      => -11,
            'UM10'      => -10,
            'UM95'      => -9.5,
            'UM9'       => -9,
            'UM8'       => -8,
            'UM75'      => -7,
            'UM7'       => -7,
            'UM6'       => -6,
            'UM5'       => -5,
            'UM45'      => -4.5,
            'UM4'       => -4,
            'UM35'      => -3.5,
            'UM3'       => -3,
            'UM2'       => -2,
            'UM1'       => -1,
            'UTC'       => 0,
            'UP1'       => +1,
            'UP2'       => +2,
            'UP3'       => +3,
            'UP35'      => +3.5,
            'UP4'       => +4,
            'UP45'      => +4.5,
            'UP5'       => +5,
            'UP55'      => +5.5,
            'UP575'     => +5.75,
            'UP6'       => +6,
            'UP65'      => +6.5,
            'UP7'       => +7,
            'UP8'       => +8,
            'UP875'     => +8.75,
            'UP9'       => +9,
            'UP95'      => +9.5,
            'UP10'      => +10,
            'UP105'     => +10.5,
            'UP11'      => +11,
            'UP115'     => +11.5,
            'UP12'      => +12,
            'UP1275'    => +12.75,
            'UP13'      => +13,
            'UP14'      => +14
        );

        if ($tz === '')
        {
            return $zones;
        }

        return isset($zones[$tz]) ? $zones[$tz] : 0;
    }

	function format_date($date, $format = 4, $add_day = false, $subtract_day = false)
	{
        $CI = get_instance();

		$formats = array(
			1 => 'Y-m-d',
			2 => 'l d F Y',
			3 => 'F j, Y, g:ia',
			4 => 'F j, Y',
			5 => 'l d F Y',
			6 => 'l d F Y',
			7 => 'd F Y',
			8 => 'D d M Y',		//Fri 1 Dec 2017
			9 => 'l, d M Y',	//Thursday, 30 Nov 2017
			10 => 'l, j F Y',	//Thursday, 3 November 2017
			11 => 'd M Y',		//7 Dec 2017
			12 => 'M d, Y',		//Nov, 30 2017
			13 => 'd',			//30
			14 => 'd l',		//30 Thursday
			15 => 'D, d M Y',	//Fri, 1 Dec 2017
			16 => 'l j F Y',	//Thursday 3 November 2017
			17 => 'd M',		//7 Dec
			18 => 'd',			//7
			19 => 'F',			//November
			20 => 'D h:i a',	//FRI 3:00 pm
			21 => 'h:i a',		//3:00 pm
			22 => 'd M Y, g:ia',
			);
			
		if( is_int($format) and !empty($formats[$format]) )
		{
			$format = $formats[$format];
		}
		
		if ($date != '' && $date != '0000-00-00' && $date != '0000-00-00 00:00:00')
		{
			if($add_day)
			{	
				$return = date("$format", strtotime("+$add_day day", strtotime($date)));
			}
			elseif($subtract_day)
			{	
				$return = date("$format", strtotime("-$subtract_day day", strtotime($date)));
			}
			else
			{
				$return = date("$format", strtotime($date));
			}
			
			
			if (isset($CI->common_session) and $CI->common_session->lang['culture_code'] == 'ar-SA')
			{
				return arabic_date($return, $format);
			}
			
			return $return;
			
		}
		else
		{
			return false;
		}
	}

	function format_time($time, $format = 1)
	{
		$formats = array(
			1 => 'H:i:s',
			2 => 'g:i A',
			);
			
		if( is_int($format) and !empty($formats[$format]) )
		{
			$format = $formats[$format];
		}
		
		if ($time != '' && $time != '00:00' && $time != '00:00:00')
		{
			return date("$format", strtotime($time));
		}
		else
		{
			return false;
		}
	}
	
	function format_mdy($date)
	{
		if(empty($date) || $date == '0000-00-00')
		{
			return '';
		}
		else
		{
			return date('m-d-Y', strtotime($date));
		}
	}
	
	function format_ymd($date)
	{
		if(empty($date) || $date == '00-00-0000')
		{
			return '';
		}
		else
		{
			return date('Y-m-d', strtotime($date));
		}
	}	
}
