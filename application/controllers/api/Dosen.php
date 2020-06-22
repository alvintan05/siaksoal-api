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
		$this->load->library('upload');	
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

	// Daftar tahun akademik
	public function tahun_get()
	{
		$data = $this->md->getTahun();

		if($data) {
			$responseCode = "200";
			$responseDesc = "Success get tahun";
			$responseData = $data;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_OK);
		} else {
			$responseCode = "404";
			$responseDesc = "tahun not found";
			$responseData = $data;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_NOT_FOUND);
		}	
	}

	// Dapatkan jadwal berdasarkan tahun dan semester
	public function jadwal_by_get()
	{
		$nip = $this->get('nip');
		$tahun = $this->get('tahun');
		$semester = $this->get('semester');

		if($nip == null && $tahun == null && $semester == null) {
			$responseCode = "403";
			$responseDesc = "Lengkapi Parameter!";			
			$data = null;
			$response = resultJson( $responseCode, $responseDesc, $data);
			$this->response($response, REST_Controller::HTTP_FORBIDDEN);
		} else {
			$data = $this->md->getJadwalByTahun($nip, $tahun, $semester);
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
		$kbk_nip = 0;

		switch ($this->post('kbk_nip')) {
			case 'kbkRPL':				
				$kbk_nip = 11111;
				break;
			case 'kbkMultimedia':
				$kbk_nip = 99999;
				break;
			case 'kbkCB':
				$kbk_nip = 64739;
				break;
			case 'kbkJE':
				$kbk_nip = 74839;
				break;					
		}

		$upload = array(		
			'file' => $this->post('file'),
			'jenis_ujian' => $this->post('jenis_ujian'),
			'jenis_soal' => $this->post('jenis_soal'),
			'status' => 'Processing',			
			'create_at' => date('y-m-d'),
			'update_at' => date('y-m-d'),
			'uts_uas_kodejdwl' => $this->post('uts_uas_kodejdwl'),
			'kbk_nip' => $kbk_nip
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

	public function daftarstatusuts_get()
	{	
		$nip = $this->get('nip');

		$data = $this->md->getStatusListUts($nip);	

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

	public function daftarstatusuas_get()
	{	
		$nip = $this->get('nip');

		$data = $this->md->getStatusListUas($nip);	

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

	// Detail data di halaman edit
	public function editupload_get()
	{
		$kode = $this->get('kode');

		if($kode == null) {
			$responseCode = "403";
			$responseDesc = "Must have kode matkul!";			
			$data = null;
			$response = resultJson( $responseCode, $responseDesc, $data);
			$this->response($response, REST_Controller::HTTP_FORBIDDEN);
		} else {
			$data = $this->md->getEdit($kode);
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
	
	public function editupload_put()
	{			
		$kode = $this->put('kode');
		$responseData = null;

		$kbk_nip = 0;

		switch ($this->put('kbk_nip')) {
			case 'kbkRPL':				
				$kbk_nip = 11111;
				break;
			case 'kbkMultimedia':
				$kbk_nip = 99999;
				break;
			case 'kbkCB':
				$kbk_nip = 64739;
				break;
			case 'kbkJE':
				$kbk_nip = 74839;
				break;					
		}

		$upload = array();
		if($this->put('file') == NULL){
			$upload = array(							
				'jenis_ujian' => $this->put('jenis_ujian'),	
				'jenis_soal' => $this->put('jenis_soal'),
				'kbk_nip' => $kbk_nip,
				'update_at'	=> date('y-m-d')
			);
		} else {
			$upload = array(			
				'file' => $this->put('file'),	
				'jenis_ujian' => $this->put('jenis_ujian'),	
				'jenis_soal' => $this->put('jenis_soal'),
				'kbk_nip' => $kbk_nip,
				'update_at'	=> date('y-m-d')
			);
		}		

		$query = $this->md->updateEditSoal($kode,$upload);

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
