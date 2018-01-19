<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_Model extends CI_Model {
//login model admin
	public function getLoginData($data)
	{	
		$login['username'] = $data['username'];
		$login['password'] = md5(sha1(md5($data['password'])));
		$login['active'] = 1;
		$cek = $this->db->get_where('m_login', $login);
		if($cek->num_rows()>0)
		{
			foreach($cek->result() as $qad)
			{
				$sess_data['logged_in'] = 'yasayalogin';
				$sess_data['kdlogin'] = $qad->kdlogin;
				$sess_data['username'] = $qad->username;
				$sess_data['nama_lengkap'] = $qad->nama_lengkap;
				$sess_data['level_user'] = $qad->level_user;
				$sess_data['kdgroup_user'] = $qad->kdgroup_user;
				$sess_data['active'] = $qad->active;
				$sess_data['last_login'] = $qad->last_login;
				$sess_data['last_logout'] = $qad->last_logout;
				$this->session->set_userdata($sess_data);
			}
			$kdlogin=$this->session->userdata('kdlogin');
			date_default_timezone_set("Asia/Jakarta");
			$last_login = date('Y-m-d h:i:s');
			$query = $this->db->query("update m_login set last_login = '$last_login'
				WHERE  kdlogin = '$kdlogin' ");
			header('location:'.base_url().'puny4adminb3/m45uk_log1n');
		}
		else
		{
			$this->session->set_flashdata('result_login', "Maaf, kombinasi username dan password yang anda masukkan salah");
			header('location:'.base_url().'puny4adminb3/m45uk_log1n');
		}
	}


	public function update_pass($data){
		$this->db->where('username',$this->session->userdata('username'));
		$this->db->update('m_login',$data);
	}
	public function update_name($data){
		$this->db->where('username',$this->session->userdata('username'));
		$this->db->update('m_login',$data);
	}

	public function cek_menu($kg,$id_menu){
		$query = $this->db->query("SELECT * FROM m_user_access 
			WHERE kdgroup_user = '$kg' and id_menu ='$id_menu' 

			");
		return $query->result();
	///return $query;
	}	


}	