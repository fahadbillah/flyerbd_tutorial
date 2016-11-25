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

/* End of file utility_helper.php */
/* Location: ./application/helpers/utility_helper.php */