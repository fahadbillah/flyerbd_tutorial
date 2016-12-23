<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
if (! function_exists('_json'))
{
	function _json($data)
	{
		echo json_encode($data);
		exit();
	}
}

if (! function_exists('_remove_array_elements'))
{
	function _remove_array_elements($array = array(), $elements = array())
	{
		if (count($array) === 0) {
			return $array;
		}
		foreach ($elements as $key => $value) {
			unset($array[$value]);
		}
		return $array;
	}
}

/* End of file utility_helper.php */
/* Location: ./application/helpers/utility_helper.php */