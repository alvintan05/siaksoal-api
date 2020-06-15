<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kps extends REST_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_kps', 'mkp');
	}
	
	public function search_post()
	{   
        $responseData = null;
        // masih belum selesai
		$search = array(			
			'tahun' => $this->input->post('tahun'),
			'semester' => $this->input->post('semester'),
			'jenisSoal'	=> $this->input->post('jenissoal')
        );
        
		$data = $this->mkp->getSearch($search);

		if($data) {
			$responseCode = "200";
			$responseDesc = "Success get list";
			$responseData = $data;
			
		} else {
			$responseCode = "404";
			$responseDesc = "list not found";					
        }	
        
        $response = resultJson( $responseCode, $responseDesc, $responseData);
		$this->response($response, REST_Controller::HTTP_OK);
	}
	
    
}