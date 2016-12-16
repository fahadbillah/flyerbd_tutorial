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
 
if (! function_exists('_random_string'))
{
	function _random_string($length = 10){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}

/* End of file utility_helper.php */
/* Location: ./application/helpers/utility_helper.php */