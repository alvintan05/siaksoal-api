<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kbk extends CI_Model {


	// please use $table_number = table name 
	private $table_soal = 'tik.soal_uts_uas';
	private $table_jadwal = 'tik.jadwal_kul';
	private $table_matkul = 'tik.matakuliah';
	private $table_kelas = 'tik.kelas';
	private $table_staff = 'tik.staff';
	private $table_prodi = 'tik.prodi';
	private $table_tahun = 'tik.tahun';


	// for naming your function
	// please use get for selecting data or getting data 
	// please use insert for selecting data or inserting new data 
	// please use update for selecting data or update data 
	// please use delete for selecting data or deleting data 
	// format camelCase
	// for the result, this is a simple request you can improve by your self to make a any response

	public function getDaftarSoal($kbk_nip = null)
	{
		if ($kbk_nip != null) {

			$init_table_soal = $this->table_soal.' s';
			$init_table_jadwal = $this->table_jadwal.' j';
			$init_table_staff = $this->table_staff.' st';
			$init_table_matkul = $this->table_matkul.' m';
			$init_table_kelas = $this->table_kelas.' k';
			$init_table_prodi = $this->table_prodi.' p';
			$init_table_tahun = $this->table_tahun.' t';

			$array = array('s.kbk_nip' =>$kbk_nip, 's.jenis_ujian' => 'UAS');


			$this->db->select('s.kode_soal, s.file, m.namamk, st.nama, k.namaklas, t.tahun_akad, t.semester, p.namaprod, s.create_at, s.update_at' );

			$this->db->from($init_table_soal);
			$this->db->join($init_table_jadwal, 's.uts_uas_kodejdwl = j.kodejdwl');
			$this->db->join($init_table_matkul, 'j.matakuliah_kodemk = m.kodemk');
			$this->db->join($init_table_staff, 'j.staff_nip = st.nip');
			$this->db->join($init_table_kelas, 'j.kelas_kodeklas = k.kodeklas');
			$this->db->join($init_table_tahun, 'j.thn_akad_thn_akad_id = t.thn_akad_id');
			$this->db->join($init_table_prodi, 'k.prodi_prodi_id = p.prodi_id');
			$this->db->where($array);

			$data = $this->db->get();
			return $data->result_array();
		}
	}

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