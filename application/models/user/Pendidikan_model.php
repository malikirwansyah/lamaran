<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendidikan_Model extends CI_Model {

 

public function edit($kdregis){
	$query = $this->db->query("
		SELECT mu.*,pend.kdpendidikan,pend.pendidikan
		FROM m_user_pendidikan AS mu
		left join m_pendidikan as pend on pend.kdpendidikan=mu.kdpendidikan
		WHERE mu.kduser_regis = '$kdregis'
		");
	return $query;
	}

public function cek_kode($kdregis){
		$q=$this->db->query("select * from m_user_pendidikan
		where kduser_regis='$kdregis'");
		if($q->num_rows()>0){
			return $row=$q->row();
		}else{
			return array();
		}
	}	    

}	