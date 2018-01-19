<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_Model extends CI_Model {
//karyawan
    var $st_active = array(
        1 => 'Active',
        0 => 'Banned',
    );
public function edit($kdlogin){
	$query = $this->db->query("
        select log.kdlogin,log.username,log.level_user,log.last_login,log.last_logout,log.nama_lengkap,
        gu.kdgroup_user,gu.group_user,log.active
             from m_login as log 
             inner join m_group_user as gu on gu.kdgroup_user=log.kdgroup_user
            
        WHERE log.kdlogin = '$kdlogin'
        ");
	return $query;
	}

	
	var $st_group = array(
        1 => 'Super Admin',
        2 => 'Umum',
        3 => 'Logistik',
        4 => 'Owner'
    );
   
    var $st_level = array(
        1 => 'Kepala Staff',
        2 => 'Staff'
    );

public function cek_kd_user($username) {
        $q = $this->db->query(" SELECT * FROM m_login WHERE username='".$username."'");
        $hasil = 0;
        if($q->num_rows()>0)
        {
            $hasil = 1;
        }
        return $hasil;
    }   
//end karyawan

}
