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

	public function soal_uts_get()
	{
		$data = $this->mp->getSoalUts();

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

	public function soal_uas_get()
	{
		$data = $this->mp->getSoalUas();

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
	
	public function soal_uts_by_get()
	{		
		$tahun = $this->get('tahun');
		$semester = $this->get('semester');
		$prodi = $this->get('prodi');

		if($prodi == null && $tahun == null && $semester == null) {
			$responseCode = "403";
			$responseDesc = "Lengkapi Parameter!";			
			$data = null;
			$response = resultJson( $responseCode, $responseDesc, $data);
			$this->response($response, REST_Controller::HTTP_FORBIDDEN);
		} else {
			$data = $this->mp->getSoalUtsBy($tahun, $semester, $prodi);
		}		

		if($data) {
			$responseCode = "200";
			$responseDesc = "Success get soal uts";
			$responseData = $data;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_OK);
		} else {
			$responseCode = "404";
			$responseDesc = "soal uts not found";
			$responseData = $data;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_NOT_FOUND);
		}	
	}

	public function soal_uas_by_get()
	{		
		$tahun = $this->get('tahun');
		$semester = $this->get('semester');
		$prodi = $this->get('prodi');

		if($prodi == null && $tahun == null && $semester == null) {
			$responseCode = "403";
			$responseDesc = "Lengkapi Parameter!";			
			$data = null;
			$response = resultJson( $responseCode, $responseDesc, $data);
			$this->response($response, REST_Controller::HTTP_FORBIDDEN);
		} else {
			$data = $this->mp->getSoalUasBy($tahun, $semester, $prodi);
		}		

		if($data) {
			$responseCode = "200";
			$responseDesc = "Success get soal uas";
			$responseData = $data;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_OK);
		} else {
			$responseCode = "404";
			$responseDesc = "soal uas not found";
			$responseData = $data;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
			$this->response($response, REST_Controller::HTTP_NOT_FOUND);
		}	
	}

	public function batas_waktu_get()
	{
		$data = $this->mp->getBatasWaktu();

		if($data) {
			$responseCode = "200";
			$responseDesc = "Success get batas waktu";
			$responseData = $data;
			
		} else {
			$responseCode = "404";
			$responseDesc = "batas waktu not found";					
        }	
        
        $response = resultJson( $responseCode, $responseDesc, $responseData);
		$this->response($response, REST_Controller::HTTP_OK);	
	}	

	public function update_batas_put()
	{	
		$jenis = $this->put('jenis');
		$responseData = null;
		$upload = array(						
			'batas_awal' => $this->put('batas_awal'),
			'batas_akhir' => $this->put('batas_akhir')
		);

		$query = $this->mp->updateBatasWaktu($upload, $jenis);

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

	// public function nip_dosen_get()
	// {
	// 	$data = $this->mp->getNipDosen();

	// 	if($data) {
	// 		$responseCode = "200";
	// 		$responseDesc = "Success get nip";
	// 		$responseData = $data;
			
	// 	} else {
	// 		$responseCode = "404";
	// 		$responseDesc = "list not found";					
 //        }	
        
 //        $response = resultJson( $responseCode, $responseDesc, $responseData);
	// 	$this->response($response, REST_Controller::HTTP_OK);
	// }

	// public function list_matkul_get()
	// {
	// 	$nip = $this->get('nip');

	// 	$data_jadwal = $this->mp->getListMatkul($nip);
	// 	$data_status = array();

	// 	if($data_jadwal) {
	// 		foreach ($data_jadwal as $result) {				
	// 			array_push($data_status, $this->mp->getMatkulStatus($result['kodejdwl']));
	// 		}
	// 		$responseCode = "200";
	// 		$responseDesc = "Success get list";
	// 		$responseData = array(
	// 			'data_jadwal' => $data_jadwal,
	// 			'data_status' => $data_status
	// 		);
			
	// 	} else {
	// 		$responseCode = "404";
	// 		$responseDesc = "list not found";					
 //        }	
        
 //        $response = resultJson( $responseCode, $responseDesc, $responseData);
	// 	$this->response($response, REST_Controller::HTTP_OK);	
	// }
	   
}