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

	// Detail data di halaman upload
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

	// Insert upload soal
	public function upload_post()
	{
		$responseData = null;
		/**
		 * TO DO 
		 * Rubah file di database menjadi blob
		 * Belum bisa upload file
		 */
		$upload = array(			
			'file' => $this->post('file'),
			'jenis_ujian' => $this->post('jenis_ujian'),
			'jenis_soal' => $this->post('jenis_soal'),
			'status' => $this->post('status'),
			'note' => $this->post('note'),
			'uts_uas_kodejdwl' => $this->post('uts_uas_kodejdwl')
		);

		$query = $this->md->insertSoal($upload);

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

	public function daftarstatus_get()
	{	
		$nip = $this->get('nip');

		$data = $this->md->getStatusList($nip);	

		if($data) {
			$responseCode = "200";
			$responseDesc = "Success get list status soal";
			$responseData = $data;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_OK);
		} else {
			$responseCode = "404";
			$responseDesc = "list status soal not found";
			$responseData = $data;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_NOT_FOUND);
		}	
	}

	// update edit upload soal
	public function editupload_put()
	{
		$kode = $this->put('kode');
		$responseData = null;
		$upload = array(			
			'file' => $this->put('file'),			
			'jenis_ujian' => $this->put('jenis_ujian'),			
			'note' => $this->put('note')
		);

		$query = $this->md->updateStatusSoal($kode,$upload);

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

	public function deleteupload_delete()
	{
		$kode = $this->delete('kode');
		$responseData = null;

		$query = $this->md->deleteUpload($kode);

		if ($query) {
			$responseCode = "200";
			$responseDesc = "Success delete";
		}
		else{	
			$responseCode = "400";
			$responseDesc = "Failed delete";
		}

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, REST_Controller::HTTP_OK);
	}

}
