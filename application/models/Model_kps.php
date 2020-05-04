<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kps extends CI_Model {


    // please use $table_number = table name     
	private $table_soal = 'tik.soal_uts_uas';
	private $table_jadwal = 'tik.jadwal_kul';
	private $table_matkul = 'tik.matakuliah';
	

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
			$init_table_soal = $this->table_soal.' s';
			$init_table_jadwal = $this->table_jadwal.' j';
			$init_table_matkul = $this->table_matkul.' m';

			$this->db->select('s.kode_soal, m.namamk, s.file, s.jenis_soal, m.semesterke, dsn.nama as "dosen pembuat"');						
			$this->db->from($init_table_soal);			
			$this->db->join($init_table_jadwal, 's.uts_uas_kodejdwl = j.kodejdwl');
			$this->db->join($init_table_matkul,'j.matakuliah_kodemk = m.kodemk');
			$this->db->join('thn_akad ta', 'j.thn_akad_thn_akad_id = ta.thn_akad_id');
			$this->db->join('staff dsn', 'j.staff_nip = dsn.nip');
			$this->db->where('ta.tahun_akad', $search['tahun']);
			$this->db->where('m.semesterke', $search['semester']);
			$this->db->where('s.jenis_ujian', $search['jenisSoal']);

			$data = $this->db->get();
			return $data->result_array();
		}
	}	

}

/* End of file Model_dosen.php */
/* Location: ./application/models/Model_dosen.php */