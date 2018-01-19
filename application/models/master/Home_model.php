<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_Model extends CI_Model {

	function total() {
     $this->db->select('us.kduser_lamar');
     $this->db->from('m_user_lamar AS us');
     $this->db->join('m_kategoriloker AS kat', 'kat.kdkategoriloker = us.kdkategoriloker', 'INNER');
     $this->db->join('m_loker AS lok', 'lok.kdloker = us.kdloker', 'INNER');
     $this->db->join('m_user_regis AS ureg', 'ureg.kduser_regis = us.kduser_regis', 'INNER');
     $this->db->join('m_user_profil AS pro', 'pro.kduser_regis = us.kduser_regis', 'INNER');
     $this->db->join('m_user_pendidikan AS pend', 'pend.kduser_regis = us.kduser_regis', 'INNER');
     $this->db->join('m_pendidikan AS m_pend', 'm_pend.kdpendidikan = pend.kdpendidikan', 'INNER');
     $this->db->like(array('us.status' => 0));
     $this->db->where(array('lok.status' => 1,'kat.status' => 1));
     $query = $this->db->get();
    return $query->num_rows();
    }

    function sekarang($tgl_skr) {
     $this->db->select('us.kduser_lamar');
     $this->db->from('m_user_lamar AS us');
     $this->db->join('m_kategoriloker AS kat', 'kat.kdkategoriloker = us.kdkategoriloker', 'INNER');
     $this->db->join('m_loker AS lok', 'lok.kdloker = us.kdloker', 'INNER');
     $this->db->join('m_user_regis AS ureg', 'ureg.kduser_regis = us.kduser_regis', 'INNER');
     $this->db->join('m_user_profil AS pro', 'pro.kduser_regis = us.kduser_regis', 'INNER');
     $this->db->join('m_user_pendidikan AS pend', 'pend.kduser_regis = us.kduser_regis', 'INNER');
     $this->db->join('m_pendidikan AS m_pend', 'm_pend.kdpendidikan = pend.kdpendidikan', 'INNER');
     $this->db->like(array('us.status' => 0,'us.created_at' => $tgl_skr));
     $this->db->where(array('lok.status' => 1,'kat.status' => 1));
     $query = $this->db->get();
    return $query->num_rows();
    }  

function getkabupaten($kdprovinsi){
$kabupaten="<option value=''>--pilih--</option>";
$this->db->order_by('kabupaten','ASC');
$kab= $this->db->get_where('m_kabupaten',
	array('kdprovinsi'=>$kdprovinsi)
	);
foreach ($kab->result_array() as $data ){
$kabupaten.= "<option value='$data[kdkabupaten]'>$data[kabupaten]</option>";
}

return $kabupaten;

}

function getkecamatan($kdkabupaten){
$kabupaten="<option value=''>--pilih--</option>";
$this->db->order_by('kecamatan','ASC');
$kab= $this->db->get_where('m_kecamatan',
	array('kdkabupaten'=>$kdkabupaten)
	);
foreach ($kab->result_array() as $data ){
$kabupaten.= "<option value='$data[kdkecamatan]'>$data[kecamatan]</option>";
}

return $kabupaten;

}

function getkelurahan($kdkecamatan){
$kabupaten="<option value=''>--pilih--</option>";
$this->db->order_by('kelurahan','ASC');
$kab= $this->db->get_where('m_kelurahan',
	array('kdkecamatan'=>$kdkecamatan)
	);
foreach ($kab->result_array() as $data ){
$kabupaten.= "<option value='$data[kdkelurahan]'>$data[kelurahan]</option>";
}

return $kabupaten;

}



}	