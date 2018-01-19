<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provinsi extends CI_Controller {


	var $folder =   "adminb3/master/provinsi";
	var $kiri	=	"kiri";
	var $fkiri	=	"adminb3/master";
    var $title  =   "Data provinsi";
    var $id_menu =	"1";
   
	
	function __construct(){
		parent::__construct();
			$this->load->model('master/provinsi_model');
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
		redirect('adminb3/provinsi/data_provinsi');
	}


	public function data_provinsi()
	{
			
			$data['title']	= $this->title;	
			$data['dt_provinsi']=$this->db->get('m_provinsi');														
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
		$this->form_validation->set_rules('provinsi', 'provinsi', 'trim|required');
		if($this->form_validation->run() == FALSE)
			{
							
				$this->session->set_flashdata('save_provinsi', "data tidak Boleh Kosong");
		       	header('location:'.base_url().'adminb3/provinsi/data_provinsi');
			}
			else
			{
				date_default_timezone_set("Asia/Jakarta");
				$created_at=date("Y-m-d h:i:s");
				$kdlogin=$this->session->userdata('kdlogin');
			    $provinsi=$this->input->post('provinsi');
			    $data_provinsi=array(
					'provinsi'=>$provinsi,
					'created_at'=>$created_at,
		            'created_by'=>$kdlogin
					);
				$dt=array_merge($data_provinsi);
				$this->db->insert('m_provinsi',$dt);
				$this->session->set_flashdata("save_provinsi","Data berhasil Ditambah");
				header('location:'.base_url().'adminb3/provinsi/data_provinsi');				
			}
	}

	public function edit($kdprovinsi=0)
	{
		
		if(isset($_POST['submit']))
        {
			date_default_timezone_set("Asia/Jakarta"); 
		    $update_at=date("Y-m-d h:i:s");
		    $kdlogin=$this->session->userdata('kdlogin');
		    $kdprovinsi=$this->input->post('kdprovinsi');
			$provinsi=$this->input->post('provinsi');
			  	
			   	$data_provinsi=array(
					            'provinsi'=>$provinsi,
		                	 	'update_at'=>$update_at,
		                	 	'update_by'=>$kdlogin
		                	 	);
		            $this->db->where('kdprovinsi', $kdprovinsi);
	        		$this->db->update('m_provinsi', $data_provinsi);
	        		$this->session->set_flashdata('save_provinsi', "data berhasil disimpan");
			        header('location:'.base_url().'adminb3/provinsi/data_provinsi');
			   	
        }
         else
        {
         	$data['title']	= $this->title;	
			$page			= "edit";
			$data['edit'] = $this->provinsi_model->edit($kdprovinsi)->row();				
			$this->template($page,$data);	
        }
		
			
	}

	
}