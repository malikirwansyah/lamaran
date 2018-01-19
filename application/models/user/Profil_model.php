<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil_Model extends CI_Model {

    var $st_jk = array(
        1 => 'Laki-laki',
        0 => 'Perempuan'
    );

public function edit($kdregis){
	$query = $this->db->query("
		SELECT mu.*,ag.kdagama,ag.agama,ms.kdstatus_pernikahan,ms.status_pernikahan 
		FROM m_user_profil AS mu
		left join m_agama as ag on ag.kdagama=mu.kdagama
		left join m_status_pernikahan as ms on  ms.kdstatus_pernikahan=mu.kdstatus_pernikahan 
		WHERE mu.kduser_regis = '$kdregis'
		");
	return $query;
	}

public function cek_kode($kdregis){
		$q=$this->db->query("select * from m_user_profil
		where kduser_regis='$kdregis'");
		if($q->num_rows()>0){
			return $row=$q->row();
		}else{
			return array();
		}
	}	    

}	