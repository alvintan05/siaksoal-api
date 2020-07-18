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
	private $table_pengurus = 'tik.pengurus_uts_uas';
	private $table_format = 'tik.format_soal';
	
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
		$init_table_pengurus = $this->table_pengurus.' p';
		$array = array('s.status' => "Diterima", 's.jenis_ujian' => 'UTS');

		$this->db->select('s.kode_soal, j.matakuliah_kodemk, m.namamk, dsn.nama as "pengajar", p.bagian, k.namaklas, s.jenis_soal, s.file, s.jenis_ujian, s.update_at');
		$this->db->from($init_table_soal);			
		$this->db->join($init_table_jadwal, 's.uts_uas_kodejdwl = j.kodejdwl');
		$this->db->join($init_table_matkul,'j.matakuliah_kodemk = m.kodemk');
		$this->db->join($init_table_staff, 'j.staff_nip = dsn.nip');
		$this->db->join($init_table_kelas, 'j.kelas_kodeklas = k.kodeklas');
		$this->db->join($init_table_pengurus, 's.kbk_nip = p.pengurus_uts_uas_nip');
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
		$init_table_pengurus = $this->table_pengurus.' p';
		$array = array('s.status' => "Diterima", 's.jenis_ujian' => 'UAS');

		$this->db->select('s.kode_soal, j.matakuliah_kodemk, m.namamk, dsn.nama as "pengajar", p.bagian, k.namaklas, s.jenis_soal, s.file, s.jenis_ujian, s.update_at');
		$this->db->from($init_table_soal);			
		$this->db->join($init_table_jadwal, 's.uts_uas_kodejdwl = j.kodejdwl');
		$this->db->join($init_table_matkul,'j.matakuliah_kodemk = m.kodemk');
		$this->db->join($init_table_staff, 'j.staff_nip = dsn.nip');
		$this->db->join($init_table_kelas, 'j.kelas_kodeklas = k.kodeklas');
		$this->db->join($init_table_pengurus, 's.kbk_nip = p.pengurus_uts_uas_nip');
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
		$init_table_pengurus = $this->table_pengurus.' pe';

		$this->db->select('s.kode_soal, j.matakuliah_kodemk, m.namamk, dsn.nama as "pengajar", pe.bagian, k.namaklas, s.jenis_soal, s.file, s.jenis_ujian, s.update_at, p.namaprod, s.status');
		$this->db->from($init_table_soal);
		$this->db->join($init_table_jadwal, 's.uts_uas_kodejdwl = j.kodejdwl');
		$this->db->join($init_table_matkul, 'j.matakuliah_kodemk = m.kodemk');
		$this->db->join($init_table_staff, 'j.staff_nip = dsn.nip');
		$this->db->join($init_table_kelas, 'j.kelas_kodeklas = k.kodeklas');
		$this->db->join($init_table_tahun, 'j.thn_akad_thn_akad_id = t.thn_akad_id');		
		$this->db->join($init_table_prodi, 'k.prodi_prodi_id = p.prodi_id');
		$this->db->join($init_table_pengurus, 's.kbk_nip = pe.pengurus_uts_uas_nip');
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
		$init_table_pengurus = $this->table_pengurus.' pe';

		$this->db->select('s.kode_soal, j.matakuliah_kodemk, m.namamk, dsn.nama as "pengajar", pe.bagian, k.namaklas, s.jenis_soal, s.file, s.jenis_ujian, s.update_at, p.namaprod, s.status');
		$this->db->from($init_table_soal);
		$this->db->join($init_table_jadwal, 's.uts_uas_kodejdwl = j.kodejdwl');
		$this->db->join($init_table_matkul, 'j.matakuliah_kodemk = m.kodemk');
		$this->db->join($init_table_staff, 'j.staff_nip = dsn.nip');
		$this->db->join($init_table_kelas, 'j.kelas_kodeklas = k.kodeklas');
		$this->db->join($init_table_tahun, 'j.thn_akad_thn_akad_id = t.thn_akad_id');		
		$this->db->join($init_table_prodi, 'k.prodi_prodi_id = p.prodi_id');
		$this->db->join($init_table_pengurus, 's.kbk_nip = pe.pengurus_uts_uas_nip');
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
		$this->db->order_by('id', 'ASC');
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

	public function getFormatUts()
	{		
		$this->db->from($this->table_format);		
		$this->db->where('jenis_ujian', 'UTS');		

		$data = $this->db->get();
		return $data->result_array();
	}

	public function getFormatUas()
	{		
		$this->db->from($this->table_format);		
		$this->db->where('jenis_ujian', 'UAS');		

		$data = $this->db->get();
		return $data->result_array();
	}

	public function updateFormat($jenis_ujian, $data)
	{
		$this->db->where('jenis_ujian', $jenis_ujian);
		$query = $this->db->update($this->table_format, $data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	// public function getNipDosen()
	// {
	// 	$init_table_staff = $this->table_staff.' dsn';				
	// 	$init_table_pengurus = $this->table_pengurus.' pe';

	// 	$this->db->select('dsn.nama, pe.pengurus_uts_uas_nip');
	// 	$this->db->from($init_table_pengurus);
	// 	$this->db->join($init_table_staff, 'pe.pengurus_uts_uas_nip = dsn.nip');
	// 	$this->db->where('pe.bagian', 'Dosen');

	// 	$data = $this->db->get();
	// 	return $data->result_array();
	// }

	// public function getListMatkul($nip)
	// {
	// 	$init_table_jadwal = $this->table_jadwal.' j';
	// 	$init_table_matkul = $this->table_matkul.' m';
	// 	$init_table_kelas = $this->table_kelas.' k';		

	// 	$this->db->select('j.kodejdwl, j.matakuliah_kodemk, m.namamk, k.namaklas, j.ruangan_namaruang');
	// 	$this->db->from($init_table_jadwal);
	// 	$this->db->join($init_table_matkul, 'j.matakuliah_kodemk = m.kodemk');
	// 	$this->db->join($init_table_kelas, 'j.kelas_kodeklas = k.kodeklas');
	// 	$this->db->where('j.staff_nip', $nip);		
	// 	$this->db->order_by('j.kodejdwl', 'ASC');		

	// 	$data = $this->db->get();
	// 	return $data->result_array();
	// }

	// public function getMatkulStatus($kode)
	// {	

	// 	$this->db->select('status, update_at');		
	// 	$this->db->from($this->table_soal);
	// 	$this->db->where('uts_uas_kodejdwl', $kode);
	// 	$this->db->order_by('update_at', 'DESC');
	// 	$this->db->limit(1);

	// 	$data = $this->db->get();

	// 	if ($data->num_rows() > 0){
	// 		$hasil = $data->result();
	//         return $hasil[0]->status;
	//     }
	//     else{
	//         return 'belum upload';
	//     }		
	// }

}

/* End of file Model_panitia.php */
/* Location: ./application/models/Model_panitia.php */