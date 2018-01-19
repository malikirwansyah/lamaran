<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agama extends CI_Controller {


	var $folder =   "adminb3/master/agama";
	var $kiri	=	"kiri";
	var $fkiri	=	"adminb3/master";
    var $title  =   "Data agama";
    var $id_menu =	"7";
   
	
	function __construct(){
		
		parent::__construct();
			$this->load->model('master/agama_model');
			$this->load->model('login_model');
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
		redirect('adminb3/agama/data_agama');
	}


	public function data_agama()
	{
			
			$data['title']	= $this->title;	
			$data['dt_agama']=$this->db->get('m_agama');														
			$data['judul']	= $this->title;
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
		$this->form_validation->set_rules('agama', 'agama', 'trim|required');
		if($this->form_validation->run() == FALSE)
			{
							
				$this->session->set_flashdata('save_agama', "data tidak Boleh Kosong");
		       	header('location:'.base_url().'adminb3/agama/data_agama');
			}
			else
			{
				date_default_timezone_set("Asia/Jakarta");
				$created_at=date("Y-m-d h:i:s");
				$kdlogin=$this->session->userdata('kdlogin');
			    $agama=$this->input->post('agama');
			    $data_agama=array(
					'agama'=>$agama,
					'created_at'=>$created_at,
		            'created_by'=>$kdlogin
					);
				$dt=array_merge($data_agama);
				$this->db->insert('m_agama',$dt);
				$this->session->set_flashdata("save_agama","Data berhasil Ditambah");
				header('location:'.base_url().'adminb3/agama/data_agama');				
			}
	}

	public function edit($kdagama=0)
	{
		
		if(isset($_POST['submit']))
        {
			date_default_timezone_set("Asia/Jakarta"); 
		    $update_at=date("Y-m-d h:i:s");
		    $kdlogin=$this->session->userdata('kdlogin');
		    $kdagama=$this->input->post('kdagama');
			$agama=$this->input->post('agama');
			  	
			   	$data_agama=array(
					            'agama'=>$agama,
		                	 	'update_at'=>$update_at,
		                	 	'update_by'=>$kdlogin
		                	 	);
		            $this->db->where('kdagama', $kdagama);
	        		$this->db->update('m_agama', $data_agama);
	        		$this->session->set_flashdata('save_agama', "data berhasil disimpan");
			        header('location:'.base_url().'adminb3/agama/data_agama');
			   	
        }
         else
        {
         	$data['title']	= $this->title;	
			$page			= "edit";
			$data['edit'] = $this->agama_model->edit($kdagama)->row();				
			$this->template($page,$data);	
        }
		
			
	}

	
}