<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	var $folder =   "adminb3/master/user";
	var $kiri	=	"kiri";
	var $fkiri	=	"adminb3/master";
    var $title  =   "Data User";
    var $id_menu =	"71";

	
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')!=""){
			
			$this->load->model('master/user_model');
			$this->load->model('login_model');

			
		}
		else{

			header('location:'.base_url().'');
		}
		
	}
	protected function template($page,$data)
	{
		$kg=$this->session->userdata('kdgroup_user');
		$cm= $this->login_model->cek_menu($kg,$this->id_menu);
		foreach ($cm as $row):
                       
                               ".$row->status.";
                    endforeach;
        $ck=$row->status;

		if($this->session->userdata('logged_in')!="" && $ck==1){
			$this->load->view('adminb3/header',$data);			
			$this->load->view($this->fkiri."/".$this->kiri);
			$this->load->view($this->folder."/".$page);		
			$this->load->view('adminb3/footer');
		}else{

			header('location:'.base_url().'','refresh');
		}
		
	}

	public function index()
	{
		redirect('adminb3/user/data_user');
	}


	public function data_user()
	{
			$data['title']	= $this->title;	
			$data['st_active'] = $this->user_model->st_active;
			$data['st_level'] = $this->user_model->st_level;
			$data['dt_user']=$this->db->query('
			select log.kdlogin,log.username,
			log.level_user,log.last_login,log.last_logout,gu.group_user,log.active,log.nama_lengkap
			 from m_login as log 
			 inner join m_group_user as gu on gu.kdgroup_user=log.kdgroup_user
			 ');														
			$data['judul']	= "Data user";
			$page			= "home";							
			$this->template($page,$data);	

		
		
	}

	public function input()
	{
		$data['title']	= $this->title;	
		$page			= "input";
		$data['dt_group']=$this->db->get_where('m_group_user',array('status' => 1 ));
																
		$this->template($page,$data);	
	}

	public function simpan()
	{
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$simpan["username"] = $this->input->post("username");
		if($this->user_model->cek_kd_user($simpan["username"])==0)
		{
				if($this->form_validation->run() == FALSE)
					{
									
						$this->session->set_flashdata('save_user', "data tidak Boleh Kosong");
				       	header('location:'.base_url().'adminb3/user/data_user');
					}
					else
					{
						date_default_timezone_set("Asia/Jakarta");
						$created_at=date("Y-m-d h:i:s");
						$kdlogin=$this->session->userdata('kdlogin');

					$username=$this->input->post('username');
					$kdpegawai=$this->input->post('kdpegawai');
				    $password=$this->input->post('password');
				    $nama_lengkap=$this->input->post('nama_lengkap');
				   // $level_user=$this->input->post('level_user');
				    $kdgroup_user=$this->input->post('kdgroup_user');
				  
			   		$data_user=array(
					'password'=>md5(sha1(md5($password))),
					'username'=>$username,'nama_lengkap'=>$nama_lengkap,//'kdpegawai'=>$kdpegawai,
					'kdgroup_user'=>$kdgroup_user,//'level_user'=>$level_user,
							'created_at'=>$created_at,
				            'created_by'=>$kdlogin
							);
						$dt=array_merge($data_user);
						$this->db->insert('m_login',$dt);
						$this->session->set_flashdata("save_user","Data berhasil Ditambah");
						header('location:'.base_url().'adminb3/user/data_user');				
					}
		}
		else{
			$this->session->set_flashdata("save_user","
			<p style='text-align:center; margin:0px;'> Username Telah Terpakai</p>");
			header('location:'.base_url().'adminb3/user/data_user');
		}			
	}

	public function edit($kdlogin=0)
	{
		
		if(isset($_POST['submit']))
        {
			date_default_timezone_set("Asia/Jakarta"); 
		    $update_at=date("Y-m-d h:i:s");
		    $kdlogin=$this->session->userdata('kdlogin');
		 
					$kdpegawai=$this->input->post('kdpegawai');
					 $kd_masuk=$this->input->post('kdlogin');
				    
				    $nama_lengkap=$this->input->post('nama_lengkap');
				    $level_user=$this->input->post('level_user');
				    $kdgroup_user=$this->input->post('kdgroup_user');
				     $nama_lengkap=$this->input->post('nama_lengkap');
				     $active=$this->input->post('active');
				  
			   		$data_user=array(
					//'kdpegawai'=>$kdpegawai,
					'kdgroup_user'=>$kdgroup_user,//'level_user'=>$level_user,
					'active'=>$active,'nama_lengkap'=>$nama_lengkap,
		                	 	'update_at'=>$update_at,
		                	 	'update_by'=>$kdlogin
		                	 	);
		            $this->db->where('kdlogin', $kd_masuk);
	        		$this->db->update('m_login', $data_user);
	        		$this->session->set_flashdata('save_user', "data berhasil disimpan");
			        header('location:'.base_url().'adminb3/user/data_user');
			   	
        }
         else
        {
        	$data['st_active'] = $this->user_model->st_active;
			$data['st_level'] = $this->user_model->st_level;
         	$data['title']	= $this->title;	
			$page			= "edit";
			$data['dt_group']=$this->db->get_where('m_group_user',array('status' => 1 ));
			
			$data['edit'] = $this->user_model->edit($kdlogin)->row();

			$this->template($page,$data);	
        }
		
			
	}

	
}