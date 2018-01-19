<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_user_Model extends CI_Model {

    var $st_group_user = array(
        1 => 'Active',
        0 => 'Not Active',
    );

	public function edit($kdgroup_user){
		$query = $this->db->query("SELECT * FROM m_group_user WHERE kdgroup_user = '$kdgroup_user'");
		return $query;
		}    

}	