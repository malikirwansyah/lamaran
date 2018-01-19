<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_request_Model extends CI_Model {

function getdata() {
     $this->db->select('us.kduser_lamar,
        kat.kategoriloker,lok.loker,us.status,ureg.nama_lengkap,ureg.email,ureg.kduser_regis,pro.hp,ureg.noktp,pend.nilai,m_pend.pendidikan
        ');
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
	return $query;
	} 

public function view($kduser_regis){
    $this->db->select('reg.noktp');
    $this->db->from('m_user_lamar AS us');
    $this->db->join('m_user_regis AS reg', 'reg.kduser_regis = us.kduser_regis', 'INNER');
    $this->db->join('m_user_profil AS pro', 'pro.kduser_regis = us.kduser_regis', 'INNER');
   // $this->db->where(array('lok.kduser_regis' => $kduser_regis,'lok.status' => 1,'kat.status' => 1));
    $this->db->like('us.kduser_regis', $kduser_regis);
    return $this->db->get()->result();
    }

public function view_pendidikan($kduser_regis){
    $this->db->select('pend.nama,pend.nilai,pend.alamat,pend.tgl_awal,pend.tgl_akhir,m_pend.pendidikan,pend.foto');
    $this->db->from('m_user_pendidikan AS pend');
    $this->db->join('m_pendidikan AS m_pend', 'm_pend.kdpendidikan = pend.kdpendidikan', 'INNER');
    $this->db->where(array('pend.kduser_regis' => $kduser_regis));
    $query = $this->db->get();
    return $query;
    }

public function view_profile($kduser_regis){
    $this->db->select('
        reg.noktp,reg.nama_lengkap,reg.email,pro.tempat_lahir,pro.tgl_lahir,pro.jk,ag.agama,pro.tinggi_badan,pro.berat_badan,pro.alamat,pro.hp,per.status_pernikahan,pro.foto_ktp
        ');
    $this->db->from('m_user_profil AS pro');
    $this->db->join('m_user_regis AS reg', 'reg.kduser_regis = pro.kduser_regis', 'INNER');
    $this->db->join('m_agama AS ag', 'ag.kdagama = pro.kdagama', 'INNER');
    $this->db->join('m_status_pernikahan AS per', 'per.kdstatus_pernikahan = pro.kdstatus_pernikahan', 'INNER');
    $this->db->where(array('pro.kduser_regis' => $kduser_regis));
    $query = $this->db->get();
    return $query;
    }  

public function view_lamar($kduser_lamar){
    $this->db->select('kduser_lamar');
    $this->db->from('m_user_lamar');
    $this->db->where(array('kduser_lamar' => $kduser_lamar));
    $query = $this->db->get();
    return $query;
    }

function ambil_kode($kduser_lamar) {
     $this->db->select('kduser_regis');
     $this->db->from('m_user_lamar');
     $this->db->where(array('kduser_lamar' => $kduser_lamar));

     $query = $this->db->get();

     if ($query->num_rows() > 0) {
        //return $row=$query->row()->kdkategoriloker;
        return $row=$query->row()->kduser_regis;
     }//
     else{
            return array();
        }  
}

}	