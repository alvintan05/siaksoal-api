<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Panitia extends REST_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_panitia', 'mp');
	}

	public function index_get()
	{
		$data = $this->mp->getSoal();

		if($data) {
			$responseCode = "200";
			$responseDesc = "Success get soal";
			$responseData = $data;
			
		} else {
			$responseCode = "404";
			$responseDesc = "list not found";					
        }	
        
        $response = resultJson( $responseCode, $responseDesc, $responseData);
		$this->response($response, REST_Controller::HTTP_OK);
	}

	
    
}