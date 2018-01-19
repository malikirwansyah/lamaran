<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register_Model extends CI_Model {

public function getLoginData($data)
  {  
    $login['noktp'] = $data['noktp'];
    $login['password'] = $data['password'];
    $login['active'] = 1;
    $login['status_kode'] = 1;
    $cek = $this->db->get_where('m_user_regis', $login);
    if($cek->num_rows()>0)
    {
      foreach($cek->result() as $qad)
      {
        $sess_data['masuk_in'] = 'yasayaloginbe';
        $sess_data['kdregis'] = $qad->kduser_regis;
        $sess_data['noktp'] = $qad->noktp;
        $sess_data['nama_lengkap'] = $qad->nama_lengkap;
        $sess_data['noktp'] = $qad->noktp;
        $sess_data['kode_aktivasi'] = $qad->kode_aktivasi;
        $sess_data['tgl_regis'] = $qad->tgl_regis;
        $sess_data['status_kode'] = $qad->status_kode;
        $sess_data['active'] = $qad->active;
        $sess_data['last_login'] = $qad->last_login;
        $sess_data['last_logout'] = $qad->last_logout;
        $sess_data['email'] = $qad->email;
        $this->session->set_userdata($sess_data);
      }
      $kdregis=$this->session->userdata('kdregis');
      date_default_timezone_set("Asia/Jakarta");
      $last_login = date('Y-m-d h:i:s');
      $query = $this->db->query("update m_user_regis set last_login = '$last_login'
        WHERE  kduser_regis = '$kdregis' ");
      header('location:'.base_url().'app/login');
    }
    else
    {
      $this->session->set_flashdata('result_login', "Maaf, kombinasi username dan password yang anda masukkan salah");
      header('location:'.base_url().'app/login');
    }
  }

function buat_kode($tgl_skr)   {
  $b='BWA';
  $this->db->select('RIGHT(m_user_regis.kduser_regis,4) as kode', FALSE);
  $this->db->order_by('kduser_regis','DESC');
  $this->db->limit(1);

  $query = $this->db->get('m_user_regis');      //cek dulu apakah ada sudah ada kode di tabel.
  if($query->num_rows() <> 0){
   //jika kode ternyata sudah ada.
   $data = $query->row();
   $kode = intval($data->kode) + 1;
  }
  else{
   //jika kode belum ada
   $kode = '0001';
  }
  $kodemax = str_pad($kode,4 , "0", STR_PAD_LEFT);
  $kodejadi = $b.$tgl_skr.$kodemax;
  return $kodejadi;
 }

  public function cek($noktp){
   $q=$this->db->query("select * from m_user_regis
    where noktp='$noktp'");
    $hasil = 0;
    if($q->num_rows()>0)
    {
      $hasil = 1;
    }
    return $hasil;
  }
   
  public function cek_email($email){
   $hasil = 0;
   $q=$this->db->get_where('m_user_regis',array('email' => $email ));
    if($q->num_rows()>0)
    {
      $hasil = 1;
    }
    return $hasil;
  }

  function ambil_kode($kirim) {
     $this->db->select('kduser_regis');
     $this->db->from('m_user_regis');
     $this->db->where(array('email' => $kirim));

     $query = $this->db->get();

     if ($query->num_rows() > 0) {
      //return $row=$query->row()->kdkategoriloker;
      return $row=$query->row()->kduser_regis;
     }//
     else{
      return array();
    }  
}

function kode_password($kode_aktivasi) {
     $this->db->select('kduser_regis');
     $this->db->from('m_user_regis');
     $this->db->where(array('kode_aktivasi' => $kode_aktivasi ));

     $query = $this->db->get();

     if ($query->num_rows() > 0) {
    
      return $row=$query->row()->kduser_regis;
     }//
     else{
      return array();
    }  
}

function ambil_email($kode_aktivasi) {
     $this->db->select('email');
     $this->db->from('m_user_regis');
     $this->db->where(array('kode_aktivasi' => $kode_aktivasi ));

     $query = $this->db->get();

     if ($query->num_rows() > 0) {
    
      return $row=$query->row()->email;
     }//
     else{
      return array();
    }  
}

}	