<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Golongan_Model extends CI_Model {

public function edit($kdgolongan){
	$query = $this->db->query("SELECT * FROM m_golongan WHERE kdgolongan = '$kdgolongan'");
	return $query;
	}    

}	