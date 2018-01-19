<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendidikan extends CI_Controller {


	var $folder =   "adminb3/master/pendidikan";
	var $kiri	=	"kiri";
	var $fkiri	=	"adminb3/master";
    var $title  =   "Data pendidikan";
    var $id_menu =	"6";
   
	
	function __construct(){
		parent::__construct();
			$this->load->model('master/pendidikan_model');
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
		redirect('adminb3/pendidikan/data_pendidikan');
	}


	public function data_pendidikan()
	{
			$data['title']	= $this->title;	
			$data['dt_pendidikan']=$this->db->get('m_pendidikan');														
			$data['judul']	=$this->title;
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
		$this->form_validation->set_rules('pendidikan', 'pendidikan', 'trim|required');
		if($this->form_validation->run() == FALSE)
			{
							
				$this->session->set_flashdata('save_pendidikan', "data tidak Boleh Kosong");
		       	header('location:'.base_url().'adminb3/pendidikan/data_pendidikan');
			}
			else
			{
				date_default_timezone_set("Asia/Jakarta");
				$created_at=date("Y-m-d h:i:s");
				$kdlogin=$this->session->userdata('kdlogin');
			    $pendidikan=$this->input->post('pendidikan');
			    $data_pendidikan=array(
					'pendidikan'=>$pendidikan,
					'created_at'=>$created_at,
		            'created_by'=>$kdlogin
					);
				$dt=array_merge($data_pendidikan);
				$this->db->insert('m_pendidikan',$dt);
				$this->session->set_flashdata("save_pendidikan","Data berhasil Ditambah");
				header('location:'.base_url().'adminb3/pendidikan/data_pendidikan');				
			}
	}

	public function edit($kdpendidikan=0)
	{
		
		if(isset($_POST['submit']))
        {
			date_default_timezone_set("Asia/Jakarta"); 
		    $update_at=date("Y-m-d h:i:s");
		    $kdlogin=$this->session->userdata('kdlogin');
		    $kdpendidikan=$this->input->post('kdpendidikan');
			$pendidikan=$this->input->post('pendidikan');
			  	
			   	$data_pendidikan=array(
					            'pendidikan'=>$pendidikan,
		                	 	'update_at'=>$update_at,
		                	 	'update_by'=>$kdlogin
		                	 	);
		            $this->db->where('kdpendidikan', $kdpendidikan);
	        		$this->db->update('m_pendidikan', $data_pendidikan);
	        		$this->session->set_flashdata('save_pendidikan', "data berhasil disimpan");
			        header('location:'.base_url().'adminb3/pendidikan/data_pendidikan');
			   	
        }
         else
        {
         	$data['title']	= $this->title;	
			$page			= "edit";
			$data['edit'] = $this->pendidikan_model->edit($kdpendidikan)->row();				
			$this->template($page,$data);	
        }
		
			
	}

	
}