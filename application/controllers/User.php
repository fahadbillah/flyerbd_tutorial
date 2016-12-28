<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('partials/user.php');
	}

	public function upload_profile_pic()
	{
		// var_dump($this->input->post());

        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10000;
        $config['encrypt_name']			= true;

        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('image'))
        {
                $error = array('error' => $this->upload->display_errors());
                // var_dump($error);

				$result = array(
					'success' => true,
					'message' => array(
						'title' => 'Upload failed!',
						'message' => 'Try again later',
						)
					);
				_json($result);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            // var_dump($data);
			$this->load->library('image_lib');

        	$thumbnail['image_library'] = 'gd2';
			$thumbnail['source_image'] = './uploads/'.$data['upload_data']['file_name'];
			$thumbnail['create_thumb'] = TRUE;
			$thumbnail['height']         = 50;
			$thumbnail['width']         = 50;


			// var_dump($this->image_lib->initialize($thumbnail));

			$this->image_lib->resize();

            $this->image_lib->clear();

        	$resize['image_library'] = 'gd2';
			$resize['source_image'] = './uploads/'.$data['upload_data']['file_name'];
			$resize['maintain_ratio'] = TRUE;
			$resize['width']         = 300;
			$resize['height']         = 300;

			$this->image_lib->initialize($resize);

			$this->image_lib->resize();

			$this->load->model('user_model');


			$user_data = array(
				'data' => array(
					'user_profile_pic' => $data['upload_data']['file_name'],
					),
				'user_id' => $this->session->userdata('user_id')
				);


			$this->user_model->update_user_data($user_data); // here activate user

			$result = array(
				'success' => true,
				'message' => array(
					'title' => 'Upload successful!',
					'message' => 'Successfully set profile picture.',
					),
				'data' => array(
					'user_profile_pic' => $data['upload_data']['file_name'],
					)
				);

			$sess = array(
				'user_profile_pic' => $data['upload_data']['file_name'],
			);
			
			$this->session->set_userdata( $sess );
			_json($result);
        }
	}

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */