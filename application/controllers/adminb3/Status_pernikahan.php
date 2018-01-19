<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_pernikahan extends CI_Controller {


	var $folder =   "adminb3/master/status_pernikahan";
	var $kiri	=	"kiri";
	var $fkiri	=	"adminb3/master";
    var $title  =   "Data status pernikahan";
    var $id_menu =	"8";
    //var $judul	=	"";
   
	
	function __construct(){
		parent::__construct();
			$this->load->model('master/status_pernikahan_model');
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
		redirect('adminb3/status_pernikahan/data_status_pernikahan');
	}


	public function data_status_pernikahan()
	{
			
			$data['title']	= $this->title;	
			$data['dt_status_pernikahan']=$this->db->get('m_status_pernikahan');														
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
		$this->form_validation->set_rules('status_pernikahan', 'status_pernikahan', 'trim|required');
		if($this->form_validation->run() == FALSE)
			{
							
				$this->session->set_flashdata('save_status_pernikahan', "data tidak Boleh Kosong");
		       	header('location:'.base_url().'adminb3/status_pernikahan/data_status_pernikahan');
			}
			else
			{
				date_default_timezone_set("Asia/Jakarta");
				$created_at=date("Y-m-d h:i:s");
				$kdlogin=$this->session->userdata('kdlogin');
			    $status_pernikahan=$this->input->post('status_pernikahan');
			    $data_status_pernikahan=array(
					'status_pernikahan'=>$status_pernikahan,
					'created_at'=>$created_at,
		            'created_by'=>$kdlogin
					);
				$dt=array_merge($data_status_pernikahan);
				$this->db->insert('m_status_pernikahan',$dt);
				$this->session->set_flashdata("save_status_pernikahan","Data berhasil Ditambah");
				header('location:'.base_url().'adminb3/status_pernikahan/data_status_pernikahan');				
			}
	}

	public function edit($kdstatus_pernikahan=0)
	{
		
		if(isset($_POST['submit']))
        {
			date_default_timezone_set("Asia/Jakarta"); 
		    $update_at=date("Y-m-d h:i:s");
		    $kdlogin=$this->session->userdata('kdlogin');
		    $kdstatus_pernikahan=$this->input->post('kdstatus_pernikahan');
			$status_pernikahan=$this->input->post('status_pernikahan');
			  	
			   	$data_status_pernikahan=array(
					            'status_pernikahan'=>$status_pernikahan,
		                	 	'update_at'=>$update_at,
		                	 	'update_by'=>$kdlogin
		                	 	);
		            $this->db->where('kdstatus_pernikahan', $kdstatus_pernikahan);
	        		$this->db->update('m_status_pernikahan', $data_status_pernikahan);
	        		$this->session->set_flashdata('save_status_pernikahan', "data berhasil disimpan");
			        header('location:'.base_url().'adminb3/status_pernikahan/data_status_pernikahan');
			   	
        }
         else
        {
         	$data['title']	= $this->title;	
			$page			= "edit";
			$data['edit'] = $this->status_pernikahan_model->edit($kdstatus_pernikahan)->row();				
			$this->template($page,$data);	
        }
		
			
	}

	
}