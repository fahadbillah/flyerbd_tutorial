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

	public function check_if_social_user_exists($social_id)
	{
		$this->db->where('user_social_id', (int) $social_id);
		$this->db->from('users');
		return $this->db->get()->row_array();
	}

	public function check_if_email_user_exists($user_email)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_email', $user_email);
		return $this->db->get()->row_array();
	}

	public function login_check($login_data)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_email', $login_data['email']);
		$this->db->where('user_password', sha1($login_data['password']));
		return $this->db->get()->row_array();
	}

	public function update_user_data($user_data)
	{
		$this->db->where('user_id', $user_data['user_id']);
		return $this->db->update('users', $user_data['data']);
	}

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */