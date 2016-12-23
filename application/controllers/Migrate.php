<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('migration');
	}

	public function index()
	{

        if ($this->migration->current() === FALSE)
        {
                show_error($this->migration->error_string());
        }else{
        	echo "Migration Successful!";
        }
	}

	public function roll_back($version)
	{
		if ($this->migration->version($version)) {
			echo "Rollback successful!";
		} else {
			echo "Rollback failed!";
		}
	}
}

/* End of file Migrate.php */
/* Location: ./application/controllers/Migrate.php */