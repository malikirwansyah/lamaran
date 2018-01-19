<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Satuan_Model extends CI_Model {

public function edit($kdsatuan){
	$query = $this->db->query("SELECT * FROM m_satuan WHERE kdsatuan = '$kdsatuan'");
	return $query;
	}    

}	