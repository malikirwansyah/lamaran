<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class loker_Model extends CI_Model {

 

public function edit($kdregis){
	$query = $this->db->query("
		SELECT mu.*,pend.kdloker,pend.loker
		FROM m_user_loker AS mu
		left join m_loker as pend on pend.kdloker=mu.kdloker
		WHERE mu.kduser_regis = '$kdregis'
		");
	return $query;
	}

public function cek_kode($kdregis){
		$q=$this->db->query("select * from m_user_loker
		where kduser_regis='$kdregis'");
		if($q->num_rows()>0){
			return $row=$q->row();
		}else{
			return array();
		}
	}	    

public function cek($datenow){
		$query = $this->db->query("
			SELECT kdkategoriloker,tgl_akhir 
			FROM m_kategoriloker 
			WHERE tgl_akhir >= '$datenow'
			");
		return $query->result();
	}

public function cek_loker($kdevent,$kdregis){

		$query = $this->db->query("
			SELECT *   
			FROM m_user_lamar 
			WHERE kdkategoriloker='$kdevent' and kduser_regis = '$kdregis' 
			");

		if($query->num_rows()>0){
			return $row=$query->row();
		}else{
			return array();
		}
	}

function ambil_event($kdloker) {
     $this->db->select('lok.kdkategoriloker');
     $this->db->from('m_loker AS lok');
     $this->db->join('m_kategoriloker AS kat', 'kat.kdkategoriloker = lok.kdkategoriloker', 'INNER');
     $this->db->where(array('lok.kdloker' => $kdloker,'lok.status' => 1,'kat.status' => 1));

     $query = $this->db->get();

     if ($query->num_rows() > 0) {
     	return $row=$query->row()->kdkategoriloker;
     	//return $row=$query->row();
     }//
     else{
			return array();
		}  
}

function cek_event($kdevent,$kdregis) {
     $this->db->select('kdkategoriloker');
     $this->db->from('m_user_lamar');
     $this->db->where(array('kdkategoriloker' => $kdevent,'kduser_regis' => $kdregis ));

     $query = $this->db->get();

     if ($query->num_rows() > 0) {
     	//return $row=$query->row()->kdkategoriloker;
     	return $row=$query->row()->kdkategoriloker;
     }//
     else{
			return array();
		}  
}

 public function view($kdloker){
 	$this->db->select('lok.loker,lok.ket,kat.kategoriloker,kat.tgl_awal,tgl_akhir');
    $this->db->from('m_loker AS lok');
    $this->db->join('m_kategoriloker AS kat', 'kat.kdkategoriloker = lok.kdkategoriloker', 'INNER');
    $this->db->where(array('lok.kdloker' => $kdloker,'lok.status' => 1,'kat.status' => 1));
    $this->db->like('kdloker', $kdloker);
    return $this->db->get()->result();
    }
      
 public function view2($kdloker){
	$this->db->select('lok.kdloker,lok.loker,lok.ket,kat.kdkategoriloker,kat.kategoriloker');
    $this->db->from('m_loker AS lok');
    $this->db->join('m_kategoriloker AS kat', 'kat.kdkategoriloker = lok.kdkategoriloker', 'INNER');
    $this->db->where(array('lok.kdloker' => $kdloker,'lok.status' => 1,'kat.status' => 1));
    return $this->db->get()->result();
    $query = $this->db->get();
    return $query; 
	} 

public function cek_profil($kdregis){
	$this->db->select('kduser_regis');
	$this->db->from('m_user_profil');
	$this->db->where(array('kduser_regis' => $kdregis));
   	$q= $this->db->get();
    $hasil = 0;
    if($q->num_rows()>0)
    {
      $hasil = 1;
    }
    return $hasil;
  } 

public function cek_pendidikan($kdregis){
	$this->db->select('kduser_regis');
	$this->db->from('m_user_pendidikan');
	$this->db->where(array('kduser_regis' => $kdregis));
   	$q= $this->db->get();
    $hasil = 0;
    if($q->num_rows()>0)
    {
      $hasil = 1;
    }
    return $hasil;
  }
}	