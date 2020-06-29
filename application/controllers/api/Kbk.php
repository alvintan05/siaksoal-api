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
	
	public function index_get()
	{
		// Masih bingung yang di pake id apa 
		$nip = $this->get('nip');

		// tabel masih rancu
		$data = $this->mk->getJadwal($nip);	

		if($data) {
			$responseCode = "200";
			$responseDesc = "Success get jadwal";
			$responseData = $data;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_OK);
		} else {
			$responseCode = "404";
			$responseDesc = "jadwal not found";
			
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_NOT_FOUND);
		}	
	}

	public function detailsoal_get($kode)
	{
		$data = $this->mk->getDetail($kode);	
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

		$result = $this->mk->updateApproval($kode, $upload);

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


	public function daftarsoaluas_get()
	{
		$kbk_nip = $this->get('kbk_nip');

		$data = $this->mk->getDaftarsoaluas($kbk_nip);

		if ($data) {
			$responseCode = "200";
			$responseDesc = "Success get list status soal";
			$responseData = $data;
			$response = resultJson($responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_OK);
		} else {
			$responseCode = "404";
			$responseDesc = "list status soal found";
			$responseData = $data;
			$response = resultJson($responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function daftarsoaluts_get()
	{
		$kbk_nip = $this->get('kbk_nip');

		$data = $this->mk->getDaftarsoaluts($kbk_nip);

		if ($data) {
			$responseCode = "200";
			$responseDesc = "Success get list status soal";
			$responseData = $data;
			$response = resultJson($responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_OK);
		} else {
			$responseCode = "404";
			$responseDesc = "list status soal found";
			$responseData = $data;
			$response = resultJson($responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_NOT_FOUND);
		}
	}
    
}