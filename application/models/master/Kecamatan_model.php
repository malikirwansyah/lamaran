<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kecamatan_Model extends CI_Model {

public function edit($kdkecamatan){
	$query = $this->db->query("select kab.kdkabupaten,kab.kabupaten,pro.kdprovinsi,pro.provinsi,kec.kecamatan,kec.kdkecamatan 
				from m_kecamatan as kec
				inner join m_kabupaten as kab on kab.kdkabupaten=kec.kdkabupaten
				inner join m_provinsi as pro on pro.kdprovinsi=kec.kdprovinsi
				WHERE kdkecamatan = '$kdkecamatan'");
	return $query;
	}    

}	