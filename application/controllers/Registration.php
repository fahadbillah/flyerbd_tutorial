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
		// $user_data['user_token'] = _random_string(40);
		$user_data['user_status'] = 'not_yet_activated';

		$this->load->model('user_model');

		if ($existing_user_data = $this->user_model->check_if_email_user_exists($user_data['user_email'])) {
			$message = [
				'title' => 'This email already exists!',
				'description' => 'Please try to login.'
			];
			_json(array(
				'success' => false,
				'message' => $message
				));
		}
		
		if ($this->user_model->insert_user($user_data) === true) {
			$message = [
				'title' => 'Registration Successful!',
				'description' => 'Please login.'
			];
			_json(array(
				'success' => true,
				'message' => $message
				));
		}else{
			$message = [
				'title' => 'Registration Failed!',
				'description' => 'Please try again later.'
			];
			_json(array(
				'success' => false,
				'message' => $message
				));
		}
	}

	public function facebook()
	{
		$login_data = $this->input->post();

		date_default_timezone_set('UTC');

		$facebook_app_id = 'some_app_id';
		$facebook_app_secret = 'some_secret_id';

		$fbApp = new Facebook\FacebookApp($facebook_app_id, $facebook_app_secret);
				

		$signedRequest = new Facebook\SignedRequest($fbApp, $login_data['signedRequest']);



		$fb = new Facebook\Facebook([
			'app_id' => $facebook_app_id,
			'app_secret' => $facebook_app_secret,
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

		// check if social user exists
		if ($existing_social_user = $this->user_model->check_if_social_user_exists($user['id'])) {
			// login if exists
			$existing_user_status = $existing_social_user['user_status'];
			$message = [
				'title' => 'login successful!',
				'description' => 'Welcome '.$existing_social_user['user_name']
			];
			$sess['user_id'] = $existing_social_user['user_id'];
		}else{
			// if social user not exists check if user with same email (from social login) exists
			if ($existing_email_user = $this->user_model->check_if_email_user_exists($user['email'])) {
				// if user with same email exists update old email user data and add new info gathered from facebook
				$existing_user_status = $existing_email_user['user_status'];
				$user_data = array(
					'data' => array(
						'user_profile_pic' => $user['picture']['url'],
						'user_gender' => $user['gender'],
						'user_language' => $user['locale'],
						'user_social_id' => (int) $user['id'],
						'user_timezone' => $user['timezone'],
						'user_login_type' => 'facebook',
						// now update user status if account not activated or deactivated. just for user friendliness
						'user_status' => ($existing_email_user['user_status'] === 'not_yet_activated' || $existing_email_user['user_status'] === 'deactivated') ? 'activated' : $existing_email_user['user_status']
						),
					'user_id' => $existing_email_user['user_id']
					);
				$this->user_model->update_user_data($user_data); // here activate user
				$message = [
					'title' => 'login successful!',
					'description' => 'Welcome '.$existing_email_user['user_name']
				];
				$sess['user_id'] = $existing_email_user['user_id'];
			}else{
				// if nothing exists registration user like before (facebook registration)
				$this->user_model->insert_user($sess);
				$sess['user_id'] = $this->db->insert_id();
				$message = [
					'title' => 'Registration successful!',
					'description' => 'Welcome '.$sess['user_name']
				];
			}
		}

		// one last check if user is banned. do not let the user login.
		if ($existing_user_status === 'banned') {

			$message = [
				'title' => 'Your account is banned!!',
				'description' => 'Can\'t let you in'
			];
			_json(array(
				'success' => false,
				'message' => $message,
				));	
		}

		// if everything passed just set session and return user data.
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