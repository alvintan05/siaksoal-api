<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kps extends CI_Model {


    // please use $table_number = table name     
	private $table_soal = 'soal_uts_uas';
	private $table_jadwal = 'jadwal_kul';
	

	// for naming your function
	// please use get for selecting data or getting data 
	// please use insert for selecting data or inserting new data 
	// please use update for selecting data or update data 
	// please use delete for selecting data or deleting data 
	// format camelCase
	// for the result, this is a simple request you can improve by your self to make a any response

	// belum selesai
	
	public function getSearch($search = null)
	{
		if ($search)
		{		
			$this->db->select('s.kode_soal, mk.namamk, s.file, s.jenis_soal, mk.semesterke, dsn.nama as "dosen pembuat"');						
			$this->db->from('soal_uts_uas s');			
			$this->db->join('jadwal_kul jk', 's.uts_uas_kodejdwl = jk.kodejdwl');
			$this->db->join('matakuliah mk','jk.matakuliah_kodemk = mk.kodemk');
			$this->db->join('thn_akad ta', 'jk.thn_akad_thn_akad_id = ta.thn_akad_id');
			$this->db->join('staff dsn', 'jk.staff_nip = dsn.nip');
			$this->db->where('ta.tahun_akad', $search['tahun']);
			$this->db->where('mk.semesterke', $search['semester']);
			$this->db->where('s.jenis_ujian', $search['jenisSoal']);

			$data = $this->db->get();
			return $data->result_array();
		}
	}	

}

/* End of file Model_dosen.php */
/* Location: ./application/models/Model_dosen.php */