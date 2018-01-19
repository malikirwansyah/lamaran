<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_request extends CI_Controller {


	var $folder =   "adminb3/master/job_request";
	var $kiri	=	"kiri";
	var $fkiri	=	"adminb3/master";
    var $title  =   "Job Request";
    var $id_menu =	"24";
   
	
	function __construct(){
		
		parent::__construct();
			$this->load->model('master/job_request_model');
			$this->load->model('user/status_loker_model');
			$this->load->model('login_model');
			$this->load->model('user/profil_model');
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
		redirect('adminb3/job_request/data_job_request');
	}


	public function data_job_request()
	{
			
			$data['title']	= $this->title;	
			$data['dt_job_request']=$this->job_request_model->getdata();
			$data['st']=$this->status_loker_model->st;														
			$data['judul']	= $this->title;
			$page			= "home";							
			$this->template($page,$data);	

		
	}


	public function view($kduser_lamar=0)
	{
		if(isset($_POST['submit']))
        {
			date_default_timezone_set("Asia/Jakarta"); 
		    $update_at=date("Y-m-d h:i:s");
		    $kdlogin=$this->session->userdata('kdlogin');
		   	$kduser_lamar=$this->input->post('kduser_lamar');
			$status=$this->input->post('status');
			$alasan=$this->input->post('alasan');
			  	
			   	$data_job_request=array(
					            'status'=>$status,
					            'alasan'=>$alasan,
		                	 	'update_at'=>$update_at,
		                	 	'update_by'=>$kdlogin
		                	 	);
		            $this->db->where('kduser_lamar', $kduser_lamar);
	        		$this->db->update('m_user_lamar', $data_job_request);
	        		$this->session->set_flashdata('save_job_request', "data berhasil disimpan");
			        header('location:'.base_url().'adminb3/job_request/data_job_request');
			   	
        }
         else
        {
        	$kduser_regis=$this->job_request_model->ambil_kode($kduser_lamar);
        	if ($data['row']=$kduser_regis)
        	{
        		$data['title']	= $this->title;	
				$page			= "view";
				$data['st_jk'] = $this->profil_model->st_jk;
				$data['view_profile'] = $this->job_request_model->view_profile($kduser_regis)->row();
				$data['view_pendidikan'] = $this->job_request_model->view_pendidikan($kduser_regis)->row();
				$data['view_pengalaman'] = $this->db->get_where('m_user_pengalaman', array('kduser_regis' => $kduser_regis ));
				$data['view_lamar'] = $this->job_request_model->view_lamar($kduser_lamar )->row();
				$data['st']=$this->status_loker_model->st;	
				$this->template($page,$data);
        	}
        	
         		
        }	
	}

	public function simpan()
	{
		$this->form_validation->set_rules('job_request', 'job_request', 'trim|required');
		if($this->form_validation->run() == FALSE)
			{
							
				$this->session->set_flashdata('save_job_request', "data tidak Boleh Kosong");
		       	header('location:'.base_url().'adminb3/job_request/data_job_request');
			}
			else
			{
				date_default_timezone_set("Asia/Jakarta");
				$created_at=date("Y-m-d h:i:s");
				$kdlogin=$this->session->userdata('kdlogin');
			    $job_request=$this->input->post('job_request');
			    $data_job_request=array(
					'job_request'=>$job_request,
					'created_at'=>$created_at,
		            'created_by'=>$kdlogin
					);
				$dt=array_merge($data_job_request);
				$this->db->insert('m_job_request',$dt);
				$this->session->set_flashdata("save_job_request","Data berhasil Ditambah");
				header('location:'.base_url().'adminb3/job_request/data_job_request');				
			}
	}

	public function edit($kdjob_request=0)
	{
		
		if(isset($_POST['submit']))
        {
			date_default_timezone_set("Asia/Jakarta"); 
		    $update_at=date("Y-m-d h:i:s");
		    $kdlogin=$this->session->userdata('kdlogin');
		    $kdjob_request=$this->input->post('kdjob_request');
			$job_request=$this->input->post('job_request');
			  	
			   	$data_job_request=array(
					            'job_request'=>$job_request,
		                	 	'update_at'=>$update_at,
		                	 	'update_by'=>$kdlogin
		                	 	);
		            $this->db->where('kdjob_request', $kdjob_request);
	        		$this->db->update('m_job_request', $data_job_request);
	        		$this->session->set_flashdata('save_job_request', "data berhasil disimpan");
			        header('location:'.base_url().'adminb3/job_request/data_job_request');
			   	
        }
         else
        {
         	$data['title']	= $this->title;	
			$page			= "edit";
			$data['edit'] = $this->job_request_model->edit($kdjob_request)->row();				
			$this->template($page,$data);	
        }
		
			
	}

	
}