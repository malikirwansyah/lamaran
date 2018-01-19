<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategoriloker_Model extends CI_Model {

    var $st = array(
        1 => 'Active',
        0 => 'Not Active',
    );
public function edit($kdkategoriloker){
	$query = $this->db->query("SELECT * FROM m_kategoriloker WHERE kdkategoriloker = '$kdkategoriloker'");
	return $query;
	}    

}	