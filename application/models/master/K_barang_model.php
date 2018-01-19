<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class K_barang_Model extends CI_Model {

public function edit($idk_barang){
	$query = $this->db->query("select k.idk_barang, u.idk_umum,u.kdk_umum,u.k_umum,k.kdk_barang,k.k_barang 
				from m_k_barang as k 
				inner join m_k_umum as u on u.idk_umum=k.idk_umum  WHERE idk_barang = '$idk_barang'");
	return $query;
	}    

}	