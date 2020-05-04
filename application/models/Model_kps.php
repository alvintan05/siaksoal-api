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
	public function getSearch($search= null)
	{
		if ($search != null) {			
			$this->db->select('*');						
			$this->db->from($this->table_soal);			
			$this->db->join($this->table_jadwal, 'soal_uts_uas.uts_uas_kodejdwl = jadwal_kul.kodejdwl');
			$this->db->where('kode_soal',$search);

			$data = $this->db->get();
			return $data->result_array();
		}
	}	
	

}

/* End of file Model_dosen.php */
/* Location: ./application/models/Model_dosen.php */