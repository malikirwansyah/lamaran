<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lantai_Model extends CI_Model {

public function edit($kdlantai){
	$query = $this->db->query("SELECT * FROM m_lantai WHERE kdlantai = '$kdlantai'");
	return $query;
	}


}
