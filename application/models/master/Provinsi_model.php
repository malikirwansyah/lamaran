<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Provinsi_Model extends CI_Model {

public function edit($kdprovinsi){
	$query = $this->db->query("SELECT * FROM m_provinsi WHERE kdprovinsi = '$kdprovinsi'");
	return $query;
	}    

}	