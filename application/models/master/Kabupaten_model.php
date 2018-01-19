<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kabupaten_Model extends CI_Model {

public function edit($kdkabupaten){
	$query = $this->db->query("
		select pro.kdprovinsi,kab.kdkabupaten,pro.provinsi,kab.kabupaten 
				from m_kabupaten as kab
				inner join  m_provinsi as pro on pro.kdprovinsi=kab.kdprovinsi
WHERE kdkabupaten = '$kdkabupaten'
		
				");
	return $query;
	}    

}	