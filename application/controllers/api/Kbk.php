<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kbk extends REST_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_kbk', 'mk');
    }
    
}