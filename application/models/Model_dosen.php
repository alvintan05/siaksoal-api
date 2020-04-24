<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dosen extends CI_Model {


	// please use $table_number = table name 
	private $table_jadwal = 'tik.jadwal_kul';
	private $table_matkul = 'tik.matakuliah';
	private $table_soal = 'tik.soal_uts_uas';


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
			$this->db->select('*');
			$this->db->from($this->table_jadwal);
			$this->db->where('staff_nip', $nip);			

			$data = $this->db->get();
			return $data->result_array();
		}	
	}
	
	public function getStatusList($nip = null)
	{
		if ($nip != null) {			
			$this->db->select('*');			
			$this->db->from($this->table_soal);
			$this->db->join($this->table_jadwal, 'soal_uts_uas.uts_uas_kodejdwl = jadwal_kul.kodejdwl');
			$this->db->where('jadwal_kul.staff_nip', $nip);

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

	public function insertSoal($data)
	{
		$query = $this->db->insert($this->table_soal, $data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function updateStatusSoal($kode = null, $data)
	{	
		$this->db->where('uts_uas_kodejdwl', $kode);
		$query = $this->db->update($this->table_soal,$data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function deleteUpload($kode = null)
	{	
		$this->db->where('kode_soal', $kode);
		$query = $this->db->delete($this->table_soal);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	

}

/* End of file Model_dosen.php */
/* Location: ./application/models/Model_dosen.php */