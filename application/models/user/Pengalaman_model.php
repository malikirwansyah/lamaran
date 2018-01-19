<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengalaman_Model extends CI_Model {

 

public function edit($kduser_pengalaman,$kdregis){
	$query = $this->db->query("
		SELECT * FROM m_user_pengalaman WHERE kduser_pengalaman='$kduser_pengalaman' and kduser_regis='$kdregis' 
		");
	return $query;
	}

public function cek_kode($kdregis){
		$q=$this->db->query("select * from m_user_pengalaman
		where kduser_regis='$kdregis'");
		if($q->num_rows()>0){
			return $row=$q->row();
		}else{
			return array();
		}
	}	    

}	