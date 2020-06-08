<?php  

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Login extends REST_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_login', 'ml');
		$this->load->library('upload');	
	}

	public function index_get()
	{	
		$username = $this->get('username');
		$password = $this->get('password');		

		$data = $this->ml->getNip($username, $password);

		if($data) {
			$responseCode = "200";
			$responseDesc = "Success get nip";			
			$responseData = $data;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_OK);	

			// cek status 
			$nip = $data[0]['nip'];
			$status = $this->ml->getRole($nip);

			if ($status) {
				$responseCode = "200";
				$responseDesc = "Success get role";
				$responseData = $status;
				$response = resultJson( $responseCode, $responseDesc, $responseData);
				$this->response($response, REST_Controller::HTTP_OK);					
			} else {
				$responseCode = "404";
				$responseDesc = "role not found";
				$responseData = $status;
				$response = resultJson( $responseCode, $responseDesc, $responseData);
				$this->response($response, REST_Controller::HTTP_NOT_FOUND);
			}		

		} else {
			$responseCode = "404";
			$responseDesc = "user not found";
			$responseData = $data;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_NOT_FOUND);
		}	
	}

}
