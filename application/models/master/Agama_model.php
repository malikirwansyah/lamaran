<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agama_Model extends CI_Model {

public function edit($kdagama){
	$query = $this->db->query("SELECT * FROM m_agama WHERE kdagama = '$kdagama'");
	return $query;
	}    

}	