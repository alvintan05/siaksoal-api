<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_panitia extends CI_Model {


	// please use $table_number = table name 
	private $table_soal = 'tik.soal_uts_uas';
	private $table_jadwal = 'tik.jadwal_kul';
	private $table_matkul = 'tik.matakuliah';
	private $table_batas = 'tik.batas_waktu';

	
	// for naming your function
	// please use get for selecting data or getting data 
	// please use insert for selecting data or inserting new data 
	// please use update for selecting data or update data 
	// please use delete for selecting data or deleting data 
	// format camelCase
	// for the result, this is a simple request you can improve by your self to make a any response
	
	public function getSoal()
	{	
		$init_table_soal = $this->table_soal.' s';
		$init_table_jadwal = $this->table_jadwal.' j';
		$init_table_matkul = $this->table_matkul.' m';

		$this->db->select('s.kode_soal, m.namamk, dsn.nama as "dosen pembuat", s.jenis_soal, s.file, m.semesterke');						
		$this->db->from($init_table_soal);			
		$this->db->join($init_table_jadwal, 's.uts_uas_kodejdwl = j.kodejdwl');
		$this->db->join($init_table_matkul,'j.matakuliah_kodemk = m.kodemk');
		$this->db->join('staff dsn', 'j.staff_nip = dsn.nip');
		$this->db->where('s.status = "approved"');

		$data = $this->db->get();
		return $data->result_array();
	}	

	public function getBatasWaktu()
	{				
		$this->db->from($this->table_batas);							
		$data = $this->db->get();
		return $data->result_array();
	}	

	public function updateBatasWaktu($upload, $jenis)
	{
		$this->db->where('jenis_ujian', $jenis);
		$query = $this->db->update($this->table_batas,$upload);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

}

/* End of file Model_panitia.php */
/* Location: ./application/models/Model_panitia.php */