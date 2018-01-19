<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan extends CI_Controller {


	var $folder =   "adminb3/master/kecamatan";
	var $kiri	=	"kiri";
	var $fkiri	=	"adminb3/master";
    var $title  =   "Data kecamatan";
    var $id_menu =	"3";
   
	
	function __construct(){
		parent::__construct();
			$this->load->model('master/kecamatan_model');
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
		redirect('adminb3/kecamatan/data_kecamatan');
	}


	public function data_kecamatan()
	{
			
			$data['title']	= $this->title;	
			$data['dt_kecamatan']=$this->db->query('
				select kab.kabupaten,pro.provinsi,kec.kecamatan,kec.kdkecamatan 
				from m_kecamatan as kec
				inner join m_kabupaten as kab on kab.kdkabupaten=kec.kdkabupaten
				inner join m_provinsi as pro on pro.kdprovinsi=kec.kdprovinsi
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
		$this->form_validation->set_rules('kecamatan', 'kecamatan', 'trim|required');
		if($this->form_validation->run() == FALSE)
			{
							
				$this->session->set_flashdata('save_kecamatan', "data tidak Boleh Kosong");
		       	header('location:'.base_url().'adminb3/kecamatan/data_kecamatan');
			}
			else
			{
				date_default_timezone_set("Asia/Jakarta");
				$created_at=date("Y-m-d h:i:s");
				$kdlogin=$this->session->userdata('kdlogin');
				$kdprovinsi=$this->input->post('kdprovinsi');
				$kdkabupaten=$this->input->post('kdkabupaten');
			    $kecamatan=$this->input->post('kecamatan');
			    $data_kecamatan=array(
					'kdprovinsi'=>$kdprovinsi,
					'kdkabupaten'=>$kdkabupaten,
					'kecamatan'=>$kecamatan,
					'created_at'=>$created_at,
		            'created_by'=>$kdlogin
					);
				$dt=array_merge($data_kecamatan);
				$this->db->insert('m_kecamatan',$dt);
				$this->session->set_flashdata("save_kecamatan","Data berhasil Ditambah");
				header('location:'.base_url().'adminb3/kecamatan/data_kecamatan');				
			}
	}

	public function edit($kdkecamatan=0)
	{
		
		if(isset($_POST['submit']))
        {
			date_default_timezone_set("Asia/Jakarta"); 
		    $update_at=date("Y-m-d h:i:s");
		    $kdlogin=$this->session->userdata('kdlogin');
		    $kdkecamatan=$this->input->post('kdkecamatan');
		    $kdprovinsi=$this->input->post('kdprovinsi');
			$kecamatan=$this->input->post('kecamatan');
			$kdkabupaten=$this->input->post('kdkabupaten');
			  	
			   	$data_kecamatan=array(
			   			'kdprovinsi'=>$kdprovinsi,
					            'kecamatan'=>$kecamatan,
					            'kdkabupaten'=>$kdkabupaten,
		                	 	'update_at'=>$update_at,
		                	 	'update_by'=>$kdlogin
		                	 	);
		            $this->db->where('kdkecamatan', $kdkecamatan);
	        		$this->db->update('m_kecamatan', $data_kecamatan);
	        		$this->session->set_flashdata('save_kecamatan', "data berhasil disimpan");
			        header('location:'.base_url().'adminb3/kecamatan/data_kecamatan');
			   	
        }
         else
        {
        	$data['dt_provinsi']=$this->db->get('m_provinsi');	
         	$data['title']	= $this->title;	
			$page			= "edit";
			$data['edit'] = $this->kecamatan_model->edit($kdkecamatan)->row();				
			$this->template($page,$data);	
        }
		
			
	}

	
}