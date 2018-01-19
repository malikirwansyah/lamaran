<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class status_loker_Model extends CI_Model {

     var $st = array(
        0 => 'In Proses',
        1 => 'Approve',
        2 => 'Un Successful'
        
    );

function getdata($kdregis) {
     $this->db->select('kat.kategoriloker,lok.ket,us.status');
     $this->db->from('m_user_lamar AS us');
     $this->db->join('m_kategoriloker AS kat', 'kat.kdkategoriloker = us.kdkategoriloker', 'INNER');
     $this->db->join('m_loker AS lok', 'lok.kdloker = us.kdloker', 'INNER');
     $this->db->where(array('us.kduser_regis' => $kdregis,'lok.status' => 1,'kat.status' => 1));
     $query = $this->db->get();
	return $query;
	}

}	