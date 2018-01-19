<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gudang_Model extends CI_Model {

public function edit($kdgudang){
	$query = $this->db->query("select l.kdlantai,l.lantai,g.kdgudang,g.gudang 
				from m_gudang as g 
				inner join m_lantai as l on l.kdlantai=g.kdlantai WHERE g.kdgudang = '$kdgudang'");
	return $query;
	}


}
