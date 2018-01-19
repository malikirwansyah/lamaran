<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jenisbarang_Model extends CI_Model {

public function edit($kdjenisbarang){
	$query = $this->db->query("SELECT * FROM m_jenisbarang WHERE kdjenisbarang = '$kdjenisbarang'");
	return $query;
	}    

}	