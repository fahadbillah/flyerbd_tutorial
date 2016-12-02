<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('partials/about');
	}

	public function get_flyerbd_info()
	{
		_json(array(
			'established' => 2013,
			'description' => 'Flyer posting site',
			'founder' => 'Fahad Billah',
			));
	}

}

/* End of file About.php */
/* Location: ./application/controllers/About.php */