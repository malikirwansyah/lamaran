<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Status_pernikahan_Model extends CI_Model {

public function edit($kdstatus_pernikahan){
	$query = $this->db->query("SELECT * FROM m_status_pernikahan WHERE kdstatus_pernikahan = '$kdstatus_pernikahan'");
	return $query;
	}    

}	