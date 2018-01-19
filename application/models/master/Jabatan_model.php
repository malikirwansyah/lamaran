<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jabatan_Model extends CI_Model {

public function edit($kdjabatan){
	$query = $this->db->query("SELECT * FROM m_jabatan WHERE kdjabatan = '$kdjabatan'");
	return $query;
	}    

}	