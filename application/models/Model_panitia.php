<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_panitia extends CI_Model {


	// please use $table_number = table name 
	private $table_soal = 'tik.soal_uts_uas';
	private $table_jadwal = 'tik.jadwal_kul';
	private $table_matkul = 'tik.matakuliah';
	private $table_batas = 'tik.batas_waktu';
	private $table_kelas = 'tik.kelas';
	private $table_staff = 'tik.staff';
	private $table_tahun = 'tik.thn_akad';
	private $table_prodi = 'tik.prodi';
	
	// for naming your function
	// please use get for selecting data or getting data 
	// please use insert for selecting data or inserting new data 
	// please use update for selecting data or update data 
	// please use delete for selecting data or deleting data 
	// format camelCase
	// for the result, this is a simple request you can improve by your self to make a any response
	
	public function getSoalUts()
	{	
		$init_table_soal = $this->table_soal.' s';
		$init_table_jadwal = $this->table_jadwal.' j';
		$init_table_matkul = $this->table_matkul.' m';
		$init_table_staff = $this->table_staff.' dsn';
		$init_table_kelas = $this->table_kelas.' k';
		$array = array('s.status' => "Diterima", 's.jenis_ujian' => 'UTS');

		$this->db->select('s.kode_soal, j.matakuliah_kodemk, m.namamk, dsn.nama as "pengajar", k.namaklas, s.jenis_soal, s.file, s.jenis_ujian, s.update_at');
		$this->db->from($init_table_soal);			
		$this->db->join($init_table_jadwal, 's.uts_uas_kodejdwl = j.kodejdwl');
		$this->db->join($init_table_matkul,'j.matakuliah_kodemk = m.kodemk');
		$this->db->join($init_table_staff, 'j.staff_nip = dsn.nip');
		$this->db->join($init_table_kelas, 'j.kelas_kodeklas = k.kodeklas');
		$this->db->where($array);

		$data = $this->db->get();
		return $data->result_array();
	}	

	public function getSoalUas()
	{	
		$init_table_soal = $this->table_soal.' s';
		$init_table_jadwal = $this->table_jadwal.' j';
		$init_table_matkul = $this->table_matkul.' m';
		$init_table_staff = $this->table_staff.' dsn';
		$init_table_kelas = $this->table_kelas.' k';
		$array = array('s.status' => "Diterima", 's.jenis_ujian' => 'UAS');

		$this->db->select('s.kode_soal, j.matakuliah_kodemk, m.namamk, dsn.nama as "pengajar", k.namaklas, s.jenis_soal, s.file, s.jenis_ujian, s.update_at');
		$this->db->from($init_table_soal);			
		$this->db->join($init_table_jadwal, 's.uts_uas_kodejdwl = j.kodejdwl');
		$this->db->join($init_table_matkul,'j.matakuliah_kodemk = m.kodemk');
		$this->db->join($init_table_staff, 'j.staff_nip = dsn.nip');
		$this->db->join($init_table_kelas, 'j.kelas_kodeklas = k.kodeklas');
		$this->db->where($array);

		$data = $this->db->get();
		return $data->result_array();
	}	

	public function getSoalUtsBy($tahun, $semester, $prodi)
	{
		$init_table_soal = $this->table_soal.' s';
		$init_table_jadwal = $this->table_jadwal.' j';
		$init_table_matkul = $this->table_matkul.' m';
		$init_table_staff = $this->table_staff.' dsn';		
		$init_table_kelas = $this->table_kelas.' k';
		$init_table_tahun = $this->table_tahun.' t';
		$init_table_prodi = $this->table_prodi.' p';

		$this->db->select('s.kode_soal, j.matakuliah_kodemk, m.namamk, dsn.nama as "pengajar", k.namaklas, s.jenis_soal, s.file, s.jenis_ujian, s.update_at, p.namaprod, s.status');
		$this->db->from($init_table_soal);
		$this->db->join($init_table_jadwal, 's.uts_uas_kodejdwl = j.kodejdwl');
		$this->db->join($init_table_matkul, 'j.matakuliah_kodemk = m.kodemk');
		$this->db->join($init_table_staff, 'j.staff_nip = dsn.nip');
		$this->db->join($init_table_kelas, 'j.kelas_kodeklas = k.kodeklas');
		$this->db->join($init_table_tahun, 'j.thn_akad_thn_akad_id = t.thn_akad_id');		
		$this->db->join($init_table_prodi, 'k.prodi_prodi_id = p.prodi_id');
		$this->db->where(array(
			's.status' => "Diterima",			
			's.jenis_ujian' => 'UTS',
			't.tahun_akad' => $tahun,
			't.semester' => $semester,
			'p.namaprod' => $prodi
		));				

		$data = $this->db->get();
		return $data->result_array();
	}

	public function getSoalUasBy($tahun, $semester, $prodi)
	{
		$init_table_soal = $this->table_soal.' s';
		$init_table_jadwal = $this->table_jadwal.' j';
		$init_table_matkul = $this->table_matkul.' m';
		$init_table_staff = $this->table_staff.' dsn';		
		$init_table_kelas = $this->table_kelas.' k';
		$init_table_tahun = $this->table_tahun.' t';
		$init_table_prodi = $this->table_prodi.' p';

		$this->db->select('s.kode_soal, j.matakuliah_kodemk, m.namamk, dsn.nama as "pengajar", k.namaklas, s.jenis_soal, s.file, s.jenis_ujian, s.update_at, p.namaprod, s.status');
		$this->db->from($init_table_soal);
		$this->db->join($init_table_jadwal, 's.uts_uas_kodejdwl = j.kodejdwl');
		$this->db->join($init_table_matkul, 'j.matakuliah_kodemk = m.kodemk');
		$this->db->join($init_table_staff, 'j.staff_nip = dsn.nip');
		$this->db->join($init_table_kelas, 'j.kelas_kodeklas = k.kodeklas');
		$this->db->join($init_table_tahun, 'j.thn_akad_thn_akad_id = t.thn_akad_id');		
		$this->db->join($init_table_prodi, 'k.prodi_prodi_id = p.prodi_id');
		$this->db->where(array(
			's.status' => "Diterima",			
			's.jenis_ujian' => 'UAS',
			't.tahun_akad' => $tahun,
			't.semester' => $semester,
			'p.namaprod' => $prodi
		));				

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