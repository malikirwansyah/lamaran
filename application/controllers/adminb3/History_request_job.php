<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_request_job extends CI_Controller {


	var $folder =   "adminb3/master/history_request_job";
	var $kiri	=	"kiri";
	var $fkiri	=	"adminb3/master";
    var $title  =   "History request Job";
    var $id_menu =	"25";
   
	
	function __construct(){
		
		parent::__construct();
			$this->load->model('master/history_request_job_model');
			$this->load->model('user/status_loker_model');
			$this->load->model('login_model');
			$this->load->model('user/profil_model');
			$this->load->library('datatables');
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
	public function json() {
		$data['st']=$this->status_loker_model->st;
        header('Content-Type: application/json');
        echo $this->history_request_job_model->json($data);
    }

	public function index()
	{
		redirect('adminb3/history_request_job/data_history_request_job');
	}


	public function data_history_request_job()
	{
			
			$data['title']	= $this->title;							
			$data['judul']	= $this->title;
			$page			= "home";							
			$this->template($page,$data);
	}


	public function view($kduser_lamar=0)
	{
		
        	$kduser_regis=$this->history_request_job_model->ambil_kode($kduser_lamar);
        	if ($data['row']=$kduser_regis)
        	{
        		$data['title']	= $this->title;	
				$page			= "view";
				$data['st_jk'] = $this->profil_model->st_jk;
				$data['view_profile'] = $this->history_request_job_model->view_profile($kduser_regis)->row();
				$data['view_pendidikan'] = $this->history_request_job_model->view_pendidikan($kduser_regis)->row();
				$data['view_pengalaman'] = $this->db->get_where('m_user_pengalaman', array('kduser_regis' => $kduser_regis ));
				$data['view_lamar'] = $this->history_request_job_model->view_lamar($kduser_lamar )->row();
				$data['st']=$this->status_loker_model->st;	
				$this->template($page,$data);
        	}
        	
         		
        	
	}

	

	
}