<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_access_Model extends CI_Model {

    var $st_status = array(
        1 => 'Active',
        0 => 'Not Active',
    );
public function edit($kduser_access){
	$query = $this->db->query("
		select mu.kduser_access,mu.status,mn.id_menu,mn.menu_name,mg.kdgroup_user,mg.group_user
				from m_user_access as mu 
				inner join ms_menu as mn on mn.id_menu=mu.id_menu
				inner join m_group_user as mg on mg.kdgroup_user=mu.kdgroup_user
				WHERE mu.kduser_access = '$kduser_access'
		");
	return $query;
}

public function cek($kdgroup_user,$id_menu) {
		$q = $this->db->query("SELECT * FROM m_user_access WHERE kdgroup_user='".$kdgroup_user."' && id_menu='".$id_menu."'");
		$hasil = 0;
		if($q->num_rows()>0)
		{
			$hasil = 1;
		}
		return $hasil;
		}    

}	