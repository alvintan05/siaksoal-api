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

	}

	public function approval_put()
	{
		$status = $this->put('status');
		$kode = $this->put('kode');
		$responseData = null;
		$upload = null;

		if($status == 'Diterima') {
			$upload = array(			
				'note' => $this->put('note'),
				'status' => $this->put('status')
			);
		} else if ($status == 'Ditolak') {
			$upload = array(			
				'note' => $this->put('note'),
				'status' => $this->put('status')
			);
		}

		$result = $this->mk->updateApproval($kode, $upload);

		if($result) {
			$responseCode = "200";
			$responseDesc = "Success update approval status";	
			$responseData = 'Berhasil';			
		} else {
			$responseCode = "404";
			$responseDesc = "id not found";
			$responseData = 'Gagal';
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

	// Dapatkan soal uts berdasarkan tahun dan semester
	public function daftarsoaluts_by_get()
	{
		$nip = $this->get('kbk_nip');
		$tahun = $this->get('tahun');
		$semester = $this->get('semester');

		if($nip == null && $tahun == null && $semester == null) {
			$responseCode = "403";
			$responseDesc = "Lengkapi Parameter!";			
			$data = null;
			$response = resultJson( $responseCode, $responseDesc, $data);
			$this->response($response, REST_Controller::HTTP_FORBIDDEN);
		} else {
			$data = $this->mk->getSoalUtsByTahun($nip, $tahun, $semester);
		}		

		if($data) {
			$responseCode = "200";
			$responseDesc = "Success get uts";
			$responseData = $data;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_OK);
		} else {
			$responseCode = "404";
			$responseDesc = "uts not found";
			$responseData = $data;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_NOT_FOUND);
		}	
	}

	// Dapatkan soal uas berdasarkan tahun dan semester
	public function daftarsoaluas_by_get()
	{
		$nip = $this->get('kbk_nip');
		$tahun = $this->get('tahun');
		$semester = $this->get('semester');

		if($nip == null && $tahun == null && $semester == null) {
			$responseCode = "403";
			$responseDesc = "Lengkapi Parameter!";			
			$data = null;
			$response = resultJson( $responseCode, $responseDesc, $data);
			$this->response($response, REST_Controller::HTTP_FORBIDDEN);
		} else {
			$data = $this->mk->getSoalUasByTahun($nip, $tahun, $semester);
		}		

		if($data) {
			$responseCode = "200";
			$responseDesc = "Success get uas";
			$responseData = $data;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_OK);
		} else {
			$responseCode = "404";
			$responseDesc = "uas not found";
			$responseData = $data;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_NOT_FOUND);
		}	
	}
    
}