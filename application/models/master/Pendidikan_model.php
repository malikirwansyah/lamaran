<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendidikan_Model extends CI_Model {

public function edit($kdpendidikan){
	$query = $this->db->query("SELECT * FROM m_pendidikan WHERE kdpendidikan = '$kdpendidikan'");
	return $query;
	}    

}	