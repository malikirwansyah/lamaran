<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Puny4adminb3 extends CI_Controller {

	var $folder =   "adminb3/login";
//	var $kiri	=	"kiri";
//	var $fkiri	=	"master";
    var $title  =   "User Authentication";

	function __construct()
    {
        parent::__construct();
        $this->load->library(array('Recaptcha'));
        $this->load->model('login_model');
    }

    protected function template($page,$data)
	{
		$this->load->view('home/header',$data);	
		$this->load->view($this->folder."/".$page);				
		$this->load->view('home/footer');
		
	}

	public function index()
	{
		redirect('puny4adminb3/m45uk_log1n');
	}

	public function m45uk_log1n()
	{
		if($this->session->userdata('logged_in')=="")
		{

			
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$recaptcha = $this->input->post('g-recaptcha-response');
       		$response = $this->recaptcha->verifyResponse($recaptcha);
			//if ($this->form_validation->run() == FALSE || !isset($response['success']) || $response['success'] <> true) {
			if ($this->form_validation->run() == FALSE ) 
			{
				$data['captcha']	= $this->recaptcha->getWidget();
				$data['script_captcha'] = $this->recaptcha->getScriptTag();
				$data['title']	= "RS. Baiturrahim Jambi";
				$page="login";		
				$this->template($page,$data);
			}
			else
			{
				$dt['username'] = $this->input->post('username');
				$dt['password'] = $this->input->post('password');
				$this->login_model->getLoginData($dt);
			}
		}
		else if($this->session->userdata('logged_in')!="" )
		{
			header('location:'.base_url().'adminb3/home/home','refresh');
		}
		
	}	

	

	function logout($kdlogin=0)
	{
		date_default_timezone_set("Asia/Jakarta");
		$last_logout =  date('Y-m-d h:i:s');
	    $data_logout=array('last_logout'=>$last_logout);
	    $this->db->where('kdlogin', $kdlogin);
        $this->db->update('m_login', $data_logout);
		$this->session->sess_destroy();
		header('location:'.base_url().'','refresh');
	}
}
