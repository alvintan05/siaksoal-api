<?php  

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Dosen extends REST_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_dosen', 'md');
	}

	public function index_get()
	{	
		$nip = $this->get('nip');

		if($nip == null) {
			$responseCode = "403";
			$responseDesc = "Must use NIP!";			
			$data = null;
			$response = resultJson( $responseCode, $responseDesc, $data);
			$this->response($response, REST_Controller::HTTP_FORBIDDEN);
		} else {
			$data = $this->md->getJadwal($nip);
		}		

		if($data) {
			$responseCode = "200";
			$responseDesc = "Success get jadwal";
			$responseData = $data;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_OK);
		} else {
			$responseCode = "404";
			$responseDesc = "jadwal not found";
			$responseData = $data;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_NOT_FOUND);
		}	
	}

	public function upload_get()
	{
		$kode = $this->get('kode');

		if($kode == null) {
			$responseCode = "403";
			$responseDesc = "Must have nomor matkul!";			
			$data = null;
			$response = resultJson( $responseCode, $responseDesc, $data);
			$this->response($response, REST_Controller::HTTP_FORBIDDEN);
		} else {
			$data = $this->md->getUpload($kode);
		}		

		if($data) {
			$responseCode = "200";
			$responseDesc = "Success get mata kuliah";
			$responseData = $data;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_OK);
		} else {
			$responseCode = "404";
			$responseDesc = "mata kuliah not found";
			$responseData = $data;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_NOT_FOUND);
		}	
		
	}

	public function upload_post()
	{
		$kode = $this->post('kodejdwl');
		$responseData = null;
		$upload = array(
			'kodejdwl' => $this->post('kode'),
			'file' => $this->post('file'),
			'jenis_ujian' => $this->post('jenis_ujian'),
			'jenis_soal' => $this->post('jenis_soal'),
			'status' => $this->post('status'),
			'catatan' => $this->post('note')
		);

		$query = $this->md->insertSoal($kode,$upload);

		if ($query) {
			$responseCode = "200";
			$responseDesc = "Success upload file";
		}
		else{	
			$responseCode = "400";
			$responseDesc = "Failed upload file";
		}

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, REST_Controller::HTTP_OK);
	}

	public function editupload_put()
	{
		$kode = $this->put('kode');
		$responseData = null;
		$upload = array(			
			'file' => $this->put('file'),
			'jenis_ujian' => $this->put('jenis_ujian'),
			'jenis_soal' => $this->put('jenis_soal'),
			'status' => $this->put('status'),
			'catatan' => $this->put('note')
		);

		$query = $this->md->updateSoal($kode,$upload);

		if ($query) {
			$responseCode = "200";
			$responseDesc = "Success update";
		}
		else{	
			$responseCode = "400";
			$responseDesc = "Failed update";
		}

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, REST_Controller::HTTP_OK);
	}

}
