<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dosen extends CI_Model {


	// please use $table_number = table name 
	private $table_jadwal = 'jadwal_kul';
	private $table_matkul = 'matakuliah';
	private $table_upload = 'pengajuan_soal';



	// for naming your function
	// please use get for selecting data or getting data 
	// please use insert for selecting data or inserting new data 
	// please use update for selecting data or update data 
	// please use delete for selecting data or deleting data 
	// format camelCase
	// for the result, this is a simple request you can improve by your self to make a any response

	public function getJadwal($nip = null)
	{
		if ($nip != null) {
			$this->db->where('staff_nip', $nip);
			$this->db->select('*');
			$this->db->from($this->table_jadwal);

			$data = $this->db->get();
			return $data->result_array();
		}	
	}

	public function getUpload($kode = null)
	{
		if ($kode != null) {
			$this->db->where('kodemk', $kode);
			$this->db->select('*');
			$this->db->from($this->table_matkul);

			$data = $this->db->get();
			return $data->result_array();
		}	
	}

	public function insertSoal($kode = null, $data)
	{
		$query = $this->db->insert($this->table_upload, $data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function updateUser($kode = null, $data)
	{
		$this->db->where('kode_soal', $kode);
		$query = $this->db->update($this->table_upload,$data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	

}

/* End of file Model_dosen.php */
/* Location: ./application/models/Model_dosen.php */