<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->library('migration');

        if ($this->migration->current() === FALSE)
        {
                show_error($this->migration->error_string());
        }else{
        	echo "Migration Successful!";
        }
	}

}

/* End of file Migrate.php */
/* Location: ./application/controllers/Migrate.php */