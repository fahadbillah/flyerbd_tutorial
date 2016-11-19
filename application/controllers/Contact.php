<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('partials/contact');
	}

}

/* End of file Contact.php */
/* Location: ./application/controllers/Contact.php */