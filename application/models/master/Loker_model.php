<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loker_Model extends CI_Model {

//karyawan
    var $st = array(
        1 => 'Active',
        0 => 'Not Active',
    );

public function edit($kdloker){
	$query = $this->db->query("
	SELECT lok.*,kat.kdkategoriloker,kat.kategoriloker FROM m_loker as lok
	inner join m_kategoriloker as kat on kat.kdkategoriloker=lok.kdkategoriloker
	WHERE lok.kdloker = '$kdloker'");
	return $query;
	}    

}	