<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unit_Model extends CI_Model {

public function edit($kdunit){
	$query = $this->db->query("SELECT * FROM m_unit WHERE kdunit = '$kdunit'");
	return $query;
	}    

}	