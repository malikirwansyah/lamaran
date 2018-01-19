<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai_Model extends CI_Model {

public function edit($kdpegawai){
	$query = $this->db->query("
		select peg.*,
				kab.kdkabupaten,kab.kabupaten,pro.provinsi,pro.kdprovinsi,
				kel.kelurahan,kel.kdkelurahan,kec.kecamatan,kec.kdkecamatan,
				uni.kdunit,uni.unit,gol.kdgolongan,gol.golongan,jab.kdjabatan,jab.jabatan
				from m_pegawai as peg
				inner join m_kecamatan as kec on kec.kdkecamatan=peg.kdkecamatan
				inner join m_kabupaten as kab on kab.kdkabupaten=peg.kdkabupaten
				inner join m_provinsi as pro on pro.kdprovinsi=peg.kdprovinsi
				inner join m_kelurahan as kel on kel.kdkelurahan=peg.kdkelurahan
				inner join m_unit as uni on uni.kdunit=peg.kdunit
				inner join m_golongan as gol on gol.kdgolongan=peg.kdgolongan
				inner join m_jabatan as jab on jab.kdjabatan=peg.kdjabatan 
		 WHERE peg.kdpegawai = '$kdpegawai'
		");
	return $query;
	}    

}	