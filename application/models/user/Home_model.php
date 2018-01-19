<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_Model extends CI_Model {

function getkabupaten($kdprovinsi){
$kabupaten="<option value=''>--pilih--</option>";
$this->db->order_by('kabupaten','ASC');
$kab= $this->db->get_where('m_kabupaten',
	array('kdprovinsi'=>$kdprovinsi)
	);
foreach ($kab->result_array() as $data ){
$kabupaten.= "<option value='$data[kdkabupaten]'>$data[kabupaten]</option>";
}

return $kabupaten;

}

function getkecamatan($kdkabupaten){
$kabupaten="<option value=''>--pilih--</option>";
$this->db->order_by('kecamatan','ASC');
$kab= $this->db->get_where('m_kecamatan',
	array('kdkabupaten'=>$kdkabupaten)
	);
foreach ($kab->result_array() as $data ){
$kabupaten.= "<option value='$data[kdkecamatan]'>$data[kecamatan]</option>";
}

return $kabupaten;

}

function getkelurahan($kdkecamatan){
$kabupaten="<option value=''>--pilih--</option>";
$this->db->order_by('kelurahan','ASC');
$kab= $this->db->get_where('m_kelurahan',
	array('kdkecamatan'=>$kdkecamatan)
	);
foreach ($kab->result_array() as $data ){
$kabupaten.= "<option value='$data[kdkelurahan]'>$data[kelurahan]</option>";
}

return $kabupaten;

}

function getbarang($idk_umum){

	$kabupaten="<option value=''>--pilih--</option>";

	$this->db->order_by('k_barang','ASC');
	$kab= $this->db->get_where('m_k_barang',array('idk_umum'=>$idk_umum));

	foreach ($kab->result_array() as $data ){
	$kabupaten.= "<option value='$data[idk_barang]'>$data[k_barang]</option>";
	}

	return $kabupaten;

	}


  function getkelompok($idk_barang){

  $kabupaten="<option value=''>--pilih--</option>";

  $this->db->order_by('kdkelompokbarang','ASC');
  $kab= $this->db->get_where('m_kelompokbarang',array('idk_barang'=>$idk_barang));

  foreach ($kab->result_array() as $data ){
  $kabupaten.= "<option value='$data[idkelompokbarang]'>$data[kelompokbarang]</option>";
  }

  return $kabupaten;

  }


}	