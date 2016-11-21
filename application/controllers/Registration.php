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

	public function create_user()
	{
		$user_data = $this->input->post();

		$user_data['user_password'] = sha1($user_data['user_password']);

		$this->load->model('user_model');
		
		if ($this->user_model->insert_user($user_data) === true) {
			echo json_encode(array(
				'success' => true,
				'message' => 'Registration Successful!'
				));
		}else{
			echo json_encode(array(
				'success' => false,
				'message' => 'Registration Failed!'
				));
		}
	}

}

/* End of file Registration.php */
/* Location: ./application/controllers/Registration.php */