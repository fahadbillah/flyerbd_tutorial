<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('partials/login');
	}

	public function status()
	{
		$session_data = $this->session->all_userdata();
		if (isset($session_data['logged_in']) && $session_data['logged_in'] === true) {
			_json(_remove_array_elements($session_data, ['__ci_last_regenerate']));
		} else {
			// set_status_header('401');
			_json(array('user not logged in'));
		}
		
	}

	public function varify()
	{
		$user_data = $this->input->post(); // receive post data from login form
		$this->load->model('user_model');
		
		if ($result = $this->user_model->login_check($user_data)) { // check if email password combination is valid
			if ($result['user_status'] === 'activated') { // login if account status is active
				$success = true;
				$message = 'Login successful!';
				$data = $result;
			} else if ($result['user_status'] === 'banned') { // show message for banned user 
				$success = false;
				$message = 'Your account is banned!!';
				$data = [];
			}  else if ($result['user_status'] === 'not_yet_activated') { // show message for registered but not email activated user
				$success = false;
				$message = 'Your account is not activated! Please activate first.';
				$data = [];
			} else if ($result['user_status'] === 'deactivated') { // if user deactivated activate and login the user
				$user_data = array(
					'data' => array('user_status' => 'activated'),
					'user_id' => $result['user_id']
					);
				$this->user_model->update_user_data($user_data); // here activate user
				$result['user_status'] = 'activated';
				$success = true;
				$message = 'Welcome back! '.$result['user_name'];
				$data = $result;
			}

			$data = _remove_array_elements($data,['user_password','user_token']); // after successful login we will send data to frontend so remove all sensitive data from array

			$data['logged_in'] = true; // set logged_in status true
			
			$this->session->set_userdata( $data ); // set session

			_json(array( // return json response
				'success' => $success,
				'message' => $message,
				'data' => $data,
				));
		} else {
			_json(array( // if email password not matched show this message
				'success' => false,
				'message' => 'Login failed! email or password not matched',
				));
		}
	}

	public function logout()
	{
		session_destroy();
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */