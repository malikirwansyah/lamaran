<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabupaten extends CI_Controller {


	var $folder =   "adminb3/master/kabupaten";
	var $kiri	=	"kiri";
	var $fkiri	=	"adminb3/master";
    var $title  =   "Data kabupaten";
    var $id_menu =	"2";
   
	
	function __construct(){
		parent::__construct();
			$this->load->model('master/kabupaten_model');
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
		redirect('adminb3/kabupaten/data_kabupaten');
	}


	public function data_kabupaten()
	{
			
			$data['title']	= $this->title;	
			$data['dt_kabupaten']=$this->db->query('
				select kab.kdkabupaten,pro.provinsi,kab.kabupaten 
				from m_kabupaten as kab
				inner join  m_provinsi as pro on pro.kdprovinsi=kab.kdprovinsi
				');															
			$data['judul']	= $this->title;
			$page			= "home";							
			$this->template($page,$data);	

		
	}

	public function input()
	{
		$data['title']	= $this->title;	
		$page			= "input";
		$data['dt_provinsi']=$this->db->get('m_provinsi');							
		$this->template($page,$data);	
	}

	public function simpan()
	{
		$this->form_validation->set_rules('kabupaten', 'kabupaten', 'trim|required');
		if($this->form_validation->run() == FALSE)
			{
							
				$this->session->set_flashdata('save_kabupaten', "data tidak Boleh Kosong");
		       	header('location:'.base_url().'adminb3/kabupaten/data_kabupaten');
			}
			else
			{
				date_default_timezone_set("Asia/Jakarta");
				$created_at=date("Y-m-d h:i:s");
				$kdlogin=$this->session->userdata('kdlogin');
				$kdprovinsi=$this->input->post('kdprovinsi');
			    $kabupaten=$this->input->post('kabupaten');
			    $data_kabupaten=array(
			    	'kdprovinsi'=>$kdprovinsi,
					'kabupaten'=>$kabupaten,
					'created_at'=>$created_at,
		            'created_by'=>$kdlogin
					);
				$dt=array_merge($data_kabupaten);
				$this->db->insert('m_kabupaten',$dt);
				$this->session->set_flashdata("save_kabupaten","Data berhasil Ditambah");
				header('location:'.base_url().'adminb3/kabupaten/data_kabupaten');				
			}
	}

	public function edit($kdkabupaten=0)
	{
		
		if(isset($_POST['submit']))
        {
			date_default_timezone_set("Asia/Jakarta"); 
		    $update_at=date("Y-m-d h:i:s");
		    $kdlogin=$this->session->userdata('kdlogin');
		    $kdkabupaten=$this->input->post('kdkabupaten');
			$kabupaten=$this->input->post('kabupaten');
			$kdprovinsi=$this->input->post('kdprovinsi');
			  	
			   	$data_kabupaten=array(
			   		'kdprovinsi'=>$kdprovinsi,
					            'kabupaten'=>$kabupaten,
		                	 	'update_at'=>$update_at,
		                	 	'update_by'=>$kdlogin
		                	 	);
		            $this->db->where('kdkabupaten', $kdkabupaten);
	        		$this->db->update('m_kabupaten', $data_kabupaten);
	        		$this->session->set_flashdata('save_kabupaten', "data berhasil disimpan");
			        header('location:'.base_url().'adminb3/kabupaten/data_kabupaten');
			   	
        }
         else
        {
        	$data['dt_provinsi']=$this->db->get('m_provinsi');	
         	$data['title']	= $this->title;	
			$page			= "edit";
			$data['edit'] = $this->kabupaten_model->edit($kdkabupaten)->row();				
			$this->template($page,$data);	
        }
		
			
	}

	
}