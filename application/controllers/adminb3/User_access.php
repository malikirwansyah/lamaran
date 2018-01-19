<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_access extends CI_Controller {

	var $folder =   "adminb3/master/user_access";
	var $kiri	=	"kiri";
	var $fkiri	=	"adminb3/master";
    var $title  =   "Data user access";
    var $id_menu =	"72";



	
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')!=""){
			
			$this->load->model('master/user_access_model');
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
		
			redirect('adminb3/user_access/data_user_access');
		
		
	}


	public function data_user_access()
	{
		
			$data['title']	= $this->title;
			$data['st_status'] = $this->user_access_model->st_status;	
			$data['dt_user_access']=$this->db->query('
				select mu.kduser_access,mu.status,mn.id_menu,mn.menu_name,mg.kdgroup_user,mg.group_user
				from m_user_access as mu 
				inner join ms_menu as mn on mn.id_menu=mu.id_menu
				inner join m_group_user as mg on mg.kdgroup_user=mu.kdgroup_user
				');														
			$data['judul']	= "Data user access";
			$page			= "home";							
			$this->template($page,$data);	

		
	}

	public function input()
	{
		$data['title']	= $this->title;
		$data['dt_menu']=$this->db->get('ms_menu');
		$data['dt_group']=$this->db->get_where('m_group_user',array('status' => 1 ));		
		$page			= "input";							
		$this->template($page,$data);	
	}

	public function simpan()
	{
		$simpan["kdgroup_user"] = $this->input->post("kdgroup_user");
		$simpan["id_menu"] = $this->input->post("id_menu");
		if($this->user_access_model->cek( $simpan["kdgroup_user"],$simpan["id_menu"] )==0)
		{
			$this->form_validation->set_rules('kdgroup_user', 'kdgroup_user', 'trim|required');
			if($this->form_validation->run() == FALSE)
				{
								
					$this->session->set_flashdata('save_user_access', "data tidak Boleh Kosong");
			       	header('location:'.base_url().'adminb3/user_access/data_user_access');
				}
				else
				{
					date_default_timezone_set("Asia/Jakarta");
					$created_at=date("Y-m-d h:i:s");
					$kdlogin=$this->session->userdata('kdlogin');

				    $kdgroup_user=$this->input->post('kdgroup_user');
				    $id_menu=$this->input->post('id_menu');
				    $data_user_access=array(
						'kdgroup_user'=>$kdgroup_user,
						'id_menu'=>$id_menu,
						'created_at'=>$created_at,
			            'created_by'=>$kdlogin
						);
					$dt=array_merge($data_user_access);
					$this->db->insert('m_user_access',$dt);
					$this->session->set_flashdata("save_user_access","Data berhasil Ditambah");
					header('location:'.base_url().'adminb3/user_access/data_user_access');				
				}
		}
		else{
			$this->session->set_flashdata("save_user_access","
			<p style='text-align:center; margin:0px;'>  Telah Terpakai</p>");
			header('location:'.base_url().'adminb3/user_access/data_user_access');
		}	
	}

	public function edit($kduser_access=0)
	{
		
		if(isset($_POST['submit']))
        {
			date_default_timezone_set("Asia/Jakarta"); 
		    $update_at=date("Y-m-d h:i:s");
		    $kdlogin=$this->session->userdata('kdlogin');
		    $kduser_access=$this->input->post('kduser_access');

		     $status=$this->input->post('status');
			
			  	
			   	$data_user_access=array(
					           'status'=>$status,
		                	 	'update_at'=>$update_at,
		                	 	'update_by'=>$kdlogin
		                	 	);
		            $this->db->where('kduser_access', $kduser_access);
	        		$this->db->update('m_user_access', $data_user_access);
	        		$this->session->set_flashdata('save_user_access', "data berhasil disimpan");
			        header('location:'.base_url().'adminb3/user_access/data_user_access');
			   	
        }
         else
        {
        	$data['st_status'] = $this->user_access_model->st_status;
         	$data['title']	= $this->title;	
			$page			= "edit";
			$data['edit'] = $this->user_access_model->edit($kduser_access)->row();				
			$this->template($page,$data);	
        }
		
			
	}

	
}