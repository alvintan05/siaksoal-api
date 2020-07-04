<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dosen extends CI_Model {


	// please use $table_number = table name 
	private $table_jadwal = 'tik.jadwal_kul';
	private $table_matkul = 'tik.matakuliah';
	private $table_kelas = 'tik.kelas';
	private $table_soal = 'tik.soal_uts_uas';
	private $table_pengurus = 'tik.pengurus_uts_uas';
	private $table_tahun = 'tik.thn_akad';

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
			$init_table_jadwal = $this->table_jadwal.' j';
			$init_table_matkul = $this->table_matkul.' m';
			$init_table_kelas = $this->table_kelas.' k';

			$this->db->select('j.kodejdwl, j.matakuliah_kodemk, m.namamk, k.namaklas, j.ruangan_namaruang');			
			$this->db->from($init_table_jadwal);
			$this->db->join($init_table_matkul, 'j.matakuliah_kodemk = m.kodemk');
			$this->db->join($init_table_kelas, 'j.kelas_kodeklas = k.kodeklas');
			$this->db->where('j.staff_nip', $nip);
			$this->db->order_by('m.namamk', 'ASC');
	
			$data = $this->db->get();
			return $data->result_array();
		}	
	}

	public function getJadwalByTahun($nip, $tahun, $semester)
	{
		$init_table_jadwal = $this->table_jadwal.' j';
		$init_table_matkul = $this->table_matkul.' m';
		$init_table_kelas = $this->table_kelas.' k';
		$init_table_tahun = $this->table_tahun.' t';

		$this->db->select('j.kodejdwl, j.matakuliah_kodemk, m.namamk, k.namaklas, j.ruangan_namaruang');			
		$this->db->from($init_table_jadwal);
		$this->db->join($init_table_matkul, 'j.matakuliah_kodemk = m.kodemk');
		$this->db->join($init_table_kelas, 'j.kelas_kodeklas = k.kodeklas');
		$this->db->join($init_table_tahun, 'j.thn_akad_thn_akad_id = t.thn_akad_id');		
		$this->db->where(array(
			'j.staff_nip' => $nip,
			't.tahun_akad' => $tahun,
			't.semester' => $semester
		));

		$data = $this->db->get();
		return $data->result_array();
	}
	
	public function getStatusListUts($nip = null)
	{
		if ($nip != null) {			
			$init_table_soal = $this->table_soal.' s';
			$init_table_jadwal = $this->table_jadwal.' j';
			$init_table_kelas = $this->table_kelas.' k';
			$init_table_matkul = $this->table_matkul.' m';		
			$init_table_pengurus = $this->table_pengurus.' p';
			$array = array(
				'j.staff_nip' => $nip, 
				's.jenis_ujian' => 'UTS'
			);

			$this->db->select('s.kode_soal, j.matakuliah_kodemk, k.namaklas, m.namamk, s.file, s.status, s.jenis_soal, p.bagian, s.note,s.create_at, s.update_at');	
			$this->db->from($init_table_soal);
			$this->db->join($init_table_jadwal, 's.uts_uas_kodejdwl = j.kodejdwl');
			$this->db->join($init_table_matkul, 'j.matakuliah_kodemk = m.kodemk');
			$this->db->join($init_table_kelas, 'j.kelas_kodeklas = k.kodeklas');
			$this->db->join($init_table_pengurus, 's.kbk_nip = p.pengurus_uts_uas_nip');
			$this->db->where($array);			
			$this->db->order_by('s.update_at', 'ASC');

			$data = $this->db->get();
			return $data->result_array();
		}
	}

	public function getStatusListUas($nip = null)
	{
		if ($nip != null) {			
			$init_table_soal = $this->table_soal.' s';
			$init_table_jadwal = $this->table_jadwal.' j';
			$init_table_matkul = $this->table_matkul.' m';			
			$init_table_kelas = $this->table_kelas.' k';
			$init_table_pengurus = $this->table_pengurus.' p';
			$array = array('j.staff_nip' => $nip, 's.jenis_ujian' => 'UAS');

			$this->db->select('s.kode_soal, j.matakuliah_kodemk, k.namaklas, m.namamk, s.file, s.status, s.jenis_soal, p.bagian, s.note, s.create_at, s.update_at');
			$this->db->from($init_table_soal);
			$this->db->join($init_table_jadwal, 's.uts_uas_kodejdwl = j.kodejdwl');
			$this->db->join($init_table_matkul, 'j.matakuliah_kodemk = m.kodemk');
			$this->db->join($init_table_kelas, 'j.kelas_kodeklas = k.kodeklas');
			$this->db->join($init_table_pengurus, 's.kbk_nip = p.pengurus_uts_uas_nip');
			$this->db->where($array);			
			$this->db->order_by('s.update_at', 'ASC');

			$data = $this->db->get();
			return $data->result_array();
		}
	}

	public function getStatusSoalUtsByTahun($nip, $tahun, $semester)
	{
		$init_table_soal = $this->table_soal.' s';
		$init_table_jadwal = $this->table_jadwal.' j';
		$init_table_matkul = $this->table_matkul.' m';
		$init_table_pengurus = $this->table_pengurus.' p';
		$init_table_kelas = $this->table_kelas.' k';
		$init_table_tahun = $this->table_tahun.' t';		

		$this->db->select('s.kode_soal, j.matakuliah_kodemk, m.namamk, k.namaklas, s.file, s.status, s.jenis_soal, p.bagian, s.note, s.create_at, s.update_at');
		$this->db->from($init_table_soal);
		$this->db->join($init_table_jadwal, 's.uts_uas_kodejdwl = j.kodejdwl');
		$this->db->join($init_table_matkul, 'j.matakuliah_kodemk = m.kodemk');
		$this->db->join($init_table_pengurus, 's.kbk_nip = p.pengurus_uts_uas_nip');		
		$this->db->join($init_table_kelas, 'j.kelas_kodeklas = k.kodeklas');
		$this->db->join($init_table_tahun, 'j.thn_akad_thn_akad_id = t.thn_akad_id');				
		$this->db->where(array(
			'j.staff_nip' => $nip,
			's.jenis_ujian' => 'UTS',
			't.tahun_akad' => $tahun,
			't.semester' => $semester
		));		
		$this->db->order_by('s.update_at', 'ASC');

		$data = $this->db->get();
		return $data->result_array();
	}

	public function getStatusSoalUasByTahun($nip, $tahun, $semester)
	{
		$init_table_soal = $this->table_soal.' s';
		$init_table_jadwal = $this->table_jadwal.' j';
		$init_table_matkul = $this->table_matkul.' m';
		$init_table_pengurus = $this->table_pengurus.' p';
		$init_table_kelas = $this->table_kelas.' k';
		$init_table_tahun = $this->table_tahun.' t';		

		$this->db->select('s.kode_soal, j.matakuliah_kodemk, m.namamk, k.namaklas, s.file, s.status, s.jenis_soal, p.bagian, s.note, s.create_at, s.update_at');
		$this->db->from($init_table_soal);
		$this->db->join($init_table_jadwal, 's.uts_uas_kodejdwl = j.kodejdwl');
		$this->db->join($init_table_matkul, 'j.matakuliah_kodemk = m.kodemk');
		$this->db->join($init_table_pengurus, 's.kbk_nip = p.pengurus_uts_uas_nip');		
		$this->db->join($init_table_kelas, 'j.kelas_kodeklas = k.kodeklas');
		$this->db->join($init_table_tahun, 'j.thn_akad_thn_akad_id = t.thn_akad_id');			
		$this->db->where(array(
			'j.staff_nip' => $nip,
			's.jenis_ujian' => 'UAS',
			't.tahun_akad' => $tahun,
			't.semester' => $semester
		));		
		$this->db->order_by('s.update_at', 'ASC');

		$data = $this->db->get();
		return $data->result_array();
	}

	public function getKbkNip($jenis)
	{	
		$this->db->select('pengurus_uts_uas_nip');
		$this->db->from($this->table_pengurus);		
		$this->db->where('bagian', $jenis);

		$result = $this->db->get();

		return $result->row()->pengurus_uts_uas_nip;
	}

	public function getUpload($kode = null)
	{	
		if ($kode != null) {			
			$init_table_jadwal = $this->table_jadwal.' j';
			$init_table_matkul = $this->table_matkul.' m';
			$init_table_kelas = $this->table_kelas.' k';

			$this->db->select('j.kodejdwl, m.namamk, k.namaklas');			
			$this->db->from($init_table_jadwal);
			$this->db->join($init_table_matkul, 'j.matakuliah_kodemk = m.kodemk');
			$this->db->join($init_table_kelas, 'j.kelas_kodeklas = k.kodeklas');
			$this->db->where('j.kodejdwl', $kode);

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

	public function getEdit($kode = null)
	{	
		if ($kode != null) {			
			$init_table_jadwal = $this->table_jadwal.' j';
			$init_table_matkul = $this->table_matkul.' m';
			$init_table_kelas = $this->table_kelas.' k';
			$init_table_soal = $this->table_soal.' s';
			$init_table_pengurus = $this->table_pengurus.' p';

			$this->db->select('s.kode_soal, m.namamk, k.namaklas, s.jenis_ujian, s.jenis_soal, s.file, p.bagian');		
			$this->db->from($init_table_soal);
			$this->db->join($init_table_jadwal, 's.uts_uas_kodejdwl = j.kodejdwl');
			$this->db->join($init_table_matkul, 'j.matakuliah_kodemk = m.kodemk');
			$this->db->join($init_table_kelas, 'j.kelas_kodeklas = k.kodeklas');
			$this->db->join($init_table_pengurus, 's.kbk_nip = p.pengurus_uts_uas_nip');
			$this->db->where('s.kode_soal', $kode);

			$data = $this->db->get();			
			return $data->result_array();
		}	
	}	

	public function updateEditSoal($kode = null, $data)
	{	
		$this->db->where('kode_soal', $kode);
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

	public function getTahun()
	{
		$this->db->select('tahun_akad');
		$this->db->from($this->table_tahun);
		$this->db->order_by('tahun_akad', 'ASC');
		$this->db->distinct();
		$data = $this->db->get();
		return $data->result_array();
	}
}

/* End of file Model_dosen.php */
/* Location: ./application/models/Model_dosen.php */