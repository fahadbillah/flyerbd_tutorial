<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function insert_user($user_data)
	{
		return $this->db->insert('users', $user_data);
	}

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */