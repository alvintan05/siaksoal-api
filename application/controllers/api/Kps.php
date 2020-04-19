<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kps extends REST_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Kps', 'mkp');
	}
	
	public function search_get()
	{   
        $responseData = null;
        // masih belum selesai
		$search = array(			
			'prodi' => $this->get('prodi'),
			'tahun' => $this->get('tahun'),
			'semester' => $this->get('semester'),
			'genap_ganjil' => $this->get('genap_ganjil')		
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

	public function detailsoal_get($kode)
	{
		$data = $this->mkp->getDetail($kode);	
		$responseData = null;

		if($data) {
			$responseCode = "200";
			$responseDesc = "Success get detail";
			$responseData = $data;			
		} else {
			$responseCode = "404";
			$responseDesc = "detail not found";			
		}	

		$response = resultJson( $responseCode, $responseDesc, $responseData);
		$this->response($response, REST_Controller::HTTP_OK);
	}

	// Masih error
	public function approval_put()
	{
		$status = $this->put('status');
		$kode = $this->put('kode');
		$responseData = null;
		$upload = null;

		if($status == 'Approve') {
			$upload = array(			
				'note' => $this->put('note'),
				'status' => $this->put('status')
			);
		} else if ($status == 'Reject') {
			$upload = array(			
				'note' => $this->put('note'),
				'status' => $this->put('status')
			);
		}

		$result = $this->mkp->updateApproval($kode, $upload);

		if($result) {
			$responseCode = "200";
			$responseDesc = "Success update approval status";						
		} else {
			$responseCode = "404";
			$responseDesc = "id not found";			
		}	

		$response = resultJson( $responseCode, $responseDesc, $responseData);
		$this->response($response, REST_Controller::HTTP_OK);

	}
    
}