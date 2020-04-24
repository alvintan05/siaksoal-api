<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kbk extends CI_Model {


	// please use $table_number = table name 
	private $table_soal = 'tik.soal_uts_uas';
	private $table_jadwal = 'tik.jadwal_kul';
	private $table_staff = 'tik.staff';

	// for naming your function
	// please use get for selecting data or getting data 
	// please use insert for selecting data or inserting new data 
	// please use update for selecting data or update data 
	// please use delete for selecting data or deleting data 
	// format camelCase
	// for the result, this is a simple request you can improve by your self to make a any response

	public function getDetail($kode = null)
	{
		if ($kode != null) {			
			$this->db->select('kode_soal, file, jenis_ujian, jenis_soal, nama');						
			$this->db->from($this->table_soal);			
			$this->db->join($this->table_staff, 'ON soal_uts_uas.dosen_nip = staff.nip');
			$this->db->where('kbk_nip', $kode);

			$data = $this->db->get();
			return $data->result_array();
		}
	}

	public function updateApproval($kode, $upload)
	{
		$this->db->where('kode_soal', $kode);
		$query = $this->db->update($this->table_soal, $upload);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}
	

}

/* End of file Model_dosen.php */
/* Location: ./application/models/Model_dosen.php */