<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_regis_Model extends CI_Model {


    var $st_active = array(
        1 => 'Active',
        0 => 'Banned',
    );

    var $st = array(
        1 => 'Active',
        0 => 'Not Verify',
    );

public function edit($kduser_regis){
	$query = $this->db->query("SELECT * FROM m_user_regis WHERE kduser_regis = '$kduser_regis'");
	return $query;
	}

 public function view($kduser_regis) {
    $this->db->get('m_user_regis');
    //$this->db->select('tgl_regis,nama_lengkap,password,last_login,last_logout, kduser_regis');
    $this->db->like('kduser_regis', $kduser_regis);
    return $this->db->get('m_user_regis')->result();
    }
       

}	