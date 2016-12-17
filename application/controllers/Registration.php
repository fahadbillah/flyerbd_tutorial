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
		$user_data['user_token'] = _random_string(40);
		$user_data['user_status'] = 'not_yet_activated';

		$this->load->model('user_model');

		$existing_user_data = $this->user_model->check_if_email_user_exists($user_data['user_email']);

		// var_dump($existing_user_data);
		// exit();

		// if ($existing_user_data !== false) {
		// 	if ($existing_user_data['password'] !== null) {
		// 		# code...
		// 	}
		// 	// update_user_info
		// 	_json(array(
		// 		'success' => false,
		// 		'message' => 'This email already exists! Please try to login.'
		// 		));
		// }
		

		
		if ($this->user_model->insert_user($user_data) === true) {
			_json(array(
				'success' => true,
				'message' => 'Registration Successful!'
				));
		}else{
			_json(array(
				'success' => false,
				'message' => 'Registration Failed!'
				));
		}
	}

	public function facebook()
	{
		$login_data = $this->input->post();

		date_default_timezone_set('UTC');

		$fbApp = new Facebook\FacebookApp('326474321078728', '10c982d5c0f7e5dfe4516e37b7e66337');
				

		$signedRequest = new Facebook\SignedRequest($fbApp, $login_data['signedRequest']);



		$fb = new Facebook\Facebook([
			'app_id' => '326474321078728',
			'app_secret' => '10c982d5c0f7e5dfe4516e37b7e66337',
			'default_graph_version' => 'v2.8',
			]);

		$helper = $fb->getJavaScriptHelper();


		try {
			$accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			_json(array(
				'success' => false,
				'message' => 'Graph returned an error: ' . $e->getMessage(),
				));
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			_json(array(
				'success' => false,
				'message' => 'Facebook SDK returned an error: ' . $e->getMessage(),
				));
		}
		if (! isset($accessToken)) {
			_json(array(
				'success' => false,
				'message' => 'No cookie set or no OAuth data could be obtained from cookie.',
				));
		}

		try {
			$response = $fb->get('/me?fields=id,name,email,friends,first_name,last_name,age_range,link,gender,locale,picture,timezone,updated_time,verified', (string) $accessToken);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			_json(array(
				'success' => false,
				'message' => 'Graph returned an error: ' . $e->getMessage(),
				));
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			_json(array(
				'success' => false,
				'message' => 'Facebook SDK returned an error: ' . $e->getMessage(),
				));
		}

		$user = $response->getGraphUser();
		$fb->setDefaultAccessToken($accessToken);


		$sess = array(
			'user_name' => $user['name'],
			'user_email' => $user['email'],
			'user_profile_pic' => $user['picture']['url'],
			'user_gender' => $user['gender'],
			'user_language' => $user['locale'],
			'user_social_id' => (int) $user['id'],
			'user_timezone' => $user['timezone'],
			'user_login_type' => 'facebook',
			);

		$this->load->model('user_model');

		if ($existing_social_user = $this->user_model->check_if_social_user_exists($user['id'])) {
			$message = 'login successful!';
			$sess['user_id'] = $existing_social_user['user_id'];
		}else{
			if ($existing_email_user = $this->user_model->check_if_email_user_exists($user['email'])) {
				$user_data = array(
					'data' => array(
						'user_profile_pic' => $user['picture']['url'],
						'user_gender' => $user['gender'],
						'user_language' => $user['locale'],
						'user_social_id' => (int) $user['id'],
						'user_timezone' => $user['timezone'],
						'user_login_type' => 'facebook',
						),
					'user_id' => $existing_email_user['user_id']
					);
				$this->user_model->update_user_data($user_data); // here activate user
				$message = 'login successful!';
				$sess['user_id'] = $existing_email_user['user_id'];
			}else{
				$this->user_model->insert_user($sess);
				$sess['user_id'] = $this->db->insert_id();
				$message = 'Registration successful!';
			}
		}

		$sess['fb_access_token'] = (string) $accessToken;
		$sess['logged_in'] = true;
		$this->session->set_userdata( $sess );
		_json(array(
			'success' => true,
			'message' => $message,
			'data' => $sess
			));
	}
}
/* End of file Registration.php */
/* Location: ./application/controllers/Registration.php */