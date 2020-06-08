<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {


	// please use $table_number = table name 
	private $table_staff = 'tik.staff';
	private $table_pengurus = 'tik.pengurus_uts_uas';


	// for naming your function
	// please use get for selecting data or getting data 
	// please use insert for selecting data or inserting new data 
	// please use update for selecting data or update data 
	// please use delete for selecting data or deleting data 
	// format camelCase
	// for the result, this is a simple request you can improve by your self to make a any response

	public function getNip($username, $password)
	{				
		$array = array('usr_name' => $username, 'password' => $password);
		$this->db->select('nip');			
		$this->db->from($this->table_staff);		
		$this->db->where($array);

		$data = $this->db->get();
		return $data->result_array();
	}	

	public function getRole($nip)
	{		
		$init_table_staff = $this->table_staff.' s';
		$init_table_pengurus = $this->table_pengurus.' p';		

		$this->db->select('s.nip, s.nama, p.bagian');			
		$this->db->from($init_table_staff);
		$this->db->join($init_table_pengurus, 'p.pengurus_uts_uas_nip = s.nip');		
		$this->db->where('p.pengurus_uts_uas_nip', $nip);		

		$data = $this->db->get();
		return $data->result_array();
	}
	

}

/* End of file Model_login.php */
/* Location: ./application/models/Model_login.php */