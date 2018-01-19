<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class History_request_job_model extends CI_Model {

 function json() {
        $this->datatables->select('us.kduser_lamar,
        kat.kategoriloker,lok.loker,us.status,ureg.nama_lengkap,ureg.noktp');
        $this->datatables->from('m_user_lamar AS us');
        
        //add this line for join
        $this->datatables->join('m_kategoriloker AS kat', 'kat.kdkategoriloker = us.kdkategoriloker','INNER');
        $this->datatables->join('m_loker AS lok', 'lok.kdloker = us.kdloker','INNER');
        $this->datatables->join('m_user_regis AS ureg', 'ureg.kduser_regis = us.kduser_regis', 'INNER');
        $this->datatables->add_column('action', anchor(site_url('adminb3/history_request_job/view/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm btn-flat')), 'kduser_lamar');
        return $this->datatables->generate();
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
    $this->db->select('kduser_lamar,alasan,status');
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