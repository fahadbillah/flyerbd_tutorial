<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('partials/registration');
	}

}

/* End of file Registration.php */
/* Location: ./application/controllers/Registration.php */