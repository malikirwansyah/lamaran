<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kelurahan_Model extends CI_Model {

public function edit($kdkelurahan){
	$query = $this->db->query("select kab.kdkabupaten,kab.kabupaten,pro.kdprovinsi,pro.provinsi,
		kel.kelurahan,kel.kdkelurahan,kec.kecamatan,kec.kdkecamatan 
				from m_kelurahan as kel
				inner join m_kecamatan as kec on kec.kdkecamatan=kel.kdkelurahan
				inner join m_kabupaten as kab on kab.kdkabupaten=kel.kdkabupaten
				inner join m_provinsi as pro on pro.kdprovinsi=kel.kdprovinsi
				WHERE kel.kdkelurahan = '$kdkelurahan'");
	return $query;
	}    

}	