<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_user extends CI_Controller {

	var $folder =   "adminb3/master/group_user";
	var $kiri	=	"kiri";
	var $fkiri	=	"adminb3/master";
    var $title  =   "Data Group User";
    var $id_menu =	"70";

	
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')!=""){
			
			$this->load->model('master/group_user_model');
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
			redirect('adminb3/group_user/data_group_user');
		
		
	}


	public function data_group_user()
	{	
			$data['title']	= $this->title;
			$data['st'] = $this->group_user_model->st_group_user;	
			$data['dt_group_user']=$this->db->get('m_group_user');														
			$data['judul']	= "Data group user";
			$page			= "home";							
			$this->template($page,$data);	

	}

	public function input()
	{
		$data['title']	= $this->title;	
		$page			= "input";							
		$this->template($page,$data);	
	}

	public function simpan()
	{
		$this->form_validation->set_rules('group_user', 'group_user', 'trim|required');
		if($this->form_validation->run() == FALSE)
			{
							
				$this->session->set_flashdata('save_group_user', "data tidak Boleh Kosong");
		       	header('location:'.base_url().'adminb3/group_user/data_group_user');
			}
			else
			{
				date_default_timezone_set("Asia/Jakarta");
				$created_at=date("Y-m-d h:i:s");
				$kdlogin=$this->session->userdata('kdlogin');
			    $group_user=$this->input->post('group_user');
			    $data_group_user=array(
					'group_user'=>$group_user,
					'created_at'=>$created_at,
		            'created_by'=>$kdlogin
					);
				$dt=array_merge($data_group_user);
				$this->db->insert('m_group_user',$dt);
				$this->session->set_flashdata("save_group_user","Data berhasil Ditambah");
				header('location:'.base_url().'adminb3/group_user/data_group_user');				
			}
	}

	public function edit($kdgroup_user=0)
	{
		
		if(isset($_POST['submit']))
        {
			date_default_timezone_set("Asia/Jakarta"); 
		    $update_at=date("Y-m-d h:i:s");
		    $kdlogin=$this->session->userdata('kdlogin');
		    $kdgroup_user=$this->input->post('kdgroup_user');
			$group_user=$this->input->post('group_user');
			$status=$this->input->post('status');
			  	
			   	$data_group_user=array(
					            'group_user'=>$group_user,
					            'status'=>$status,
		                	 	'update_at'=>$update_at,
		                	 	'update_by'=>$kdlogin
		                	 	);
		            $this->db->where('kdgroup_user', $kdgroup_user);
	        		$this->db->update('m_group_user', $data_group_user);
	        		$this->session->set_flashdata('save_group_user', "data berhasil disimpan");
			        header('location:'.base_url().'adminb3/group_user/data_group_user');
			   	
        }
         else
        {
         	$data['title']	= $this->title;	
			$page			= "edit";
			$data['st'] = $this->group_user_model->st_group_user;	
			$data['edit'] = $this->group_user_model->edit($kdgroup_user)->row();				
			$this->template($page,$data);	
        }
		
			
	}

	
}